<?php
$currentUrl = $_SERVER['REQUEST_URI'];
$urlSegments = explode('/', trim($currentUrl, '/')); // Split URL into segments
$lastSegment = end($urlSegments);

/** User Details */

use Config\Services;

$request = Services::request();
$jwt = $request->getCookie(ADMIN_JWT_TOKEN);
$user_details = validateJWT($jwt);
/** User Details */
$first_name = explode(' ', $user_details->user_name)[0];
?>
<div class="topbar-header px-3 py-2 d-flex align-items-center justify-content-md-between gap-4 bg-white shadow-sm">
    <div class="p-0 col-md-6">
        <button class="btnico d-md-none mnutog">
            <svg width="24" height="24" viewBox="0 0 462 361" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M346.5 25.7857C346.5 11.5451 336.157 0 323.4 0H23.1C10.3427 0 0 11.5451 0 25.7857C0 40.0263 10.3427 51.5714 23.1 51.5714H323.4C336.157 51.5714 346.5 40.0253 346.5 25.7857ZM23.1 154.714H438.9C451.657 154.714 462 166.26 462 180.5C462 194.741 451.657 206.286 438.9 206.286H23.1C10.3427 206.286 0 194.741 0 180.5C0 166.26 10.3427 154.714 23.1 154.714ZM23.1 309.429H231C243.756 309.429 254.1 320.974 254.1 335.214C254.1 349.454 243.756 361 231 361H23.1C10.3427 361 0 349.454 0 335.214C0 320.974 10.3427 309.429 23.1 309.429Z" fill="black" />
            </svg>
        </button>
        <?php if ($lastSegment == 'dashboard') { ?>
            <!-- Dashboard -->
            <div class="d-none d-md-block">
                <div class="fw-600 h5 m-0">Dashboard Overview</div>
                <div class="welcome-message">Welcome back, <?= $user_details->user_name; ?></div>
            </div>

    </div>
    <div class="d-flex align-items-center gap-3">
        <div>
            <button type="button" class="btn btn-primary btn-sm" onclick="exportDataBtn()" id="exportDataBtn">
                Export Data
            </button>
        </div>
        <!-- Dashboard -->
    <?php } elseif ($lastSegment == 'patients') { ?>
        <div class="d-none d-md-block">
            <div class="fw-600 h5 m-0">Patients Overview</div>
            <!-- <div>Welcome back, Metropolitan Medical Center</div> -->
        </div>
    </div>
    <div class="d-flex align-items-center gap-3">
        <!-- <div class="position-relative">
            <i class="position-absolute top-50 translate-middle-y" style="left:8px;line-height: 0;">
                <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.1501 3.66837L17.5026 3.31378L17.1501 3.66837C17.305 3.82234 17.4103 4.04088 17.4686 4.47196C17.529 4.91783 17.53 5.51045 17.53 6.36841C17.53 6.56096 17.5292 6.67543 17.5222 6.75506C17.4413 6.76236 17.3252 6.76315 17.13 6.76315H0.930029C0.734683 6.76315 0.6187 6.76237 0.537906 6.75511C0.530811 6.67535 0.530029 6.56083 0.530029 6.36841C0.530029 5.51045 0.531105 4.91783 0.591438 4.47196C0.649772 4.04088 0.755073 3.82234 0.909944 3.66837C1.06522 3.514 1.28624 3.40877 1.72126 3.35059C2.17046 3.29052 2.76726 3.28947 3.63003 3.28947H14.43C15.2928 3.28947 15.8896 3.29052 16.3388 3.35059C16.7738 3.40877 16.9948 3.514 17.1501 3.66837Z" fill="#0B0B12" stroke="#0B0B12"/>
                    <path d="M0.909944 17.1211C0.755073 16.9671 0.649772 16.7486 0.591438 16.3175C0.531105 15.8716 0.530029 15.279 0.530029 14.4211V9.94737C0.530029 9.75483 0.530811 9.64035 0.537869 9.56072C0.618786 9.55341 0.734817 9.55264 0.930029 9.55264H17.13C17.3254 9.55264 17.4414 9.55341 17.5222 9.56068C17.5292 9.64032 17.53 9.7548 17.53 9.94737V14.4211C17.53 15.279 17.529 15.8716 17.4686 16.3175C17.4103 16.7486 17.305 16.9671 17.1501 17.1211C16.9948 17.2755 16.7738 17.3807 16.3388 17.4389C15.8896 17.499 15.2928 17.5 14.43 17.5H3.63003C2.76726 17.5 2.17046 17.499 1.72126 17.4389C1.28624 17.3807 1.06522 17.2755 0.909944 17.1211ZM5.43003 12.1316C5.05967 12.1316 4.70389 12.2778 4.44112 12.5391C4.17825 12.8004 4.03003 13.1555 4.03003 13.5263C4.03003 13.8972 4.17825 14.2522 4.44112 14.5136C4.70389 14.7748 5.05967 14.9211 5.43003 14.9211H12.63C13.0004 14.9211 13.3562 14.7748 13.6189 14.5136C13.8818 14.2522 14.03 13.8972 14.03 13.5263C14.03 13.1555 13.8818 12.8004 13.6189 12.5391C13.3562 12.2778 13.0004 12.1316 12.63 12.1316H5.43003Z" fill="#0B0B12" stroke="#0B0B12"/>
                    <path d="M4.53003 1V3.68421V1ZM13.53 1V3.68421V1Z" fill="#0B0B12"/>
                    <path d="M4.53003 1V3.68421M13.53 1V3.68421" stroke="#0B0B12" stroke-width="2" stroke-linecap="round"/>
                </svg>                                                               
            </i>
            <input id="datetimepicker" type="text" class="datepicker form-control text-center px-4 position-relative bg-transparent" style="z-index:1;width:130px;cursor: pointer;">
            <i class="position-absolute top-50 translate-middle-y" style="right:8px;line-height: 0;">
                <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.6948 0.934999L16 2.29286L8.88679 9.6888C8.77281 9.80802 8.63728 9.90263 8.48798 9.9672C8.33868 10.0318 8.17858 10.065 8.01688 10.065C7.85517 10.065 7.69507 10.0318 7.54577 9.9672C7.39648 9.90263 7.26094 9.80802 7.14696 9.6888L0.0300293 2.29286L1.33521 0.936278L8.01503 7.87789L14.6948 0.934999Z" fill="#0B0B12"/>
                </svg>                                
            </i>
            <script>
                $(document).ready(function() {
                    let currentMonthYear = new Date().toLocaleDateString('en-GB', { year: 'numeric', month: 'short' }).replace(' ', '-');
                    $('.datepicker').val(currentMonthYear);
                    $('.datepicker').datetimepicker({
                        timepicker: false,
                        format: 'M-Y',
                        formatDate: 'M-Y',
                        onShow: function(ct) {
                            this.setOptions({
                                minView: 3,
                                view: 3
                            });
                        }
                    });
                });
            </script>
        </div> -->
    <?php } elseif ($lastSegment == 'patient-add') { ?>
        <div class="d-none d-md-block">
            <div class="fw-600 h5 m-0">Add Patient</div>
            <div>Enter patient details to create a new record</div>
        </div>
    </div>
    <div class="d-flex align-items-center gap-3">
    <?php } elseif ($lastSegment == 'patient-profile') { ?>
        <div class="d-none d-md-block">
            <div class="fw-600 h5 m-0">Patient Profile</div>
            <!-- <div>Enter patient details to create a new record</div> -->
        </div>
    </div>
    <div class="d-flex align-items-center gap-3">
        <!-- <div class="position-relative">
                <i class="position-absolute top-50 translate-middle-y" style="left:8px;line-height: 0;">
                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.1501 3.66837L17.5026 3.31378L17.1501 3.66837C17.305 3.82234 17.4103 4.04088 17.4686 4.47196C17.529 4.91783 17.53 5.51045 17.53 6.36841C17.53 6.56096 17.5292 6.67543 17.5222 6.75506C17.4413 6.76236 17.3252 6.76315 17.13 6.76315H0.930029C0.734683 6.76315 0.6187 6.76237 0.537906 6.75511C0.530811 6.67535 0.530029 6.56083 0.530029 6.36841C0.530029 5.51045 0.531105 4.91783 0.591438 4.47196C0.649772 4.04088 0.755073 3.82234 0.909944 3.66837C1.06522 3.514 1.28624 3.40877 1.72126 3.35059C2.17046 3.29052 2.76726 3.28947 3.63003 3.28947H14.43C15.2928 3.28947 15.8896 3.29052 16.3388 3.35059C16.7738 3.40877 16.9948 3.514 17.1501 3.66837Z" fill="#0B0B12" stroke="#0B0B12"/>
                        <path d="M0.909944 17.1211C0.755073 16.9671 0.649772 16.7486 0.591438 16.3175C0.531105 15.8716 0.530029 15.279 0.530029 14.4211V9.94737C0.530029 9.75483 0.530811 9.64035 0.537869 9.56072C0.618786 9.55341 0.734817 9.55264 0.930029 9.55264H17.13C17.3254 9.55264 17.4414 9.55341 17.5222 9.56068C17.5292 9.64032 17.53 9.7548 17.53 9.94737V14.4211C17.53 15.279 17.529 15.8716 17.4686 16.3175C17.4103 16.7486 17.305 16.9671 17.1501 17.1211C16.9948 17.2755 16.7738 17.3807 16.3388 17.4389C15.8896 17.499 15.2928 17.5 14.43 17.5H3.63003C2.76726 17.5 2.17046 17.499 1.72126 17.4389C1.28624 17.3807 1.06522 17.2755 0.909944 17.1211ZM5.43003 12.1316C5.05967 12.1316 4.70389 12.2778 4.44112 12.5391C4.17825 12.8004 4.03003 13.1555 4.03003 13.5263C4.03003 13.8972 4.17825 14.2522 4.44112 14.5136C4.70389 14.7748 5.05967 14.9211 5.43003 14.9211H12.63C13.0004 14.9211 13.3562 14.7748 13.6189 14.5136C13.8818 14.2522 14.03 13.8972 14.03 13.5263C14.03 13.1555 13.8818 12.8004 13.6189 12.5391C13.3562 12.2778 13.0004 12.1316 12.63 12.1316H5.43003Z" fill="#0B0B12" stroke="#0B0B12"/>
                        <path d="M4.53003 1V3.68421V1ZM13.53 1V3.68421V1Z" fill="#0B0B12"/>
                        <path d="M4.53003 1V3.68421M13.53 1V3.68421" stroke="#0B0B12" stroke-width="2" stroke-linecap="round"/>
                    </svg>                                                               
                </i>
                <input id="datetimepicker" type="text" class="datepicker form-control text-center px-4 position-relative bg-transparent" style="z-index:1;width:130px;cursor: pointer;">
                <i class="position-absolute top-50 translate-middle-y" style="right:8px;line-height: 0;">
                    <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.6948 0.934999L16 2.29286L8.88679 9.6888C8.77281 9.80802 8.63728 9.90263 8.48798 9.9672C8.33868 10.0318 8.17858 10.065 8.01688 10.065C7.85517 10.065 7.69507 10.0318 7.54577 9.9672C7.39648 9.90263 7.26094 9.80802 7.14696 9.6888L0.0300293 2.29286L1.33521 0.936278L8.01503 7.87789L14.6948 0.934999Z" fill="#0B0B12"/>
                    </svg>                                
                </i>
                <script>
                    $(document).ready(function() {
                        let currentMonthYear = new Date().toLocaleDateString('en-GB', { year: 'numeric', month: 'short' }).replace(' ', '-');
                        $('.datepicker').val(currentMonthYear);
                        $('.datepicker').datetimepicker({
                            timepicker: false,
                            format: 'M-Y',
                            formatDate: 'M-Y',
                            onShow: function(ct) {
                                this.setOptions({
                                    minView: 3,
                                    view: 3
                                });
                            }
                        });
                    });
                </script>
            </div> -->
    <?php } elseif ($lastSegment == 'calendar') { ?>
        <div class="d-none d-md-block">
            <div class="fw-600 h5 m-0">Booking Overview</div>
            <!-- <div>Welcome back, Metropolitan Medical Center</div> -->
        </div>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div class="">
            <a href="<?= base_url('clinic/add-booking') ?>" class="btn btn-primary d-flex align-items-center gap-2 py-2">
                <i style="line-height: 0;">
                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.8571 9.64286H9.14286V15.3571C9.14286 15.6602 9.02245 15.9509 8.80812 16.1653C8.59379 16.3796 8.30311 16.5 8 16.5C7.6969 16.5 7.40621 16.3796 7.19188 16.1653C6.97755 15.9509 6.85714 15.6602 6.85714 15.3571V9.64286H1.14286C0.839753 9.64286 0.549063 9.52245 0.334735 9.30812C0.120408 9.09379 0 8.80311 0 8.5C0 8.1969 0.120408 7.90621 0.334735 7.69188C0.549063 7.47755 0.839753 7.35714 1.14286 7.35714H6.85714V1.64286C6.85714 1.33975 6.97755 1.04906 7.19188 0.834735C7.40621 0.620407 7.6969 0.5 8 0.5C8.30311 0.5 8.59379 0.620407 8.80812 0.834735C9.02245 1.04906 9.14286 1.33975 9.14286 1.64286V7.35714H14.8571C15.1602 7.35714 15.4509 7.47755 15.6653 7.69188C15.8796 7.90621 16 8.1969 16 8.5C16 8.80311 15.8796 9.09379 15.6653 9.30812C15.4509 9.52245 15.1602 9.64286 14.8571 9.64286Z" fill="white"></path>
                    </svg>
                </i>
                <span>Add New Booking</span>
            </a>
        </div>
    <?php } elseif ($lastSegment == 'add-booking') { ?>
        <div class="d-none d-md-block">
            <div class="fw-600 h5 m-0">Booking Overview</div>
            <div>Enter information to add new booking on the system</div>
        </div>
    </div>
    <div class="d-flex align-items-center gap-3">
    <?php } else { ?>
        <div class="d-none d-md-block">
            <div class="fw-600 h5 m-0"> </div>
        </div>
    </div>
    <div class="d-flex align-items-center gap-3">
    <?php } ?>

    <div class="dropdown">
        <button class="headeraccbtn gap-2 ps-md-2 pe-md-3 py-md-1 p-0" data-bs-toggle="dropdown" aria-expanded="false">
            <div>
                <?php if (empty($user_details->user_image)) { ?>
                    <img src="<?php echo base_url('assets/admin/images/no_image.png') ?>" alt="avatar" width="36" height="36" class="rounded-circle">
                <?php } else { ?>
                    <img src="<?php echo base_url($user_details->user_image) ?>" alt="avatar" width="36" height="36" class="rounded-circle">
                <?php } ?>
            </div>
            <div class="d-none d-md-block">
                <h6 class="m-0 text-nowrap"><?= $first_name; ?></h6>
                <small class="d-block text-gray text-nowrap">Admin</small>
            </div>
            <div class="d-none d-md-block">
                <svg width="15" height="10" viewBox="0 0 452 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M225.924 257.565C234.022 257.565 242.119 254.473 248.293 248.302L442.577 54.0165C454.936 41.6575 454.936 21.6195 442.577 9.2655C430.223 -3.0885 410.189 -3.0885 397.829 9.2655L225.924 181.18L54.0178 9.27147C41.6588 -3.08253 21.6268 -3.08253 9.27377 9.27147C-3.09122 21.6255 -3.09122 41.6635 9.27377 54.0225L203.555 248.308C209.732 254.48 217.829 257.565 225.924 257.565Z" fill="black" />
                </svg>
            </div>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
            <!-- <li><a class="dropdown-item" href="#">Account</a></li> -->
            <li><a class="dropdown-item" href="<?= base_url('admin/change-password') ?>">Change Password</a></li>
            <li><a class="dropdown-item" href="<?= base_url('admin/logout') ?>">Logout</a></li>
        </ul>
    </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    function exportDataBtn() {
        Swal.fire({
            title: 'Export Data?',
            text: 'Do you really want to export all data to Excel sheets?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, export it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                doExportData();
            }
        });
    }
    async function doExportData() {
        try {
            const res = await fetch(BASE_URL + "admin/api/get-excel-sheet-data");
            const json = await res.json();
            if (!json.success) {
                alert("Failed to fetch data");
                return;
            }
            const {
                products,
                customers,
                ratings,
                vendors,
                requests,
                category,
            } = json.data;
            const wb = XLSX.utils.book_new();
            const wsProducts = XLSX.utils.json_to_sheet(products || []);
            const wsCustomers = XLSX.utils.json_to_sheet(customers || []);
            const wsRatings = XLSX.utils.json_to_sheet(ratings || []);
            const wsVendors = XLSX.utils.json_to_sheet(vendors || []);
            const wsRequests = XLSX.utils.json_to_sheet(requests || []);
            const wscategory = XLSX.utils.json_to_sheet(category || []);


            XLSX.utils.book_append_sheet(wb, wsProducts, "Products");
            XLSX.utils.book_append_sheet(wb, wsCustomers, "Customers");
            XLSX.utils.book_append_sheet(wb, wsRatings, "Ratings");
            XLSX.utils.book_append_sheet(wb, wsVendors, "Vendors");
            XLSX.utils.book_append_sheet(wb, wsRequests, "Requests");
            XLSX.utils.book_append_sheet(wb, wscategory, "Category");
            const today = new Date();
            const formattedDate = today.toLocaleDateString("en-GB", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric"
            }).replace(/\//g, "-");

            XLSX.writeFile(wb, `foundry-biz-${formattedDate}.xlsx`);
        } catch (e) {
            console.error(e);
        }
    }
</script>