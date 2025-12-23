<div class="content-body p-3">
    <div class="mt-4 rounded-10 bg-white border">
        <div class="d-flex align-items-center p-3 gap-4">

            <div class="filterdropdown filterfield">
                <div class="input-group">
                    <select class="form-select" id="search_customer" aria-label="Default select example">
                        <option value=''>All Customer</option>
                        <?php if (!empty($customer)) {
                            foreach ($customer as $key) {
                        ?>
                                <option value='<?= $key['uid'] ?>' <?php if ($key['uid'] == $customerUid) { ?> selected <?php } ?>><?= $key['name'] ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="filterdropdown filterfield">
                <div class="input-group">
                    <select class="form-select" id="search_product" aria-label="Default select example">
                        <option value=''>All Products</option>
                        <?php if (!empty($product)) {
                            foreach ($product as $key) {
                        ?>
                                <option value='<?= $key['uid'] ?>' <?php if ($key['uid'] == $productUid) { ?> selected <?php } ?>><?= $key['name'] ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="datefield filterfield">
                <div class="input-group">
                    <input type="text" class="form-control establDate" id="search_date" aria-label="Search" aria-describedby="basic-addon1" name="dob" placeholder="yyyy-mm-dd" value="<?= $date ?>">
                    <script>
                        $(function() {
                            $('.establDate').datetimepicker({
                                timepicker: false,
                                format: 'Y-m-d',
                            });
                        });
                    </script>
                </div>
            </div>

        </div>
    </div>

    <div class="mt-4 rounded-10 bg-white border">
        <div class="p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="m-0 h5 fw-600">List of Requests</div>
            </div>
        </div>
        <div class="px-3 pb-3">
            <table id="tableProduct" class=" display border">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Customer Name</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Actions</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sl = 1;

                    if (!empty($requests)) {
                        foreach ($requests as $row) {
                    ?>
                            <tr data-request-id="<?= esc($row['uid']) ?>" data-amount="<?= esc($row['lead_price'] ?? '500.00') ?>">

                                <td><?= $sl++; ?></td>

                                <td class="lead-details">
                                    <div class="masked <?= $row['is_paid'] ? 'd-none' : '' ?>">
                                        <strong>************</strong><br>
                                        <small class="text-muted">Eml: ************</small><br>
                                        <small class="text-muted">Mob: ************</small>
                                    </div>

                                    <div class="real <?= $row['is_paid'] ? '' : 'd-none' ?>">
                                        <strong><?= $row['customer_name'] ?? $row['name']; ?></strong><br>
                                        <small class="text-muted">Eml: <?= $row['customer_email'] ?? $row['email']; ?></small><br>
                                        <small class="text-muted">Mob: <?= $row['customer_mobile'] ?? $row['mobile']; ?></small>
                                    </div>
                                </td>

                                <td>
                                    <img src="<?= base_url($row['product_image'] ?: 'assets/default-product.png') ?>"
                                        width="60" height="60"
                                        style="border-radius:6px; object-fit:cover;">

                                </td>

                                <td>
                                    <div><?= $row['product_name']; ?></div>
                                </td>

                                <td>
                                    <?= date('d M Y, h:i A', strtotime($row['created_at'])); ?>
                                </td>

                                <td class="lead-message">
                                    <div class="msg-masked <?= $row['is_paid'] ? 'd-none' : '' ?>">************</div>
                                    <div class="msg-real <?= $row['is_paid'] ? '' : 'd-none' ?>">
                                        <?= $row['message']; ?>
                                    </div>
                                </td>

                                <td>
                                    <?php
                                    $bgColor = ($row['status'] === 'Active') ? '#FFE4E3' : '#D1FAE5';
                                    $textColor = ($row['status'] === 'Active') ? '#AB3D3C' : '#065F46';
                                    ?>
                                    <button class="btn rounded-pill" style="background-color: <?= $bgColor ?>; color: <?= $textColor ?>;">
                                        <?= $row['status']; ?>
                                    </button>
                                </td>

                                <td style="max-width: 120px;">
                                    <button class="btnico" onclick="deleteRequest('<?= $row['uid'] ?>')">
                                        <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.0991 1.99469L10.3566 3.71154H13.8419C14.0167 3.71154 14.1843 3.7784 14.3079 3.89741C14.4315 4.01643 14.501 4.17784 14.501 4.34615C14.501 4.51446 14.4315 4.67588 14.3079 4.79489C14.1843 4.91391 14.0167 4.98077 13.8419 4.98077H13.1661L12.3989 13.5988C12.3523 14.1235 12.3146 14.555 12.2539 14.9036C12.1924 15.2666 12.0984 15.5915 11.9147 15.8928C11.6263 16.3659 11.1975 16.7451 10.6835 16.9818C10.3566 17.1315 10.0121 17.1933 9.63073 17.2221C9.26428 17.25 8.81522 17.25 8.26861 17.25H6.23334C5.68673 17.25 5.23767 17.25 4.87122 17.2221C4.48982 17.1933 4.14534 17.1315 3.81843 16.9818C3.30441 16.7451 2.87565 16.3659 2.58725 15.8928C2.4027 15.5915 2.31043 15.2666 2.24804 14.9036C2.1874 14.5542 2.14961 14.1235 2.10304 13.5988L1.33586 4.98077H0.660067C0.485266 4.98077 0.317623 4.91391 0.19402 4.79489C0.0704162 4.67588 0.000976562 4.51446 0.000976562 4.34615C0.000976562 4.17784 0.0704162 4.01643 0.19402 3.89741C0.317623 3.7784 0.485266 3.71154 0.660067 3.71154H4.14534L4.40282 1.99469L4.41249 1.94308C4.57243 1.27462 5.16825 0.75 5.91522 0.75H8.58673C9.3337 0.75 9.92952 1.27462 10.0895 1.94308L10.0991 1.99469Z" fill="#AB3D3C" />
                                        </svg>
                                    </button>
                                </td>

                                <td>
                                    <?php if (!$row['is_paid']) : ?>
                                        <button class="btn btn-primary btn-sm buyLeadBtn">Buy Lead</button>
                                    <?php else: ?>
                                        <button class="btn btn-success btn-sm" disabled>Purchased</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tableProduct').DataTable({
                columnDefs: [{
                    type: 'num',
                    targets: 0
                }],
                order: [
                    [0, 'asc']
                ]
            });
        });

        function deleteRequest(uid) {
            // console.log('============', uid);
            // return ; 
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this vendor?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteRequestDetails(uid);
                }
            });
        }

        function deleteRequestDetails(uid) {
            const formData = new FormData();
            formData.append('uid', uid);

            $.ajax({
                url: BASE_URL + '/admin/api/request/delete',
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
        $(document).ready(function() {
            function handleFilterChange() {
                const customer = $('#search_customer').val();
                const product = $('#search_product').val();
                const date = $('#search_date').val();

                window.location.href = `<?= base_url('vendor/requests') ?>?customer=${customer}&product=${product}&date=${date}`;

            }

            $('#search_customer').on('change', handleFilterChange);
            $('#search_product').on('change', handleFilterChange);
            $('#search_date').on('change', handleFilterChange); // for manual input or date picker
        });
    </script>

    <!-- Payment -->
    <script>
        const BASE_URL = "<?= rtrim(base_url(), '/') ?>";
        window.VENDOR_ID = "<?= esc($vendor_id ?? '') ?>";
        console.log("Loaded Vendor ID =", window.VENDOR_ID);
    </script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        
        (() => {

            const RAZORPAY_KEY = "<?= esc(getenv('RAZORPAY_KEY') ?: '') ?>";

            // Toast shortcuts
            function toast(msg, type = 'info') {
                if (type === 'success' && window.MessSuccess)
                    return MessSuccess.fire({
                        icon: 'success',
                        title: msg
                    });

                if (type === 'error' && window.MessError)
                    return MessError.fire({
                        icon: 'error',
                        title: msg
                    });

                alert(msg);
            }

            // ===============================
            // UI Helpers
            // ===============================

            function unmaskRow(row) {
                row.querySelector(".masked")?.classList.add("d-none");
                row.querySelector(".real")?.classList.remove("d-none");

                row.querySelector(".msg-masked")?.classList.add("d-none");
                row.querySelector(".msg-real")?.classList.remove("d-none");

                const btn = row.querySelector(".buyLeadBtn");
                if (btn) {
                    btn.innerText = "Purchased";
                    btn.classList.remove("btn-primary", "btn-warning");
                    btn.classList.add("btn-success");
                    btn.disabled = true;
                }
            }

            function markPending(row) {
                const btn = row.querySelector(".buyLeadBtn");
                if (btn) {
                    btn.innerText = "Processing...";
                    btn.classList.remove("btn-primary");
                    btn.classList.add("btn-warning");
                    btn.disabled = true;
                }
            }

            function revertRow(row) {
                const btn = row.querySelector(".buyLeadBtn");
                if (btn) {
                    btn.innerText = "Buy Lead";
                    btn.classList.remove("btn-warning", "btn-success");
                    btn.classList.add("btn-primary");
                    btn.disabled = false;
                }
            }

            // ===============================
            // API CALLS
            // ===============================

            async function createOrderOnServer(requestUid, amount, vendorId) {
                const fd = new FormData();
                fd.append("request_id", requestUid);
                fd.append("vendor_id", vendorId);
                fd.append("amount", amount);
                fd.append("gateway", "razorpay");

                const res = await fetch(`${BASE_URL}/vendor/payment/create-order`, {
                    method: "POST",
                    body: fd,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                if (!res.ok) throw new Error("Order creation failed: " + res.status);
                return res.json();
            }

            async function verifyPaymentOnServer(paymentUid, orderId, paymentId, signature) {
                const fd = new FormData();
                fd.append("uid", paymentUid);
                fd.append("razorpay_order_id", orderId);
                fd.append("razorpay_payment_id", paymentId);
                fd.append("razorpay_signature", signature);

                const res = await fetch(`${BASE_URL}/vendor/payment/verify`, {
                    method: "POST",
                    body: fd,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                if (!res.ok) throw new Error("Verification failed: " + res.status);
                return res.json();
            }

            async function fetchPaymentStatus(requestUid) {
                const res = await fetch(`${BASE_URL}/vendor/payment/status/${encodeURIComponent(requestUid)}`);
                if (!res.ok) return null;
                return res.json();
            }

            // ===============================
            // Initialize on page load
            // ===============================

            async function initRowsOnLoad() {
                const rows = document.querySelectorAll("table#tableProduct tbody tr[data-request-id]");

                for (const row of rows) {
                    const reqId = row.dataset.requestId;
                    const status = await fetchPaymentStatus(reqId);

                    if (status?.status === "success") {
                        unmaskRow(row);
                    }
                }
            }

            document.addEventListener("DOMContentLoaded", initRowsOnLoad);

            // ===============================
            // Payment Flow
            // ===============================

            document.addEventListener("click", async (e) => {
                if (!e.target.classList.contains("buyLeadBtn")) return;

                const btn = e.target;
                const row = btn.closest("tr");

                const requestUid = row.dataset.requestId;
                const amount = Number(row.dataset.amount || 0);
                const vendorId = window.VENDOR_ID; 

                if (!vendorId) {
                    toast("Vendor ID missing. Please login again.", "error");
                    return;
                }

                markPending(row);

                try {
                    const order = await createOrderOnServer(requestUid, amount, vendorId);
                    const paymentUid = order.payment.uid;
                    const gatewayOrder = order.gateway_order;

                    const rzp = new Razorpay({
                        key: RAZORPAY_KEY,
                        amount: gatewayOrder.amount,
                        currency: "INR",
                        order_id: gatewayOrder.id,
                        handler: async function(response) {
                            const verify = await verifyPaymentOnServer(
                                paymentUid,
                                response.razorpay_order_id,
                                response.razorpay_payment_id,
                                response.razorpay_signature
                            );

                            if (verify?.status === "success") {

                                // Show transaction ID to user
                                Swal.fire({
                                    icon: "success",
                                    title: "Payment Successful",
                                    html: `Transaction ID:<br><b>${response.razorpay_payment_id}</b>`
                                });

                                unmaskRow(row);
                            } else {
                                revertRow(row);
                                toast("Payment verification failed!", "error");
                            }
                        },

                        modal: {
                            ondismiss: () => revertRow(row)
                        },

                        theme: {
                            color: "#0D9488"
                        }
                    });

                    rzp.open();

                } catch (err) {
                    console.error("Payment error:", err);
                    revertRow(row);
                    toast(err.message, "error");
                }
            });

        })();
    </script>
    <!-- Payment -->