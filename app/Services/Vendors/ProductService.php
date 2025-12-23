<?php

namespace App\Services\Vendors;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Vendors\ProductModel;
use App\Models\CommonModel;
use App\Models\Vendors\ProductImageModel;

class ProductService
{
    protected $productModel;
    protected $commonModel;
    protected $productImageModel;

    // Path inside /public
    protected $defaultImagePath = 'assets/vendors/images/Default_Product_Image.png';

    public function __construct()
    {
        $this->productModel      = new ProductModel();
        $this->commonModel       = new CommonModel();
        $this->productImageModel = new ProductImageModel();
    }

    /**
     * Bulk Excel Upload
     */
    public function bulkUploadFromExcel($uploadedFile, $vendorId)
    {
        if (!$uploadedFile->isValid()) {
            return [
                'success' => false,
                'message' => 'Invalid Excel file uploaded.'
            ];
        }

        try {
            /** Load Excel **/
            $tmpPath     = $uploadedFile->getTempName();
            $reader      = IOFactory::createReaderForFile($tmpPath);
            $spreadsheet = $reader->load($tmpPath);
            $sheet       = $spreadsheet->getActiveSheet();
            $rows        = $sheet->toArray(null, true, true, true);

            if (empty($rows)) {
                return ['success' => false, 'message' => 'Excel file is empty.'];
            }

            /** Read Header **/
            $header = array_shift($rows);
            $colMap = [];

            foreach ($header as $col => $title) {
                $t = strtolower(trim($title));

                if ($t === 'product name')                                 $colMap['name'] = $col;
                if ($t === 'category name')                                $colMap['category'] = $col;
                if (in_array($t, ['sub category', 'subcategory', 'sub-category']))
                                                                            $colMap['subcategory'] = $col;
                if ($t === 'description')                                  $colMap['description'] = $col;
            }

            /** Validate Required Headers **/
            $required = ['name', 'category', 'description'];
            foreach ($required as $req) {
                if (!isset($colMap[$req])) {
                    return [
                        'success' => false,
                        'message' => 'Missing mandatory header: Product Name, Category Name, Description'
                    ];
                }
            }

            $errors     = [];
            $rowNumber  = 2; // Because row 1 is header

            /** PROCESS ALL ROWS **/
            foreach ($rows as $row) {

                $name            = trim($row[$colMap['name']] ?? '');
                $categoryName    = trim($row[$colMap['category']] ?? '');
                $subcategoryName = trim($row[$colMap['subcategory']] ?? '');
                $description     = trim($row[$colMap['description']] ?? '');

                /** Validate Required Fields **/
                if ($name === '' || $categoryName === '' || $description === '') {
                    $errors[] = "Row {$rowNumber}: Missing required fields.";
                    $rowNumber++;
                    continue;
                }

                /** Get Category **/
                $category = $this->commonModel->getSingleData(CATEGORY_TABLE, [
                    'LOWER(title)' => strtolower($categoryName),
                    'status'       => ACTIVE_STATUS
                ]);

                if (!$category) {
                    $errors[] = "Row {$rowNumber}: Category '{$categoryName}' not found.";
                    $rowNumber++;
                    continue;
                }

                $categoryId = $category['uid'];

                /** Get Subcategory (Optional) **/
                $subcategoryId = '';

                if ($subcategoryName !== '') {
                    $subcat = $this->commonModel->getSingleData(SUB_CATEGORY_TABLE, [
                        'category_id'  => $categoryId,
                        'LOWER(title)' => strtolower($subcategoryName),
                        'status'       => ACTIVE_STATUS
                    ]);

                    if ($subcat) {
                        $subcategoryId = $subcat['uid'];
                    }
                }

                /** Prepare Product Data **/
                $productUid = $this->generateUid();

                $data = [
                    'uid'            => $productUid,
                    'vendor_id'      => $vendorId,
                    'category_id'    => $categoryId,
                    'subcategory_id' => $subcategoryId,
                    'name'           => $name,
                    'description'    => $description,
                    'image'          => $this->defaultImagePath,
                    'status'         => 'Active',
                    'is_admin_allow' => 1,
                    'created_at'     => date('Y-m-d H:i:s'),
                ];

                /** Insert Product **/
                $this->productModel->insert($data);

                /** Insert Product Image **/
                $imageRow = [
                    'uid'        => $this->generateUid(),
                    'product_id' => $productUid,
                    'image'      => $this->defaultImagePath,
                    'main_image' => '1',
                    'status'     => 'active',
                    'created_by' => $vendorId,
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $this->productImageModel->insert($imageRow);

                $rowNumber++;
            }

            /** If Errors Exist → Fail Upload **/
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

    /**
     * Generate UID
     */
    protected function generateUid()
    {
        return strtoupper(bin2hex(random_bytes(8)));
    }
}

