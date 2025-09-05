<div class="content-body p-3">
    <div class="mt-4 rounded-10 bg-white border">

        <div class="p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="m-0 h5 fw-600">List of Products</div>
            </div>
        </div>

        <div class="px-3 pb-3">
            <table id="tableProduct" class="display border">
                <thead>
                    <tr>
                        <th class="text-start">Vendor Details</th>
                        <th>Product Name</th>
                        <!-- <th>Image</th> -->
                        <th>Category</th>
                        <th>Sort No</th>
                        <th>Approval</th>
                        <th>Sponsored</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($resp)) {
                        foreach ($resp as $row) {
                    ?>
                            <tr>
                                <td>
                                    <div class="text-nowrap text-start">
                                        <div><?= $row['vendor_name']; ?></div>
                                        <small class="text-muted d-block">Email: <?= $row['vendor_email']; ?></small>
                                        <small class="text-muted d-block">Mob: <?= $row['vendor_mobile']; ?></small>
                                    </div>
                                </td>
                                <td>
                                    <div><?= $row['name']; ?></div>
                                </td>
                                <!-- <td>
                                    <?php if (!empty($row['image'])) { ?>
                                        <img src="<?= base_url($row['image']) ?>" alt="Vendor Image" style="width: 40px; height: 40px;">
                                    <?php } else { ?>

                                    <?php } ?>
                                </td> -->
                                <td>
                                    <div><?= $row['category_name']; ?></div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="number"
                                            class="form-control form-control-sm sort-order-input"
                                            value="<?= esc($row['sort_order']) ?>"
                                            data-id="<?= esc($row['uid']) ?>"
                                            style="width:70px;" />
                                    </div>
                                </td>

                                <td>
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="productVerify_<?= $row['uid']; ?>"
                                            onchange="productApproval(this, '<?= $row['uid']; ?>')"
                                            <?= $row['is_admin_allow'] == 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="productVerify_<?= $row['uid']; ?>"></label>
                                    </div>

                                </td>

                                <td>
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="productVerify_<?= $row['uid']; ?>"
                                            onchange="productVerify(this, '<?= $row['uid']; ?>')"
                                            <?= $row['is_verify'] == 1 ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="productVerify_<?= $row['uid']; ?>"></label>
                                    </div>

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
                                <td><?= $row['created_at'] ?></td>
                                <td style="max-width: 120px;">
                                    <div class="d-flex align-items-center gap-3">
                                        <a href="<?php echo base_url('admin/view-product/' . $row['uid']) ?>" class="btnico">
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
                                        </a>


                                        <button class="btnico" onclick="deleteProduct('<?= $row['uid'] ?>')">
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
    <script>
        /**
         *  This Function Work For Product OrderIng  Only For Sponsored Product 
         *  On Click 
         */
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(e) {
                document.querySelectorAll('.sort-order-input').forEach(input => {
                    if (input.contains(e.target)) return;

                    let newValue = input.value;
                    let productId = input.dataset.id;
                    let lastValue = input.dataset.last || "";

                    if (lastValue !== newValue) {
                        input.dataset.last = newValue;

                        fetch(BASE_URL + 'admin/api/product/ordering', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    uid: productId,
                                    sort: newValue
                                })
                            })
                            .then(r => r.json())
                            .then(json => {
                                if (json.success) {
                                    MessSuccess.fire({
                                        icon: 'success',
                                        title: json.message || "Product sorting updated successfully",
                                    });
                                 
                                } else {
                                    MessSuccess.fire({
                                        icon: 'error',
                                        title: json.message || "Failed to update product sorting",
                                    });
                                }
                            })
                            .catch(() => {
                                MessSuccess.fire({
                                    icon: 'error',
                                    title: "Network error",
                                });
                            });
                    }
                });
            });

            // Initialize last value per input
            document.querySelectorAll('.sort-order-input').forEach(input => {
                input.dataset.last = input.value;
            });
        });
    </script>


    <script>
        function productApproval(checkbox, uid) {

            let willBeVerified = checkbox.checked;


            let title = willBeVerified ? "Are you sure?" : "Are you sure?";
            let text = willBeVerified ?
                "Do you want to approval this product?" :
                "Do you want to mark this product as NOT approval?";

            Swal.fire({
                title: title,
                text: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: willBeVerified ? 'Yes, approval it!' : 'Yes, not  approval it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    submitproductApproval(checkbox, uid);
                } else {
                    checkbox.checked = !willBeVerified;
                }
            });
        }

        function submitproductApproval(checkbox, uid) {
            const isChecked = checkbox.checked;

            const updateValue = JSON.stringify({
                uid: uid,
                is_admin_allow: isChecked ? 1 : 0
            });

            fetch(BASE_URL + '/admin/api/product/approval', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: updateValue,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        MessSuccess.fire({
                            icon: 'success',
                            title: isChecked ? 'Product approval successfully!' : 'Product not  approval successfully!',
                        });
                    } else {
                        console.error("Failed to update product verification status:", data.message);
                        checkbox.checked = !isChecked;
                    }
                })
                .catch(error => {
                    console.error("Error updating product verification status:", error);
                    checkbox.checked = !isChecked;
                });
        }
    </script>
    <script>

    </script>
    <script>
        $(document).ready(function() {
            $('#tableProduct').DataTable({
                columnDefs: [{
                        type: 'num',
                        targets: 0
                    } // if first column is numeric ID
                ],
                order: [
                    [0, 'asc']
                ]
            });
        });


        function productVerify(checkbox, uid) {

            let willBeVerified = checkbox.checked;


            let title = willBeVerified ? "Are you sure?" : "Are you sure?";
            let text = willBeVerified ?
                "Do you want to verify this product?" :
                "Do you want to mark this product as NOT verified?";

            Swal.fire({
                title: title,
                text: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: willBeVerified ? 'Yes, verify it!' : 'Yes, unverify it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    submitProductVerify(checkbox, uid);
                } else {
                    checkbox.checked = !willBeVerified;
                }
            });
        }

        function submitProductVerify(checkbox, uid) {
            const isChecked = checkbox.checked;

            const updateValue = JSON.stringify({
                uid: uid,
                is_verify: isChecked ? 1 : 0
            });

            fetch(BASE_URL + '/admin/api/product/verify', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: updateValue,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        MessSuccess.fire({
                            icon: 'success',
                            title: isChecked ? 'Product verified successfully!' : 'Product unverified successfully!',
                        });
                    } else {
                        console.error("Failed to update product verification status:", data.message);
                        checkbox.checked = !isChecked;
                    }
                })
                .catch(error => {
                    console.error("Error updating product verification status:", error);
                    checkbox.checked = !isChecked;
                });
        }
    </script>
    <script>
        /** Deleted */
        function deleteProduct(uid) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this Product?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteProductDetails(uid);
                }
            });
        }

        function deleteProductDetails(uid) {
            const formData = new FormData();
            formData.append('uid', uid);

            $.ajax({
                url: BASE_URL + '/admin/api/product/delete',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    MessSuccess.fire({
                        icon: 'success',
                        title: response.message || 'product deleted successfully',
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
            fetch(BASE_URL + '/admin/api/product/update-status', {
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