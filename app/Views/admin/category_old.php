<div class="content-body p-3">
    <div class="mt-4 rounded-10 bg-white border">
        <div class="p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="m-0 h5 fw-600">List of Category</div>
                <div class="">
                    <a href="#" class="btn btn-primary d-flex align-items-center gap-2 py-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i style="line-height: 0;">
                            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.8571 9.64286H9.14286V15.3571C9.14286 15.6602 9.02245 15.9509 8.80812 16.1653C8.59379 16.3796 8.30311 16.5 8 16.5C7.6969 16.5 7.40621 16.3796 7.19188 16.1653C6.97755 15.9509 6.85714 15.6602 6.85714 15.3571V9.64286H1.14286C0.839753 9.64286 0.549063 9.52245 0.334735 9.30812C0.120408 9.09379 0 8.80311 0 8.5C0 8.1969 0.120408 7.90621 0.334735 7.69188C0.549063 7.47755 0.839753 7.35714 1.14286 7.35714H6.85714V1.64286C6.85714 1.33975 6.97755 1.04906 7.19188 0.834735C7.40621 0.620407 7.6969 0.5 8 0.5C8.30311 0.5 8.59379 0.620407 8.80812 0.834735C9.02245 1.04906 9.14286 1.33975 9.14286 1.64286V7.35714H14.8571C15.1602 7.35714 15.4509 7.47755 15.6653 7.69188C15.8796 7.90621 16 8.1969 16 8.5C16 8.80311 15.8796 9.09379 15.6653 9.30812C15.4509 9.52245 15.1602 9.64286 14.8571 9.64286Z" fill="white"></path>
                            </svg>
                        </i>
                        <span>Add Category</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="px-3 pb-3">
            <table class="dataTable display border">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Path</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($resp)) {
                        foreach ($resp as $row) {
                    ?>
                            <tr>
                                <td>
                                    <div class="fw-600 h6 m-0"><?= $row['title']; ?></div>
                                </td>
                                <td>
                                    <?php if (!empty($row['image'])) { ?>
                                        <img src="<?= base_url($row['image']) ?>" alt="Vendor Image" style="width: 40px; height: 40px;">
                                    <?php } else { ?>

                                    <?php } ?>
                                </td>
                                <td>
                                    <div class="fw-600 h6 m-0"><?= $row['path_name'] ?? "--"; ?></div>
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <?php if ($row['status'] != 'deleted') { ?>
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked_<?= $row['id']; ?>"
                                                onchange="handleStatusChange(this, '<?= $row['uid']; ?>')"
                                                <?= ($row['status'] == ACTIVE_STATUS) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                        <?php } ?>
                                    </div>
                                </td>

                                <td style="max-width: 120px;">
                                    <div class="d-flex align-items-center gap-3">
                                        <!-- <button onclick="viewPatient('<?= $row['uid']; ?>')" class="btnico">
                                            <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M22 8C22 7.52133 21.7567 7.208 21.27 6.57867C19.4889 4.28 15.5605 0 11 0C6.43945 0 2.51106 4.28 0.729989 6.57867C0.24333 7.208 0 7.52133 0 8C0 8.47867 0.24333 8.792 0.729989 9.42133C2.51106 11.72 6.43945 16 11 16C15.5605 16 19.4889 11.72 21.27 9.42133C21.7567 8.792 22 8.47867 22 8ZM11 12C11.998 12 12.9551 11.5786 13.6607 10.8284C14.3664 10.0783 14.7628 9.06087 14.7628 8C14.7628 6.93913 14.3664 5.92172 13.6607 5.17157C12.9551 4.42143 11.998 4 11 4C10.002 4 9.04495 4.42143 8.33928 5.17157C7.63361 5.92172 7.23717 6.93913 7.23717 8C7.23717 9.06087 7.63361 10.0783 8.33928 10.8284C9.04495 11.5786 10.002 12 11 12Z" fill="#0D9488" />
                                            </svg>
                                        </button> -->

                                        <button class="btnico"
                                            onclick="openEditModal(this)"
                                            data-uid="<?= $row['uid']; ?>"
                                            data-name="<?= htmlspecialchars($row['title']); ?>"
                                            data-path="<?= htmlspecialchars($row['path']);   ?>"
                                            data-image="<?= htmlspecialchars($row['image']); ?>">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.58062 1.83914H2.68458C2.2378 1.83914 1.80932 2.01662 1.4934 2.33253C1.17748 2.64844 1 3.07691 1 3.52368V15.3154C1 15.7622 1.17748 16.1907 1.4934 16.5066C1.80932 16.8225 2.2378 17 2.68458 17H14.4767C14.9234 17 15.3519 16.8225 15.6678 16.5066C15.9838 16.1907 16.1612 15.7622 16.1612 15.3154V9.41955"
                                                    stroke="#6C757D" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M13.9511 1.52332C14.2862 1.18824 14.7407 1 15.2146 1C15.6884 1 16.1429 1.18824 16.478 1.52332C16.8131 1.85839 17.0013 2.31285 17.0013 2.78672C17.0013 3.26059 16.8131 3.71505 16.478 4.05012L8.88643 11.6423C8.68643 11.8422 8.43935 11.9884 8.16795 12.0677L5.74805 12.7752C5.67557 12.7963 5.59875 12.7976 5.52561 12.7788C5.45247 12.7601 5.38572 12.7221 5.33234 12.6687C5.27895 12.6153 5.2409 12.5485 5.22216 12.4754C5.20342 12.4023 5.20469 12.3254 5.22583 12.253L5.93336 9.83314C6.01297 9.56197 6.15954 9.31519 6.35955 9.11552L13.9511 1.52332Z"
                                                    stroke="#6C757D" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <button class="btnico" onclick="deleteCategory('<?= $row['uid'] ?>')">
                                            <svg width="15" height="18" viewBox="0 0 15 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.0991 1.99469L10.3566 3.71154H13.8419C14.0167 3.71154 14.1843 3.7784 14.3079 3.89741C14.4315 4.01643 14.501 4.17784 14.501 4.34615C14.501 4.51446 14.4315 4.67588 14.3079 4.79489C14.1843 4.91391 14.0167 4.98077 13.8419 4.98077H13.1661L12.3989 13.5988C12.3523 14.1235 12.3146 14.555 12.2539 14.9036C12.1924 15.2666 12.0984 15.5915 11.9147 15.8928C11.6263 16.3659 11.1975 16.7451 10.6835 16.9818C10.3566 17.1315 10.0121 17.1933 9.63073 17.2221C9.26428 17.25 8.81522 17.25 8.26861 17.25H6.23334C5.68673 17.25 5.23767 17.25 4.87122 17.2221C4.48982 17.1933 4.14534 17.1315 3.81843 16.9818C3.30441 16.7451 2.87565 16.3659 2.58725 15.8928C2.4027 15.5915 2.31043 15.2666 2.24804 14.9036C2.1874 14.5542 2.14961 14.1235 2.10304 13.5988L1.33586 4.98077H0.660067C0.485266 4.98077 0.317623 4.91391 0.19402 4.79489C0.0704162 4.67588 0.000976562 4.51446 0.000976562 4.34615C0.000976562 4.17784 0.0704162 4.01643 0.19402 3.89741C0.317623 3.7784 0.485266 3.71154 0.660067 3.71154H4.14534L4.40282 1.99469L4.41249 1.94308C4.57243 1.27462 5.16825 0.75 5.91522 0.75H8.58673C9.3337 0.75 9.92952 1.27462 10.0895 1.94308L10.0991 1.99469ZM5.4767 3.71154H9.02437L8.7994 2.20877C8.75722 2.06746 8.65001 2.01923 8.58586 2.01923H5.9161C5.85195 2.01923 5.74473 2.06746 5.70255 2.20877L5.4767 3.71154ZM6.59189 7.73077C6.59189 7.56246 6.52245 7.40104 6.39884 7.28203C6.27524 7.16302 6.1076 7.09615 5.93279 7.09615C5.75799 7.09615 5.59035 7.16302 5.46675 7.28203C5.34314 7.40104 5.2737 7.56246 5.2737 7.73077V11.9615C5.2737 12.1298 5.34314 12.2913 5.46675 12.4103C5.59035 12.5293 5.75799 12.5962 5.93279 12.5962C6.1076 12.5962 6.27524 12.5293 6.39884 12.4103C6.52245 12.2913 6.59189 12.1298 6.59189 11.9615V7.73077ZM9.22825 7.73077C9.22825 7.56246 9.15881 7.40104 9.03521 7.28203C8.9116 7.16302 8.74396 7.09615 8.56916 7.09615C8.39436 7.09615 8.22671 7.16302 8.10311 7.28203C7.97951 7.40104 7.91007 7.56246 7.91007 7.73077V11.9615C7.91007 12.1298 7.97951 12.2913 8.10311 12.4103C8.22671 12.5293 8.39436 12.5962 8.56916 12.5962C8.74396 12.5962 8.9116 12.5293 9.03521 12.4103C9.15881 12.2913 9.22825 12.1298 9.22825 11.9615V7.73077Z"
                                                    fill="#AB3D3C" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add module -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="categoryForm" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-control" name="category" id="category">
                                <option value="">Select Category</option>
                                <?php
                                if (!empty($category)) {
                                    foreach ($category as $key) {
                                ?>
                                        <option value="<?= $key['uid']; ?>"><?= $key['title']; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Image</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="saveButton" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add module -->

    <!-- Edit module -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editCategoryModalForm" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Update Category Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Vendor ID (Hidden) -->
                        <input type="hidden" id="editCategoryUid" name="categoryUid">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" id="editName" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-control" name="path" id="editPath">
                                <option value="">Select Category</option>
                                <?php
                                if (!empty($category)) {
                                    foreach ($category as $key) {
                                ?>
                                        <option value="<?= $key['uid']; ?>"><?= $key['title']; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <!-- Upload Image -->
                        <div class="mb-3">
                            <label class="form-label">Upload Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                        <!-- Show old image -->
                        <div class="mb-3" id="oldImagePreview" style="display: none;">
                            <label class="form-label">Old Image</label><br>
                            <img id="categoryOldImage" src="" alt="category Image" width="100" class="img-thumbnail">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="editBtn" type="submit" class="btn btn-primary">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- Edit module -->

    <script>
        /** Created */
        $(document).ready(function() {
            $('#categoryForm').on('submit', function(e) {
                e.preventDefault();

                $('.text-danger').remove();
                let isValid = true;
                let formData = new FormData(this);

                $('#categoryForm input, #categoryForm select').each(function() {
                    const input = $(this);
                    const name = input.attr('name');
                    const value = input.val().trim();
                    if (name !== 'category' && value === '') {
                        isValid = false;
                        input.after('<div class="text-danger mt-1">This field is required</div>');
                    }
                });
                if (!isValid) {
                    return;
                }

                const $button = $('#saveButton');
                $button.prop('disabled', true).text('Loading...');

                $.ajax({
                    url: BASE_URL + '/admin/api/category/created',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        MessSuccess.fire({
                            icon: 'success',
                            title: response.message || 'Category Add Successful',
                        });
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        MessError.fire({
                            icon: 'error',
                            title: 'An error occurred. Please try again.',
                        });
                    }
                });
            });
        });
        /** Created */

        /** Update */
        function openEditModal(button) {
            const btn = $(button);
            $('#editCategoryUid').val(btn.data('uid'));
            $('#editName').val(btn.data('name'));
            $('#editPath').val(btn.data('path'));

            const imageUrl = btn.data('image');

            if (imageUrl) {
                const fullImageUrl = BASE_URL + '/' + imageUrl;
                $('#categoryOldImage').attr('src', fullImageUrl).show();
                $('#oldImagePreview').show();
            } else {
                $('#categoryOldImage').hide();
                $('#oldImagePreview').hide();
            }
            $('#editCategoryModal').modal('show');
        }
        $(document).ready(function() {
            $('#editCategoryModalForm').on('submit', function(e) {
                e.preventDefault();

                $('.text-danger').remove();
                let isValid = true;
                let formData = new FormData(this);

                $('#editcategoryForm input, #editcategoryForm select').each(function() {
                    const input = $(this);
                    const name = input.attr('name');
                    const value = input.val().trim();
                    if (name !== 'category' && value === '') {
                        isValid = false;
                        input.after('<div class="text-danger mt-1">This field is required</div>');
                    }
                });
                if (!isValid) {
                    return;
                }

                const $button = $('#editBtn');
                $button.prop('disabled', true).text('Loading...');
                $.ajax({
                    url: BASE_URL + '/admin/api/category/update',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        MessSuccess.fire({
                            icon: 'success',
                            title: response.message || 'Update Successful',
                        });
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        MessError.fire({
                            icon: 'error',
                            title: 'An error occurred. Please try again.',
                        });
                    }
                });
            });
        });
        /** Update */

        /** Deleted */
        function deleteCategory(uid) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this Category?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteCategoryDetails(uid);
                }
            });
        }

        function deleteCategoryDetails(uid) {
            const formData = new FormData();
            formData.append('uid', uid);

            $.ajax({
                url: BASE_URL + '/admin/api/category/delete',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    MessSuccess.fire({
                        icon: 'success',
                        title: response.message || 'Vendor deleted successfully',
                    });
                    location.reload();
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    MessError.fire({
                        icon: 'error',
                        title: 'An error occurred. Please try again.',
                    });
                }
            });
        }
        /** Deleted */

        /** Update Status */
        function handleStatusChange(checkbox, uid) {
            const status = checkbox.checked ? 'active' : 'inactive';
            fetch(BASE_URL + '/admin/api/category/update-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        uid: uid,
                        status: status
                    }),
                })
                .then(response => response.json())
                .then(data => {

                })
                .catch(error => {
                    console.error("Error updating status:", error);
                    alert("Failed to update status");
                });
        }
        /** Update Status */
    </script>
    apps-fileview.texmex_20250814.00_p1
    category.php
    Displaying category.php.