<div class="content-body p-3">
    <div class="mt-4 rounded-10 bg-white border">
        <div class="p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="m-0 h5 fw-600">List of Category</div>
                <div class="">
                    <a href="#" class="btn btn-primary d-flex align-items-center gap-2 py-2" data-bs-toggle="modal"
                        data-bs-target="#addCategoryModal">
                        <i style="line-height: 0;">
                            <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.8571 9.64286H9.14286V15.3571C9.14286 15.6602 9.02245 15.9509 8.80812 16.1653C8.59379 16.3796 8.30311 16.5 8 16.5C7.6969 16.5 7.40621 16.3796 7.19188 16.1653C6.97755 15.9509 6.85714 15.6602 6.85714 15.3571V9.64286H1.14286C0.839753 9.64286 0.549063 9.52245 0.334735 9.30812C0.120408 9.09379 0 8.80311 0 8.5C0 8.1969 0.120408 7.90621 0.334735 7.69188C0.549063 7.47755 0.839753 7.35714 1.14286 7.35714H6.85714V1.64286C6.85714 1.33975 6.97755 1.04906 7.19188 0.834735C7.40621 0.620407 7.6969 0.5 8 0.5C8.30311 0.5 8.59379 0.620407 8.80812 0.834735C9.02245 1.04906 9.14286 1.33975 9.14286 1.64286V7.35714H14.8571C15.1602 7.35714 15.4509 7.47755 15.6653 7.69188C15.8796 7.90621 16 8.1969 16 8.5C16 8.80311 15.8796 9.09379 15.6653 9.30812C15.4509 9.52245 15.1602 9.64286 14.8571 9.64286Z"
                                    fill="white"></path>
                            </svg>
                        </i>
                        <span>Add Category</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="px-3 pb-3">
            <table id="categoryTable" class=" display border">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Title</th>
                        <th>Image</th>
                        <!-- <th>Path</th> -->
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($resp)) {
                        $i = 1;
                        foreach ($resp as $row) {
                            // if this row has a title → it's a parent category
                            if (!empty($row['title'])) { ?>
                                <tr>
                                    <td>
                                        <div class="text-nowrap text-center"><?= $i++; ?></div>
                                    </td>
                                    <td>
                                        <div class="fw-600 h6 m-0"><?= $row['title']; ?></div>
                                    </td>
                                    <td>
                                        <?php if (!empty($row['image'])) { ?>
                                            <img src="<?= base_url($row['image']) ?>" style="width:40px;height:40px;">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch d-flex justify-content-center">
                                            <?php if ($row['status'] != 'deleted') { ?>
                                                <input type="checkbox" class="form-check-input"
                                                    id="flexSwitchCheckChecked_<?= $row['id']; ?>"
                                                    onchange="handleStatusChange(this, '<?= $row['uid']; ?>')"
                                                    <?= ($row['status'] == ACTIVE_STATUS) ? 'checked' : ''; ?>>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <button class="btnico"
                                                onclick="openEditModal(this)"
                                                data-uid="<?= $row['uid']; ?>"
                                                data-name="<?= htmlspecialchars($row['title']); ?>"
                                                data-path="<?= htmlspecialchars($row['path']); ?>"
                                                data-image="<?= htmlspecialchars($row['image']); ?>">
                                                ✏️
                                            </button>
                                            <button class="btnico" onclick="deleteCategory('<?= $row['uid'] ?>')">🗑️</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php }

                            // if this row has subcategories → loop them
                            if (!empty($row['subcategories'])) {
                                foreach ($row['subcategories'] as $subRow) { ?>
                                    <tr>
                                        <td>
                                            <div class="text-nowrap text-center"><?= $i++; ?></div>
                                        </td>
                                        <td>
                                            <div><?= $subRow['title']; ?></div>
                                        </td>
                                        <td>
                                            <?php if (!empty($subRow['image'])) { ?>
                                                <img src="<?= base_url($subRow['image']) ?>" style="width:40px;height:40px;">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch d-flex justify-content-center">
                                                <?php if ($subRow['status'] != 'deleted') { ?>
                                                    <input type="checkbox" class="form-check-input"
                                                        id="flexSwitchCheckChecked_<?= $subRow['id']; ?>"
                                                        onchange="handleStatusChange(this, '<?= $subRow['uid']; ?>')"
                                                        <?= ($subRow['status'] == ACTIVE_STATUS) ? 'checked' : ''; ?>>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <button class="btnico"
                                                    onclick="openEditModal(this)"
                                                    data-uid="<?= $subRow['uid']; ?>"
                                                    data-name="<?= htmlspecialchars($subRow['title']); ?>"
                                                    data-path="<?= htmlspecialchars($subRow['path']); ?>"
                                                    data-image="<?= htmlspecialchars($subRow['image']); ?>">
                                                    ✏️
                                                </button>
                                                <button class="btnico" onclick="deleteCategory('<?= $subRow['uid'] ?>')">🗑️</button>
                                            </div>
                                        </td>
                                    </tr>
                    <?php }
                            }
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add module -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="categoryForm" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Parent Category</label>
                            <select class="form-control" name="category" id="category">
                                <option value="">Select Parent Category</option>
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
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
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
                            <label class="form-label">Category</label>
                            <input type="text" id="editName" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Parent Category</label>
                            <select class="form-control" name="path" id="editPath">
                                <option value="">Select Parent Category</option>
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

        $(document).ready(function() {
            $('#categoryTable').DataTable({
                columnDefs: [{
                        //type: 'num',
                        targets: 0
                    } // if first column is numeric ID
                ],
                order: [
                    [0, 'asc']
                ]
            });
        });




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
        // function openEditModal(button) {
        //     const btn = $(button);
        //     $('#editCategoryUid').val(btn.data('uid'));
        //     $('#editName').val(btn.data('name'));
        //     $('#editPath').val(btn.data('path'));

        //     const imageUrl = btn.data('image');

        //     if (imageUrl) {
        //         const fullImageUrl = BASE_URL + '/' + imageUrl;
        //         $('#categoryOldImage').attr('src', fullImageUrl).show();
        //         $('#oldImagePreview').show();
        //     } else {
        //         $('#categoryOldImage').hide();
        //         $('#oldImagePreview').hide();
        //     }
        //     $('#editCategoryModal').modal('show');
        // }

        function openEditModal(button) {
    const btn = $(button);

    const uid  = btn.data('uid');
    const name = btn.data('name');
    const path = btn.data('path'); // parent uid OR empty

    $('#editCategoryUid').val(uid);
    $('#editName').val(name);
    $('#editPath').val(path ?? '');

    // 🔥 Store category type
    if (path) {
        $('#editCategoryModalForm').attr('data-type', 'child');
    } else {
        $('#editCategoryModalForm').attr('data-type', 'parent');
    }

    // Image preview
    const imageUrl = btn.data('image');
    if (imageUrl) {
        $('#categoryOldImage').attr('src', BASE_URL + '/' + imageUrl);
        $('#oldImagePreview').show();
    } else {
        $('#oldImagePreview').hide();
    }

    $('#editCategoryModal').modal('show');
}




        $(document).ready(function() {
            // $('#editCategoryModalForm').on('submit', function(e) {
            //     e.preventDefault();

            //     $('.text-danger').remove();
            //     let isValid = true;
            //     let formData = new FormData(this);

            //     $('#editCategoryModalForm input, #editCategoryModalForm select').each(function() {
            //         const input = $(this);
            //         const name = input.attr('name');
            //         const value = input.val().trim();
            //         if (name !== 'category' && value === '') {
            //             isValid = false;
            //             input.after('<div class="text-danger mt-1">This field is required</div>');
            //         }
            //     });
            //     if (!isValid) {
            //         return;
            //     }

            //     const $button = $('#editBtn');
            //     $button.prop('disabled', true).text('Loading...');
            //     $.ajax({
            //         url: BASE_URL + '/admin/api/category/update',
            //         method: 'POST',
            //         data: formData,
            //         processData: false,
            //         contentType: false,
            //         success: function(response) {
            //             MessSuccess.fire({
            //                 icon: 'success',
            //                 title: response.message || 'Update Successful',
            //             });
            //             location.reload();
            //         },
            //         error: function(xhr) {
            //             console.error('Error:', xhr.responseText);
            //             MessError.fire({
            //                 icon: 'error',
            //                 title: 'An error occurred. Please try again.',
            //             });
            //         }
            //     });
            // });

            $('#editCategoryModalForm').on('submit', function (e) {
    e.preventDefault();

    $('.text-danger').remove();
    let isValid = true;

    const categoryType = $(this).attr('data-type'); // parent | child
    const name = $('#editName').val().trim();
    const path = $('#editPath').val().trim();

    // Category name always required
    if (name === '') {
        isValid = false;
        $('#editName').after('<div class="text-danger mt-1">Category name is required</div>');
    }

    // 🔥 Only child category requires sub-category
    if (categoryType === 'child' && path === '') {
        isValid = false;
        $('#editPath').after('<div class="text-danger mt-1">Sub Category is required</div>');
    }

    if (!isValid) return;

    const formData = new FormData(this);
    $('#editBtn').prop('disabled', true).text('Loading...');

    $.ajax({
        url: BASE_URL + '/admin/api/category/update',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            MessSuccess.fire({
                icon: 'success',
                title: response.message || 'Update Successful',
            });
            location.reload();
        },
        error: function () {
            MessError.fire({
                icon: 'error',
                title: 'Something went wrong',
            });
            $('#editBtn').prop('disabled', false).text('Update');
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