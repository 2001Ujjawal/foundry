<?php

namespace App\Services\Vendors;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Vendors\ProductModel;
use App\Models\CommonModel;
use App\Models\Vendors\ProductImageModel;
use App\Models\Vendors\ProductSeoModel;

class ProductService
{
    protected $productModel;
    protected $commonModel;
    protected $productImageModel;
    protected $productSeoModel;

    protected $defaultImagePath = 'assets/vendors/images/Default_Product_Image.png';

    public function __construct()
    {
        $this->productModel      = new ProductModel();
        $this->commonModel       = new CommonModel();
        $this->productImageModel = new ProductImageModel();
        $this->productSeoModel   = new ProductSeoModel();
    }

    public function bulkUploadFromExcel($uploadedFile, $vendorId)
    {
        if (!$uploadedFile || !$uploadedFile->isValid()) {
            return [
                'success' => false,
                'message' => 'Invalid Excel file uploaded.'
            ];
        }

        try {
            $tmpPath     = $uploadedFile->getTempName();
            $reader      = IOFactory::createReaderForFile($tmpPath);
            $spreadsheet = $reader->load($tmpPath);
            $sheet       = $spreadsheet->getActiveSheet();
            $rows        = $sheet->toArray(null, true, true, true);

            if (empty($rows)) {
                return [
                    'success' => false,
                    'message' => 'Excel file is empty.'
                ];
            }

            /** Map Headers **/
            $header = array_shift($rows);
            $colMap = [];

            foreach ($header as $col => $title) {
                $t = strtolower(trim((string) $title));

                if ($t === 'product name')     $colMap['name'] = $col;
                if ($t === 'category name')    $colMap['category'] = $col;
                if (in_array($t, ['sub category', 'subcategory', 'sub-category']))
                    $colMap['subcategory'] = $col;
                if ($t === 'description')      $colMap['description'] = $col;
                if ($t === 'meta title')       $colMap['meta_title'] = $col;
                if ($t === 'meta description') $colMap['meta_description'] = $col;
                if ($t === 'meta keywords')    $colMap['meta_keywords'] = $col;
                if ($t === 'meta tags')        $colMap['meta_tags'] = $col;
            }

            foreach (['name', 'category', 'description'] as $req) {
                if (!isset($colMap[$req])) {
                    return [
                        'success' => false,
                        'message' => 'Missing mandatory header: Product Name, Category Name, Description'
                    ];
                }
            }

            $errors    = [];
            $rowNumber = 2;

            foreach ($rows as $row) {

                if (
                    empty(trim($row[$colMap['name']] ?? '')) &&
                    empty(trim($row[$colMap['category']] ?? '')) &&
                    empty(trim($row[$colMap['description']] ?? ''))
                ) {
                    $rowNumber++;
                    continue;
                }

                $name            = trim($row[$colMap['name']] ?? '');
                $categoryName    = trim($row[$colMap['category']] ?? '');
                $subcategoryName = isset($colMap['subcategory'])
                    ? trim($row[$colMap['subcategory']] ?? '')
                    : '';
                $description     = trim($row[$colMap['description']] ?? '');

                $metaTitle = isset($colMap['meta_title'])
                    ? trim($row[$colMap['meta_title']] ?? '')
                    : '';

                $metaDescription = isset($colMap['meta_description'])
                    ? trim($row[$colMap['meta_description']] ?? '')
                    : '';

                $metaKeywords = isset($colMap['meta_keywords'])
                    ? trim($row[$colMap['meta_keywords']] ?? '')
                    : '';

                $metaTags = isset($colMap['meta_tags'])
                    ? trim($row[$colMap['meta_tags']] ?? '')
                    : '';

                if ($name === '' || $categoryName === '' || $description === '') {
                    $errors[] = "Row {$rowNumber}: Missing required fields.";
                    $rowNumber++;
                    continue;
                }

                /** Normalize category name **/
                $normalizedCategoryName = strtolower(
                    preg_replace('/\s+/', ' ', trim($categoryName))
                );

                /** Parent Category **/
                $category = $this->commonModel->getSingleDataNormalized(
                    'category',
                    'title',
                    $normalizedCategoryName
                );


                if (!$category) {
                    $errors[] = "Row {$rowNumber}: Category '{$categoryName}' not found.";
                    $rowNumber++;
                    continue;
                }

                $categoryId = $category['uid'];

                /** Sub Category (same table, child of parent) **/
                $subcategoryId = null;

                if ($subcategoryName !== '') {
                    $normalizedSubName = strtolower(
                        preg_replace('/\s+/', ' ', trim($subcategoryName))
                    );

                    $subcat = $this->commonModel->getSingleDataLike(
                        'category',
                        [
                            'status' => 'active',
                            'path'   => $categoryId
                        ],
                        'title',
                        $normalizedSubName
                    );

                    if ($subcat) {
                        $subcategoryId = $subcat['uid'];
                    }
                }

                /** Insert Product **/
                $productUid = $this->generateUid();

                $this->productModel->insert([
                    'uid'            => $productUid,
                    'vendor_id'      => $vendorId,
                    'category_id'    => $categoryId,
                    'subcategory_id' => $subcategoryId,
                    'name'           => $name,
                    'description'    => $description,
                    'image'          => $this->defaultImagePath,
                    'status'         => 'inactive',
                    'is_admin_allow' => 0,
                    'created_at'     => date('Y-m-d H:i:s'),
                ]);

                /** Insert Default Image **/
                $this->productImageModel->insert([
                    'uid'        => $this->generateUid(),
                    'product_id' => $productUid,
                    'image'      => $this->defaultImagePath,
                    'main_image' => '1',
                    'status'     => 'active',
                    'created_by' => $vendorId,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                /** Insert SEO **/
                $this->productSeoModel->insert([
                    'uid'              => $this->generateUid(),
                    'product_uid'      => $productUid,
                    'meta_title'       => $metaTitle !== '' ? $metaTitle : $name,
                    'meta_description' => $metaDescription !== ''
                        ? $metaDescription
                        : substr(strip_tags($description), 0, 160),
                    'meta_keywords'    => $metaKeywords !== ''
                        ? strtolower($metaKeywords)
                        : strtolower($name . ', ' . $categoryName),
                    'meta_tags'        => $metaTags !== ''
                        ? strtolower($metaTags)
                        : strtolower($categoryName),
                    'status'           => 'active',
                    'created_at'       => date('Y-m-d H:i:s'),
                    'updated_at'       => date('Y-m-d H:i:s'),
                ]);

                $rowNumber++;
            }

            if (!empty($errors)) {
                return [
                    'success' => false,
                    'message' => 'Upload failed due to errors.',
                    'errors'  => $errors
                ];
            }

            return [
                'success' => true,
                'message' => 'Products uploaded successfully.'
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error processing file: ' . $e->getMessage()
            ];
        }
    }

    protected function generateUid()
    {
        return strtoupper(bin2hex(random_bytes(8)));
    }
}
