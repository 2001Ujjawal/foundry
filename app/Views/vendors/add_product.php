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
                            <select class="form-control" name="subcategory" id="subcategory_id" required>
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



    <!-- 
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

            imageInput.value = ''; // reset for re-selecting same image
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

                // Append manually tracked image files
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
                    success: function(response) {
                        window.location.href = BASE_URL + 'vendor/products';
                    },
                    error: function(xhr) {
                        console.error('API Error:', xhr.responseText);
                        MessError.fire({
                            icon: 'error',
                            title: 'Upload failed. Try again.',
                        });
                    },
                    complete: function() {
                        $button.prop('disabled', false).text('SUBMIT');
                    }
                });
            });
        });
    </script> -->

    <script>
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('previewContainer');
        let selectedImages = [];

        previewContainer.addEventListener('dragover', e => {
            e.preventDefault();
            previewContainer.classList.add('border-primary');
        });

        previewContainer.addEventListener('dragleave', () => {
            previewContainer.classList.remove('border-primary');
        });

        previewContainer.addEventListener('drop', e => {
            e.preventDefault();
            previewContainer.classList.remove('border-primary');
            handleFiles(Array.from(e.dataTransfer.files));
        });

        imageInput.addEventListener('change', (event) => {
            handleFiles(Array.from(event.target.files));
            imageInput.value = '';
        });


        function handleFiles(files) {
            files.forEach(file => {
                if (!file.type.startsWith('image/')) return;

                const reader = new FileReader();
                reader.onload = e => compressImage(e.target.result, file.name);
                reader.readAsDataURL(file);
            });
        }

        function compressImage(src, filename) {
            const img = new Image();
            img.src = src;

            img.onload = () => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                canvas.width = 1200;
                canvas.height = 800;

                ctx.fillStyle = '#fff';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(img, 0, 0, 1200, 800);

                let quality = 0.8;
                let blob;

                do {
                    blob = dataURLtoBlob(canvas.toDataURL('image/jpeg', quality));
                    quality -= 0.02;
                } while (blob.size > 150 * 1024 && quality >= 0.75);

                const compressedFile = new File(
                    [blob],
                    filename.replace(/\.(png|webp)$/i, '.jpg'), {
                        type: 'image/jpeg'
                    }
                );

                selectedImages.push(compressedFile);
                renderPreview(URL.createObjectURL(blob), compressedFile);
            };
        }

        function renderPreview(imageUrl, file) {
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
        }

        function dataURLtoBlob(dataURL) {
            const arr = dataURL.split(',');
            const mime = arr[0].match(/:(.*?);/)[1];
            const bstr = atob(arr[1]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);
            while (n--) u8arr[n] = bstr.charCodeAt(n);
            return new Blob([u8arr], {
                type: mime
            });
        }


        $(document).ready(function() {
            $('#productForm').on('submit', function(e) {
                e.preventDefault();

                $('.text-danger').remove();
                let isValid = true;

                $('#productForm').find('input, textarea, select').each(function() {
                    const input = $(this);
                    if (input.attr('required') && !input.val().trim()) {
                        isValid = false;
                        input.after('<div class="text-danger mt-1">This field is required</div>');
                    }
                });

                if (!isValid) return;

                const formData = new FormData(this);
                selectedImages.forEach(file => {
                    formData.append('images[]', file);
                });

                const $button = $('#saveButton');
                $button.prop('disabled', true).text('Loading...');

                $.ajax({
                    url: BASE_URL + '/vendor/api/product/created',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: () => {
                        window.location.href = BASE_URL + 'vendor/products';
                    },
                    error: xhr => {
                        console.error(xhr.responseText);
                        MessError.fire({
                            icon: 'error',
                            title: 'Upload failed. Try again.'
                        });
                    },
                    complete: () => {
                        $button.prop('disabled', false).text('SUBMIT');
                    }
                });
            });
        });
    </script>