<?= view('vendors/templates/html_editor.php'); ?>
<div class="content-body p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Product Details</h5>
        <button type="button" id="editBtn" class="btn btn-primary">
            Edit Product
        </button>
    </div>
    <div class="card p-4 shadow-sm">
        <?php
        $allImages = [];
        if (!empty($images) && is_array($images)) {
            foreach ($images as $img) {
                $allImages[] = [
                    'uid' => $img['uid'],
                    'image' => $img['image'],
                    'mainImage' => ($img['main_image'] == 1) ? true : false,
                ];
            }
        }
        ?>
        <?php
        if (!empty($allImages)) {
            usort($allImages, function ($a, $b) {
                return ($b['mainImage'] === true) <=> ($a['mainImage'] === true);
            });
        }
        ?>
        <div class="row g-3 mb-3">
            <?php foreach ($allImages as $index => $imgData) : ?>

                <div class="col-md-3 col-lg-2 text-center image-col">
                    <!-- Clickable Image -->
                    <div class="position-relative p-3 border rounded">
                        <img src="<?= base_url($imgData['image']) ?>" alt=""
                            class="img-fluid <?= $imgData['mainImage'] ? 'rounded-circle' : 'rounded' ?> border border-3 border-primary shadow"
                            style="width: 120px; height: 120px; object-fit: cover;">
                        <button class="btn p-0 m-0 border-0 shadow-none position-absolute" style="right:10px;top:10px;" onclick="productImageDelete('<?= $imgData['uid'] ?>')">
                            <svg width="30" height="30" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="250" cy="250" r="250" fill="#FF0000" />
                                <path d="M271.611 260.406H228.922C223.028 260.406 218.25 255.628 218.25 249.733C218.25 243.839 223.028 239.061 228.922 239.061H271.611C277.506 239.061 282.284 243.839 282.284 249.733C282.284 255.628 277.506 260.406 271.611 260.406Z" fill="white" />
                                <path d="M356.991 198.506H143.543C137.649 198.506 132.871 203.284 132.871 209.178C132.871 215.073 137.649 219.851 143.543 219.851H155.656L175.876 358.832C178.095 374.514 191.723 386.339 207.578 386.339H292.956C308.811 386.339 322.439 374.514 324.651 358.875L344.878 219.851H356.991C362.885 219.851 367.663 215.073 367.663 209.178C367.663 203.284 362.885 198.506 356.991 198.506ZM303.523 355.844C302.785 361.06 298.242 364.995 292.956 364.995H207.578C202.292 364.995 197.749 361.06 197.006 355.801L177.225 219.851H323.309L303.523 355.844Z" fill="white" />
                                <path d="M175.192 176.662C180.811 178.442 186.81 175.332 188.59 169.713L197.4 141.913C198.811 137.462 202.9 134.472 207.578 134.472H292.957C297.634 134.472 301.723 137.462 303.134 141.913L311.944 169.713C313.719 175.315 319.708 178.449 325.342 176.662C330.961 174.881 334.072 168.883 332.291 163.265L323.481 135.465C319.247 122.104 306.981 113.127 292.957 113.127H207.578C193.554 113.127 181.287 122.104 177.053 135.465L168.243 163.265C166.462 168.884 169.573 174.882 175.192 176.662Z" fill="white" />
                                <path d="M228.922 343.65C234.816 343.65 239.594 338.872 239.594 332.978V251.868C239.594 245.973 234.816 241.195 228.922 241.195C223.028 241.195 218.25 245.973 218.25 251.868V332.978C218.25 338.872 223.028 343.65 228.922 343.65Z" fill="white" />
                                <path d="M271.611 343.65C277.506 343.65 282.284 338.872 282.284 332.978V251.868C282.284 245.973 277.506 241.195 271.611 241.195C265.717 241.195 260.939 245.973 260.939 251.868V332.978C260.939 338.872 265.717 343.65 271.611 343.65Z" fill="white" />
                            </svg>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <form id="productForm" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div id="previewContainer" class="d-flex flex-wrap gap-2 col-12"></div>
                <div class="col-md-6">
                    <label class="mb-1 d-block" for="company_logo">Upload Product Image (Single or Multiple)</label>
                    <input type="file" name="images[]" id="imageInput" class="form-control" accept="image/*" multiple
                        disabled>
                </div>
                <div class="col-md-6">
                    <label class="mb-1 d-block" for="name">Product Name</label>
                    <input type="text" class="form-control" name="name" id="name"
                        value="<?= esc($resp['name'] ?? '') ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="mb-1 d-block" for="category">Category</label>
                    <select class="form-control" name="category" id="category" disabled>
                        <option value="">Select category</option>
                        <?php if (!empty($category)) {
                            foreach ($category as $key) { ?>
                                <option value="<?= $key['uid']; ?>"
                                    <?= ($resp['category_id'] ?? '') == $key['uid'] ? 'selected' : '' ?>>
                                    <?= $key['title']; ?>
                                </option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="mb-1 d-block" for="subcategory">Sub Category<span class="text-danger">*</span></label>
                    <select class="form-control" name="subcategory" id="subcategory_id" disabled>
                        <option value="">Select Sub category</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="mb-1 d-block">Meta Title</label>
                    <input
                        type="text"
                        class="form-control"
                        name="metaTitle"
                        id="metaTitle_id"
                        value="<?= esc($resp['meta_title'] ?? '') ?>"


                        readonly>
                </div>
                <div class="col-md-6">
                    <label class="mb-1 d-block">Meta Keywords</label>
                    <input
                        type="text"
                        class="form-control"
                        name="metaKeywords"
                        id="metaKeywords_id"
                        value="<?= esc($resp['meta_keywords'] ?? '') ?>"
                        readonly>
                </div>
                <div class="col-md-6">
                    <label class="mb-1 d-block">Meta Description</label>
                    <input
                        type="text"
                        class="form-control"
                        name="metaDescription"
                        id="metaDescription_id"
                        value="<?= esc($resp['meta_description'] ?? '') ?>"
                        readonly>
                </div>
                <div class="col-md-6">
                    <label class="mb-1 d-block">Meta Tags</label>
                    <input
                        type="text"
                        class="form-control"
                        name="metaTags"
                        id="metaTags_id"
                        value="<?= esc($resp['meta_tags'] ?? '') ?>"
                        readonly>
                </div>
                <div class="col-md-12">
                    <label class="mb-1 d-block " for="description">Short Description</label>
                    <textarea rows="10" cols="90" class="form-control documentTextEditor" name="description" id="description"
                        style="height: 120px;" readonly><?= esc($resp['description'] ?? '') ?></textarea>
                </div>
                <!-- <div class="col-md-12">
                    <label class="mb-1 d-block" for="description">Long Description</label>
                    <textarea rows="10" cols="90" class="form-control documentTextEditor" name="content" id="content"
                        style="height: 120px;" readonly><?= esc($resp['html_description'] ?? '') ?></textarea>
                </div> -->
                <!-- <div class="col-md-12 d-flex justify-content-end">
                    <button type="button" id="submitProductinputs" class="btn btn-primary">
                        Update
                    </button>
                </div> -->
                <div class="col-md-12 d-flex justify-content-end align-items-center gap-3">
                    <!-- Approval Toggle -->
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-semibold">Approved</span>

                        <div class="form-check form-switch m-0">
                            <input class="form-check-input"
                                type="checkbox"
                                id="approvalToggle"
                                <?= ($resp['is_admin_allow'] ?? 0) == 1 ? 'checked' : '' ?>
                               onchange="handleApprovalToggle(this, '<?= $resp['uid'] ?? '' ?>')">

                        </div>
                    </div>
                    <!-- Update Button -->
                    <button type="button"
                        id="submitProductinputs"
                        class="btn btn-primary">
                        Update
                    </button>
                </div>


            </div>
        </form>
    </div>
</div>





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

    // Submit logic
    document.getElementById('submitProductinputs').addEventListener('click', function() {
        const formData = new FormData();


        formData.append('uid', '<?= $resp['uid'] ?? "" ?>');


        formData.append('name', document.getElementById('name').value);
        formData.append('description', document.getElementById('description').value);
        formData.append('category', document.getElementById('category').value);
        formData.append('subcategory', document.getElementById('subcategory_id').value);
        formData.append('metaTitle', document.getElementById('metaTitle_id').value);
        formData.append('metaKeywords', document.getElementById('metaKeywords_id').value);
        formData.append('metaDescription', document.getElementById('metaDescription_id').value);
        formData.append('metaTags', document.getElementById('metaTags_id').value);

        selectedImages.forEach((file) => {
            formData.append('images[]', file);
        });
        for (let [key, value] of formData.entries()) {
            // console.log(key + ":", value);
        }

        // console.log(formData);
        $.ajax({
            url: BASE_URL + "/admin/api/product/edit-product",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {

                    MessError.fire({
                        icon: 'success',
                        title: 'Product updated successfully.',
                    });
                    // location.reload();
                    window.location.assign(BASE_URL + "/admin/products");

                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function() {
                alert("An error occurred while updating the product.");
            }
        });
    });
</script>

<script>
    function productImageDelete(imageID) {
        // console.log("Deleting image with ID:", imageID);

        if (confirm("Are you sure you want to delete this image?")) {
            $.ajax({
                url: BASE_URL + "/admin/api/product/image-delete",
                type: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify({
                    uid: imageID
                }),
                success: function(response) {
                    if (response.success) {

                        MessError.fire({
                            icon: 'success',
                            title: 'Image deleted successfully.',
                        });
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert("Error deleting image: " + response.message);
                    }
                },
                error: function() {
                    alert("An error occurred while deleting the image.");
                }
            });
        }

    }

    function handleApprovalToggle(toggle, uid) {

    const newStatus = toggle.checked ? 1 : 0;

    Swal.fire({
        title: "Are you sure?",
        text: toggle.checked
            ? "Do you want to approve this product?"
            : "Do you want to revoke approval?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        reverseButtons: true
    }).then((result) => {

        if (!result.isConfirmed) {
            toggle.checked = !toggle.checked; // revert
            return;
        }

        // Call API only after confirmation
        fetch(BASE_URL + "/admin/api/product/approval", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                uid: uid,
                is_admin_allow: newStatus
            })
        })
        .then(res => res.json())
        .then(data => {

            if (data.success) {
                MessSuccess.fire({
                    icon: "success",
                    title: newStatus
                        ? "Product approved successfully!"
                        : "Approval revoked successfully!"
                });
            } else {
                toggle.checked = !toggle.checked;
                Swal.fire("Error", data.message, "error");
            }
        })
        .catch(() => {
            toggle.checked = !toggle.checked;
            Swal.fire("Error", "Something went wrong", "error");
        });
    });
}

</script>

<script>
    document.getElementById('editBtn').addEventListener('click', function() {
        let form = document.getElementById('productForm');
        let inputs = form.querySelectorAll('input, select, textarea');

        inputs.forEach(el => {
            if (el.hasAttribute('readonly') || el.hasAttribute('disabled')) {
                el.removeAttribute('readonly');
                el.removeAttribute('disabled');
            } else {
                el.setAttribute('readonly', true);
                if (el.tagName.toLowerCase() === 'select') el.setAttribute('disabled', true);
            }
        });

        this.textContent = this.textContent === 'Edit' ? 'Lock' : 'Edit';
    });

    const preselectedSubcategory = "<?= $resp['subcategory_id'] ?? '' ?>";
    // console.log(" === ", preselectedSubcategory);

    $(document).ready(function() {

        $('#category').on('change', function() {
            let categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: BASE_URL + "/admin/categories/get-subcategories",
                    type: "POST",
                    data: {
                        parent_uid: categoryId
                    },
                    dataType: "json",
                    success: function(res) {

                        $('#subcategory_id')
                            .empty()
                            .append('<option value="">Select Sub category</option>');

                        if (res.success && Array.isArray(res.data) && res.data.length > 0) {

                            $('#subcategory_id').closest('.col-md-6').show();

                            res.data.forEach(function(subcat) {

                                let selected =
                                    String(subcat.uid).trim() ===
                                    String(preselectedSubcategory).trim() ?
                                    "selected" :
                                    "";

                                $('#subcategory_id').append(
                                    `<option value="${subcat.uid}" ${selected}>${subcat.title}</option>`
                                );
                            });

                            if (preselectedSubcategory) {
                                $('#subcategory_id').val(preselectedSubcategory);
                            }

                        } else {
                            $('#subcategory_id').closest('.col-md-6').hide();
                        }
                    }
                });
            }
        });

        if ($("#category").val()) {
            $("#category").trigger("change");
        }
    });
</script>