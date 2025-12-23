<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Foundry | Admin Login</title>
    <link rel="icon" href="<?php echo base_url('assets/admin/images/logo_ibm.png') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/admin/css/jquery.datetimepicker.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/admin/css/custom.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo base_url('assets/admin/js/jquery.datetimepicker.full.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/custom.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="vh-100 d-flex align-items-center">
        <div class="container">
            <div class="col-md-6 col-lg-4 p-0 mx-auto">
                <div class="p-4 rounded-10 shadow-sm bg-white">
                    <div class="mb-2 text-center">
                        <img src="<?php echo base_url('assets/admin/images/foundry_logo.webp') ?>" alt="" width="75">
                    </div>
                    <div class="mb-2 fw-bold text-center h4 ">Admin Portal</div>
                    <big class="d-block mb-4 text-center text-gray">Super Admin access</big>
                    <form method="post" class="logregform" id="loginForm">
                        <div class="mb-3">
                            <label class="form-label mb-1 d-block">Email <span style="color: red">*</span></label>
                            <div class="input-group mb-0">
                                <span class="input-group-text bg-white">
                                    <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="path-1-inside-1_142_166" fill="white">
                                            <path d="M1.42105 1.4V1C1.30938 1 1.20229 1.04214 1.12332 1.11716C1.04436 1.19217 1 1.29391 1 1.4H1.42105ZM16.5789 1.4H17C17 1.29391 16.9556 1.19217 16.8767 1.11716C16.7977 1.04214 16.6906 1 16.5789 1V1.4ZM1.42105 1.8H16.5789V1H1.42105V1.8ZM16.1579 1.4V11H17V1.4H16.1579ZM14.8947 12.2H3.10526V13H14.8947V12.2ZM1.84211 11V1.4H1V11H1.84211ZM3.10526 12.2C2.77025 12.2 2.44896 12.0736 2.21208 11.8485C1.97519 11.6235 1.84211 11.3183 1.84211 11H1C1 11.5304 1.2218 12.0391 1.61662 12.4142C2.01143 12.7893 2.54691 13 3.10526 13V12.2ZM16.1579 11C16.1579 11.3183 16.0248 11.6235 15.7879 11.8485C15.551 12.0736 15.2297 12.2 14.8947 12.2V13C15.4531 13 15.9886 12.7893 16.3834 12.4142C16.7782 12.0391 17 11.5304 17 11H16.1579Z" />
                                        </mask>
                                        <path d="M1.42105 1.4V1C1.30938 1 1.20229 1.04214 1.12332 1.11716C1.04436 1.19217 1 1.29391 1 1.4H1.42105ZM16.5789 1.4H17C17 1.29391 16.9556 1.19217 16.8767 1.11716C16.7977 1.04214 16.6906 1 16.5789 1V1.4ZM1.42105 1.8H16.5789V1H1.42105V1.8ZM16.1579 1.4V11H17V1.4H16.1579ZM14.8947 12.2H3.10526V13H14.8947V12.2ZM1.84211 11V1.4H1V11H1.84211ZM3.10526 12.2C2.77025 12.2 2.44896 12.0736 2.21208 11.8485C1.97519 11.6235 1.84211 11.3183 1.84211 11H1C1 11.5304 1.2218 12.0391 1.61662 12.4142C2.01143 12.7893 2.54691 13 3.10526 13V12.2ZM16.1579 11C16.1579 11.3183 16.0248 11.6235 15.7879 11.8485C15.551 12.0736 15.2297 12.2 14.8947 12.2V13C15.4531 13 15.9886 12.7893 16.3834 12.4142C16.7782 12.0391 17 11.5304 17 11H16.1579Z" fill="black" />
                                        <path d="M16.1579 11.5H17V10.5H16.1579V11.5ZM2.60526 12.2V13H3.60526V12.2H2.60526ZM15.3947 13V12.2H14.3947V13H15.3947ZM1 11.5H1.84211V10.5H1V11.5ZM1.42105 1.4V2.4H2.42105V1.4H1.42105ZM16.5789 1.4H15.5789V2.4H16.5789V1.4ZM1.42105 1.8H0.421053V2.8H1.42105V1.8ZM16.5789 1.8V2.8H17.5789V1.8H16.5789ZM16.1579 1.4V0.4H15.1579V1.4H16.1579ZM14.8947 13V14V13ZM1.84211 1.4H2.84211V0.4H1.84211V1.4ZM2.42105 1.4V1H0.421053V1.4H2.42105ZM1.42105 0C1.06024 0 0.704546 0.135685 0.434574 0.392158L1.81207 1.84216C1.70003 1.9486 1.55852 2 1.42105 2V0ZM0.434574 0.392158C0.16286 0.650286 0 1.01166 0 1.4H2C2 1.57616 1.92586 1.73406 1.81207 1.84216L0.434574 0.392158ZM1 2.4H1.42105V0.4H1V2.4ZM16.5789 2.4H17V0.4H16.5789V2.4ZM18 1.4C18 1.01167 17.8371 0.650288 17.5654 0.392158L16.1879 1.84216C16.0741 1.73406 16 1.57616 16 1.4H18ZM17.5654 0.392158C17.2955 0.135684 16.9398 0 16.5789 0V2C16.4415 2 16.3 1.9486 16.1879 1.84216L17.5654 0.392158ZM15.5789 1V1.4H17.5789V1H15.5789ZM1.42105 2.8H16.5789V0.8H1.42105V2.8ZM17.5789 1.8V1H15.5789V1.8H17.5789ZM16.5789 0H1.42105V2H16.5789V0ZM0.421053 1V1.8H2.42105V1H0.421053ZM15.1579 1.4V11H17.1579V1.4H15.1579ZM18 11V1.4H16V11H18ZM17 0.4H16.1579V2.4H17V0.4ZM14.8947 11.2H3.10526V13.2H14.8947V11.2ZM3.10526 14H14.8947V12H3.10526V14ZM2.84211 11V1.4H0.842105V11H2.84211ZM1.84211 0.4H1V2.4H1.84211V0.4ZM0 1.4V11H2V1.4H0ZM3.10526 11.2C3.01939 11.2 2.9467 11.1671 2.90083 11.1235L1.52333 12.5735C1.95122 12.98 2.52111 13.2 3.10526 13.2V11.2ZM2.90083 11.1235C2.85669 11.0816 2.84211 11.036 2.84211 11H0.842105C0.842105 11.6005 1.09369 12.1654 1.52333 12.5735L2.90083 11.1235ZM0 11C0 11.8127 0.340302 12.581 0.927868 13.1392L2.30537 11.6892C2.10331 11.4973 2 11.2482 2 11H0ZM0.927868 13.1392C1.51369 13.6957 2.29777 14 3.10526 14V12C2.79605 12 2.50917 11.8828 2.30537 11.6892L0.927868 13.1392ZM15.1579 11C15.1579 11.036 15.1433 11.0816 15.0992 11.1235L16.4767 12.5735C16.9063 12.1654 17.1579 11.6005 17.1579 11H15.1579ZM15.0992 11.1235C15.0533 11.1671 14.9806 11.2 14.8947 11.2V13.2C15.4789 13.2 16.0488 12.98 16.4767 12.5735L15.0992 11.1235ZM14.8947 14C15.7022 14 16.4863 13.6957 17.0721 13.1392L15.6946 11.6892C15.4908 11.8828 15.2039 12 14.8947 12V14ZM17.0721 13.1392C17.6597 12.581 18 11.8127 18 11H16C16 11.2482 15.8967 11.4973 15.6946 11.6892L17.0721 13.1392Z" fill="#6C757D" mask="url(#path-1-inside-1_142_166)" />
                                        <path d="M1.42108 1.39999L9.00003 8.59999L16.579 1.39999" stroke="#6C757D" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <input type="email" id="email" class="form-control ps-0 border-start-0" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-content-center mb-1">
                                <label class="form-label d-block m-0">Password <span style="color: red">*</span></label>
                                <!-- <a href="">Reset Password?</a> -->
                            </div>
                            <div class="input-group mb-0 flex-nowrap">
                                <span class="input-group-text bg-white" id="basic-addon1">
                                    <svg width="18" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.84686 18C1.33486 18 0.899048 17.8427 0.539429 17.528C0.17981 17.2133 0 16.8323 0 16.385V7.615C0 7.16833 0.17981 6.78733 0.539429 6.472C0.899048 6.15733 1.33486 6 1.84686 6H3.42857V4C3.42857 2.886 3.87238 1.941 4.76 1.165C5.64686 0.388333 6.72686 0 8 0C9.27314 0 10.3535 0.388333 11.2411 1.165C12.1288 1.94167 12.5722 2.88667 12.5714 4V6H14.1543C14.6648 6 15.1002 6.15733 15.4606 6.472C15.8202 6.78667 16 7.168 16 7.616V16.385C16 16.8317 15.8202 17.2127 15.4606 17.528C15.101 17.8427 14.6655 18 14.1543 18H1.84686ZM1.84686 17H14.1543C14.3592 17 14.5276 16.9423 14.6594 16.827C14.7912 16.7117 14.8571 16.5643 14.8571 16.385V7.615C14.8571 7.43567 14.7912 7.28833 14.6594 7.173C14.5276 7.05767 14.3592 7 14.1543 7H1.84571C1.64076 7 1.47238 7.05767 1.34057 7.173C1.20876 7.28833 1.14286 7.436 1.14286 7.616V16.385C1.14286 16.5643 1.20876 16.7117 1.34057 16.827C1.47238 16.9423 1.64114 17 1.84686 17ZM8 13.5C8.48229 13.5 8.88838 13.3553 9.21829 13.066C9.54895 12.7773 9.71429 12.422 9.71429 12C9.71429 11.578 9.54895 11.2227 9.21829 10.934C8.88762 10.6453 8.48152 10.5007 8 10.5C7.51848 10.4993 7.11238 10.644 6.78171 10.934C6.45105 11.2227 6.28571 11.578 6.28571 12C6.28571 12.422 6.45105 12.7773 6.78171 13.066C7.11162 13.3553 7.51771 13.5 8 13.5ZM4.57143 6H11.4286V4C11.4286 3.16667 11.0952 2.45833 10.4286 1.875C9.76191 1.29167 8.95238 1 8 1C7.04762 1 6.2381 1.29167 5.57143 1.875C4.90476 2.45833 4.57143 3.16667 4.57143 4V6Z" fill="#6C757D" />
                                    </svg>
                                </span>
                                <div class="position-relative w-100">
                                    <input type="password" id="passwordInput" class="form-control ps-0 border-start-0" style="border-radius: 0 .25rem .25rem 0;" placeholder="**********" required>
                                    <svg id="togglePassword" class="position-absolute end-0 top-50 translate-middle-y me-2" width="25" height="24" viewBox="0 0 128 128" fill="none" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer;">
                                        <!-- Open Eye Icon -->
                                        <g id="openEye">
                                            <path d="M64 104C22.127 104 1.367 67.496 0.504 65.943C-0.168 64.734 -0.168 63.266 0.504 62.057C1.367 60.505 22.127 24 64 24S126.633 60.505 127.496 62.057C128.168 63.266 128.168 64.734 127.496 65.943C126.633 67.496 105.873 104 64 104ZM8.707 64C13.465 71.211 32.146 96.006 64 96.006C95.955 96.006 114.553 71.231 119.293 64C114.535 56.789 95.855 32.994 64 32.994C32.045 32.994 13.447 56.769 8.707 64ZM64 88.006C50.766 88.006 40 77.24 40 64.006S50.766 40.006 64 40.006 88 50.772 88 64.006 77.234 88.006 64 88.006ZM64 48.006C55.178 48.006 48 55.184 48 64.006S55.178 80.006 64 80.006 80 72.828 80 64.006 72.822 48.006 64 48.006Z" fill="#999DA3" />
                                        </g>
                                        <!-- Closed Eye Icon -->
                                        <g id="closedEye" style="display: none;">
                                            <path d="M79.891 65.078 87.161 57.808C87.69 59.787 88 61.856 88 64C88 77.234 77.234 88 64 88C61.856 88 59.787 87.69 57.808 87.161L65.078 79.891C72.949 79.349 79.271 73.027 79.891 65.078ZM127.496 61.979C127.004 61.094 120.026 48.867 106.386 38.505L100.565 44.326C110.511 51.639 116.813 60.168 119.294 63.928C114.553 71.147 95.955 95.922 64 95.922C59.208 95.922 54.752 95.309 50.559 94.331L43.986 100.904C50.029 102.757 56.671 103.922 63.999 103.922C105.872 103.922 126.632 67.418 127.496 65.865C128.168 64.656 128.168 63.188 127.496 61.979ZM110.828 22.75L22.828 110.75C22.047 111.531 21.023 111.922 20 111.922C18.977 111.922 17.953 111.531 17.172 110.75C15.609 109.188 15.609 106.657 17.172 105.094L28.368 93.898C10.268 82.971 1.071 66.886 0.504 65.865C-0.168 64.656 -0.168 63.188 0.504 61.979C1.367 60.427 22.127 23.923 63.999 23.923C74.826 23.923 84.204 26.393 92.222 30.045L105.172 17.095C106.734 15.533 109.265 15.533 110.828 17.095C112.391 18.657 112.391 21.188 110.828 22.75ZM34.333 87.857L44.46 77.73C41.663 73.806 40 69.021 40 63.846C40 50.612 50.766 39.846 64 39.846C69.175 39.846 73.96 41.509 77.884 44.306L86.073 36.117C79.603 33.526 72.251 31.846 64 31.846C32.045 31.846 13.447 56.621 8.707 63.84C11.717 68.402 20.369 79.95 34.333 87.857ZM50.267 71.922L72.076 50.113C69.697 48.708 66.958 47.846 64 47.846C55.178 47.846 48 55.024 48 63.846C48 66.804 48.862 69.543 50.267 71.922Z" fill="#999DA3" />
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100 d-flex gap-1 align-items-center justify-content-center" type="submit">
                            <i>
                                <svg width="15" height="15" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 16.5V14.7222H14.2222V2.27778H8V0.5H14.2222C14.7111 0.5 15.1298 0.674222 15.4782 1.02267C15.8267 1.37111 16.0006 1.78948 16 2.27778V14.7222C16 15.2111 15.8261 15.6298 15.4782 15.9782C15.1304 16.3267 14.7117 16.5006 14.2222 16.5H8ZM6.22222 12.9444L5 11.6556L7.26667 9.38889H0V7.61111H7.26667L5 5.34444L6.22222 4.05556L10.6667 8.5L6.22222 12.9444Z" fill="white" />
                                </svg>
                            </i>
                            <span>Login</span>
                        </button>
                        <div class="mt-3 d-flex align-items-center justify-content-center gap-2">
                            <i style="line-height: 0.8;">
                                <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.5 13.5C6.5 13.5 12 11.6429 12 7" stroke="#6C757D" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 7V1.42857C12 1.42857 10.1667 0.5 6.5 0.5" stroke="#6C757D" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.49999 13.5C6.49999 13.5 1 11.6429 1 7" stroke="#6C757D" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M1 7V1.42857C1 1.42857 2.83333 0.5 6.49999 0.5" stroke="#6C757D" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.1667 3.28571C6.5 6.07142 5.58333 9.78571 5.58333 9.78571C5.58333 9.78571 4.66667 8.67736 3.75 7.92856" stroke="#6C757D" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </i>
                            <span>Secure login for authorized personnel only</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<script>
    const passwordInput = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');
    const openEye = document.getElementById('openEye');
    const closedEye = document.getElementById('closedEye');

    togglePassword.addEventListener('click', () => {
        const isPasswordVisible = passwordInput.type === 'password';
        passwordInput.type = isPasswordVisible ? 'text' : 'password';

        if (isPasswordVisible) {
            openEye.style.display = 'none';
            closedEye.style.display = 'block';
        } else {
            openEye.style.display = 'block';
            closedEye.style.display = 'none';
        }
    });
</script>

<script>
    const base_url = "<?= base_url(); ?>";
    document.getElementById("loginForm").addEventListener("submit", async function(event) {
        event.preventDefault();
        var email = document.getElementById("email").value;
        var password = document.getElementById("passwordInput").value;
        const loginData = {
            email: email,
            password: password
        };
        try {
            const response = await fetch(base_url + "admin/api/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(loginData)
            });

            const data = await response.json();
            if (response.ok) {
                window.location.href = base_url + 'admin/dashboard';
            } else {
                MessError.fire({
                    icon: 'error',
                    title: data.message,
                });
            }
        } catch (error) {
            MessError.fire({
                icon: 'error',
                title: 'An error occurred. Please try again.',
            });
        }
    });
</script>



<script>
    var MessSuccess = Swal.mixin({
        toast: true,
        icon: 'success',
        title: 'General Title',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    var MessError = Swal.mixin({
        toast: true,
        icon: 'error',
        title: 'General Title',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    setTimeout(function() {
        let alertBox = document.getElementById("flashAlert");
        if (alertBox) {
            let bsAlert = new bootstrap.Alert(alertBox);
            bsAlert.close();
        }
    }, 3000);
</script>

</body>

</html>