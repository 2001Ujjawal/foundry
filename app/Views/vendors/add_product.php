<?= view('vendors/templates/html_editor.php'); ?>
<div class="content-body p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Add Product Details</h5>
    </div>
    <div class="card rounded-10 shadow border-0 overflow-hidden">
        <div class="card-body">
            <form id="productForm" method="post" enctype="multipart/form-data">
                <div class="row g-3">

                    <!-- Product Name & Category -->
                    <div class="col-md-6 col-lg-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Enter Name" required>
                            <label for="name">Product Name <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="form-floating">
                            <select class="form-control" name="category" id="category" required>
                                <option value="">Select category</option>
                                <?php if (!empty($category)) {
                                    foreach ($category as $key) { ?>
                                        <option value="<?= $key['uid']; ?>"><?= $key['title']; ?></option>
                                <?php }
                                } ?>
                            </select>
                            <label for="category">Category <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <!-- Sub Category & Meta Title -->
                    <div class="col-md-6 col-lg-6">
                        <div class="form-floating">
                            <select class="form-control" name="subcategory" id="subcategory_id">
                                <option value="">Select Sub category</option>
                            </select>
                            <label for="subcategory_id">Sub Category <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="meta_title" id="meta_title"
                                placeholder="Enter Meta Title">
                            <label for="meta_title">Meta Title</label>
                        </div>
                    </div>

                    <!-- Meta Description & Meta Keywords -->
                    <div class="col-md-6 col-lg-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="meta_description" id="meta_description"
                                placeholder="Enter Meta Description">
                            <label for="meta_description">Meta Description</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="meta_keywords" id="meta_keywords"
                                placeholder="Enter Meta Keywords">
                            <label for="meta_keywords">Meta Keywords</label>
                        </div>
                    </div>

                    <!-- Meta Tags & (Hidden Price) -->
                    <div class="col-md-12 col-lg-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="meta_tags" id="meta_tags"
                                placeholder="Enter Meta Tags">
                            <label for="meta_tags">Meta Tags</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 d-none">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="product_price" id="product_price"
                                placeholder="Enter Product Price">
                            <label for="product_price">Product Price</label>
                        </div>
                    </div>

                    <!-- Description (Full Width) -->
                    <div class="col-lg-12">
                        <div class="form-floating">
                            <textarea class="form-control documentTextEditor"
                                name="description" id="description"
                                placeholder="Description" style="height: 120px;"></textarea>
                            <label for="description">Description</label>
                        </div>
                    </div>

                    <!-- Hidden Content -->
                    <textarea name="content" id="content" class="d-none"></textarea>

                    <!-- Images (Full Width) -->
                    <div class="col-lg-12">
                        <label>Upload Product Image (Single or Multiple)</label>
                        <input type="file" name="images[]" id="imageInput"
                            class="form-control" accept="image/*" multiple>
                    </div>

                    <div id="previewContainer" class="d-flex flex-wrap gap-2"></div>

                    <!-- Buttons -->
                    <div class="col-lg-12 d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-warning">RESET</button>
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </div>

                </div>

            </form>
        </div>
    </div>

    <!-- Image -->

    <!-- Image -->
    <script>
        $(document).ready(function() {
            $('#category').on('change', function() {
                let categoryId = $(this).val();

                if (categoryId) {
                    $.ajax({
                        url: BASE_URL + "/vendor/api/get-subcategories",
                        type: "GET",
                        data: {
                            categoryId: categoryId
                        },
                        dataType: "json",
                        success: function(res) {
                            $('#subcategory_id').empty().append('<option value="">Select Sub category</option>');

                            if (res.success && res.data && res.data.data.length > 0) {
                                res.data.data.forEach(function(subcat) {
                                    $('#subcategory_id').append(
                                        `<option value="${subcat.uid}">${subcat.title}</option>`
                                    );
                                });
                            } else {
                                $('#subcategory_id').append('<option value="">No subcategories found</option>');
                            }
                        },
                        error: function() {
                            alert("Error loading subcategories.");
                        }
                    });
                } else {
                    $('#subcategory_id').empty().append('<option value="">Select Sub category</option>');
                }
            });

        });
    </script>
    <script>
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('previewContainer');
        let selectedImages = [];

        imageInput.addEventListener('change', (event) => {
            const files = Array.from(event.target.files);

            files.forEach((file) => {
                const reader = new FileReader();

                reader.onload = (e) => {
                    const imageUrl = e.target.result;

                    const wrapper = document.createElement('div');
                    wrapper.className = 'position-relative';
                    wrapper.style.width = '100px';
                    wrapper.style.height = '100px';

                    const img = document.createElement('img');
                    img.src = imageUrl;
                    img.className = 'img-thumbnail';
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.onclick = () => {
                        previewContainer.removeChild(wrapper);
                        selectedImages = selectedImages.filter(i => i !== file);
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                    previewContainer.appendChild(wrapper);
                    selectedImages.push(file);
                };

                reader.readAsDataURL(file);
            });

            imageInput.value = '';
        });

        $(document).ready(function() {
            $('#productForm').on('submit', function(e) {
                e.preventDefault();

                $('.text-danger').remove();
                let isValid = true;

                $('#productForm').find('input, textarea, select').each(function() {
                    const input = $(this);
                    const value = input.val().trim();
                    if (input.attr('required') && value === '') {
                        isValid = false;
                        input.after('<div class="text-danger mt-1">This field is required</div>');
                    }
                });

                if (!isValid) {
                    console.warn("Validation failed");
                    return;
                }

                const formData = new FormData(this);


                selectedImages.forEach(file => {
                    formData.append('images[]', file);
                });

                // // DEBUG LOG
                // for (let [key, value] of formData.entries()) {
                //     console.log(`${key}:`, value);
                // }
                // return;
                const $button = $('#saveButton');
                $button.prop('disabled', true).text('Loading...');

                $.ajax({
                    url: BASE_URL + '/vendor/api/product/created',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    complete: function(xhr) {
                        if (xhr.status === 200 || xhr.status === 201) {
                            window.location.href = BASE_URL + 'vendor/products';
                            return;
                        }
                        console.error('API Error:', xhr.responseText);
                        MessError.fire({
                            icon: 'error',
                            title: 'Upload failed. Try again.',
                        });

                        $('#saveButton').prop('disabled', false).text('SUBMIT');
                    }
                });

            });
        });
    </script>