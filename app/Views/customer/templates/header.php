<?php
$uri = service('uri');
$totalSegments = $uri->getTotalSegments();
$lastSegment = $totalSegments > 0 ? $uri->getSegment($totalSegments) : null;

/** User Details */

use Config\Services;

$request = Services::request();
$jwt = $request->getCookie(CUSTOMER_JWT_TOKEN);
if (!empty($jwt)) {
    $user_details = validateJWT($jwt);
    $first_name = explode(' ', $user_details->user_name)[0];
} else {
    $user_details = '';
    $first_name = '';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="google-site-verification" content="fUyKWOknRbmI_xFEVLsLsm-gQPSPUboaUzzRVVha9FM" />


    <title>Foundry | <?= !empty($meta_title)  ? $meta_title : "Home" ?></title>
    <meta name="description" content="<?= !empty($meta_description) ? $meta_description : 'Default description for Foundry website' ?>">

    <link rel="icon" href="<?= base_url('assets/customer/images/favicon.webp') ?>" sizes="32x32" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.2/swiper-bundle.css" rel="stylesheet">
    <link href="<?= base_url('assets/customer/css/custom.css') ?>" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.2/swiper-bundle.min.js"></script>
    <script src="<?= base_url('assets/customer/js/custom.js') ?>"></script>
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NWC55KJG');
    </script>
    <!-- End Google Tag Manager -->

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NWC55KJG"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <header class="header pt-3 position-fixed top-0 start-0 w-100">
        <div class="container">
            <div class="headerBg p-3 rounded-10">
                <div class="d-flex align-items-center justify-content-between gap-3 gap-lg-0">
                    <div class="p-0 col-lg-3">
                        <a href="<?= base_url() ?>">
                            <img src="<?= base_url('assets/customer/images/logo.svg') ?>" alt="" width="141" height="36">
                        </a>
                    </div>
                    <nav class="d-none d-lg-block p-0 col-lg-6">
                        <ul class="mainMenu justify-content-lg-center">
                            <li>
                                <a href="<?= base_url('') ?>" <?php if (empty($lastSegment)) { ?>class="active" <?php } ?>>Home</a>
                            </li>
                            <li>
                                <a href="<?= base_url('product-list') ?>" <?php if ($lastSegment == 'product-list') { ?>class="active" <?php } ?>>Shop</a>
                            </li>
                            <!-- <li>
                                <a href="<?= base_url('category') ?>" <?php if ($lastSegment == 'category') { ?>class="active" <?php } ?>>Categories</a>
                            </li> -->
                            <li>
                                <a href="https://www.youtube.com/channel/UCqG_zja0MNnAPVdB4FpRBbg" target="_blank" rel="noopener noreferrer">
                                    Podcast
                                </a>
                            </li>
                            <li>
                                <a href=<?= COMMOUNUTY_URL_LINK ?> target="_blank">Community</a>
                            </li>
                            <li>
                                <a href="<?= base_url('blogs') ?>">Blogs</a>
                            </li>
                            <!-- <li>
                                <a  href="<?= base_url('vendor-register') ?>"  <?php if ($lastSegment == 'vendor-register') { ?>class="active" <?php } ?>>Vendor Resgister</a>
                            </li>
                            <li>
                                <a href="<?= base_url('vendor/login') ?>" target="_blank" >Vendor Login</a>
                            </li> -->
                        </ul>
                    </nav>
                    <div class="d-flex gap-4 align-items-center justify-content-end p-0 col-lg-3">
                        <div class="d-none d-md-block">
                            <a href="<?= base_url('vendor/login') ?>" target="_blank" class="btn btn-primary h-auto">
                                <i>
                                    <svg fill="currentColor" width="16" height="16" viewBox="0 -31 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m497.09375 60.003906c-.03125 0-.0625-.003906-.09375-.003906h-136v-15c0-24.8125-20.1875-45-45-45h-120c-24.8125 0-45 20.1875-45 45v15h-136c-8.351562 0-15 6.84375-15 15v330c0 24.8125 20.1875 45 45 45h422c24.8125 0 45-20.1875 45-45v-329.683594c0-.019531 0-.039062 0-.058594-.574219-9.851562-6.632812-15.199218-14.90625-15.253906zm-316.09375-15.003906c0-8.269531 6.730469-15 15-15h120c8.269531 0 15 6.730469 15 15v15h-150zm295.1875 45-46.582031 139.742188c-2.042969 6.136718-7.761719 10.257812-14.226563 10.257812h-84.378906v-15c0-8.285156-6.714844-15-15-15h-120c-8.285156 0-15 6.714844-15 15v15h-84.378906c-6.464844 0-12.183594-4.121094-14.226563-10.257812l-46.582031-139.742188zm-175.1875 150v30h-90v-30zm181 165c0 8.269531-6.730469 15-15 15h-422c-8.269531 0-15-6.730469-15-15v-237.566406l23.933594 71.796875c6.132812 18.40625 23.289062 30.769531 42.6875 30.769531h84.378906v15c0 8.285156 6.714844 15 15 15h120c8.285156 0 15-6.714844 15-15v-15h84.378906c19.398438 0 36.554688-12.363281 42.6875-30.769531l23.933594-71.796875zm0 0" />
                                    </svg>
                                </i>
                                <span class="text-nowrap">Become a Partner</span>
                            </a>
                        </div>
                        <?php if (empty($user_details)) { ?>
                            <button class="btn btn-primary h-auto" data-bs-toggle="modal" data-bs-target="#loginRegisterModal">
                                <i>
                                    <svg fill="currentColor" width="16" height="16" viewBox="0 0 434 434" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M369.635 228.813C367.804 227.295 365.619 226.087 363.208 225.261C360.796 224.434 358.206 224.006 355.588 224C352.97 223.994 350.376 224.411 347.959 225.227C345.542 226.043 343.349 227.241 341.508 228.751C339.667 230.261 338.215 232.054 337.236 234.024C336.258 235.994 335.772 238.103 335.809 240.227C335.845 242.351 336.401 244.448 337.446 246.396C338.491 248.343 340.003 250.103 341.895 251.571C358.631 264.935 371.91 280.876 380.951 298.459C389.992 316.042 394.614 334.914 394.545 353.966C394.545 373.544 325.383 401.987 217 401.987C108.617 401.987 39.4553 373.53 39.4553 353.934C39.3889 335.013 43.9486 316.269 52.8705 298.787C61.7925 281.305 74.8994 265.432 91.4325 252.088C93.3025 250.609 94.7918 248.843 95.8141 246.893C96.8365 244.943 97.3714 242.848 97.388 240.729C97.4045 238.61 96.9023 236.509 95.9105 234.549C94.9187 232.588 93.4571 230.807 91.6104 229.309C89.7637 227.811 87.5686 226.625 85.1526 225.82C82.7366 225.015 80.1478 224.608 77.5362 224.621C74.9246 224.634 72.3422 225.069 69.939 225.898C67.5358 226.728 65.3595 227.936 63.5363 229.453C43.3243 245.767 27.3014 265.172 16.3955 286.545C5.48952 307.918 -0.0828713 330.834 0.000931352 353.966C0.000931352 405.95 111.795 434 217 434C322.205 434 433.999 405.95 433.999 353.966C434.087 330.678 428.438 307.611 417.385 286.119C406.332 264.626 390.098 245.143 369.635 228.813Z" />
                                        <path d="M216.499 224C238.702 224 260.406 217.431 278.866 205.125C297.327 192.818 311.716 175.326 320.212 154.861C328.709 134.395 330.932 111.876 326.601 90.1499C322.269 68.4241 311.577 48.4676 295.878 32.8041C280.178 17.1406 260.176 6.47364 238.399 2.1521C216.623 -2.16945 194.052 0.0485277 173.539 8.52554C153.027 17.0026 135.494 31.3579 123.159 49.7762C110.824 68.1945 104.24 89.8485 104.24 112C104.275 141.694 116.113 170.161 137.158 191.158C158.203 212.155 186.737 223.966 216.499 224ZM216.499 32C232.358 32 247.861 36.692 261.047 45.4825C274.233 54.273 284.511 66.7673 290.58 81.3854C296.649 96.0035 298.237 112.089 295.143 127.607C292.049 143.126 284.412 157.38 273.198 168.569C261.984 179.757 247.696 187.376 232.142 190.463C216.588 193.55 200.465 191.965 185.814 185.91C171.162 179.855 158.639 169.602 149.828 156.446C141.017 143.29 136.314 127.823 136.314 112C136.339 90.7904 144.795 70.4566 159.827 55.4591C174.859 40.4616 195.24 32.025 216.499 32Z" />
                                    </svg>
                                </i>
                                <span>Login</span>
                            </button>
                        <?php } else { ?>
                            <div class="btn-group">
                                <button class="btn btn-primary h-auto gap-2 rounded text-start py-1 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i>
                                        <svg fill="currentColor" width="16" height="16" viewBox="0 0 434 434" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M369.635 228.813C367.804 227.295 365.619 226.087 363.208 225.261C360.796 224.434 358.206 224.006 355.588 224C352.97 223.994 350.376 224.411 347.959 225.227C345.542 226.043 343.349 227.241 341.508 228.751C339.667 230.261 338.215 232.054 337.236 234.024C336.258 235.994 335.772 238.103 335.809 240.227C335.845 242.351 336.401 244.448 337.446 246.396C338.491 248.343 340.003 250.103 341.895 251.571C358.631 264.935 371.91 280.876 380.951 298.459C389.992 316.042 394.614 334.914 394.545 353.966C394.545 373.544 325.383 401.987 217 401.987C108.617 401.987 39.4553 373.53 39.4553 353.934C39.3889 335.013 43.9486 316.269 52.8705 298.787C61.7925 281.305 74.8994 265.432 91.4325 252.088C93.3025 250.609 94.7918 248.843 95.8141 246.893C96.8365 244.943 97.3714 242.848 97.388 240.729C97.4045 238.61 96.9023 236.509 95.9105 234.549C94.9187 232.588 93.4571 230.807 91.6104 229.309C89.7637 227.811 87.5686 226.625 85.1526 225.82C82.7366 225.015 80.1478 224.608 77.5362 224.621C74.9246 224.634 72.3422 225.069 69.939 225.898C67.5358 226.728 65.3595 227.936 63.5363 229.453C43.3243 245.767 27.3014 265.172 16.3955 286.545C5.48952 307.918 -0.0828713 330.834 0.000931352 353.966C0.000931352 405.95 111.795 434 217 434C322.205 434 433.999 405.95 433.999 353.966C434.087 330.678 428.438 307.611 417.385 286.119C406.332 264.626 390.098 245.143 369.635 228.813Z"></path>
                                            <path d="M216.499 224C238.702 224 260.406 217.431 278.866 205.125C297.327 192.818 311.716 175.326 320.212 154.861C328.709 134.395 330.932 111.876 326.601 90.1499C322.269 68.4241 311.577 48.4676 295.878 32.8041C280.178 17.1406 260.176 6.47364 238.399 2.1521C216.623 -2.16945 194.052 0.0485277 173.539 8.52554C153.027 17.0026 135.494 31.3579 123.159 49.7762C110.824 68.1945 104.24 89.8485 104.24 112C104.275 141.694 116.113 170.161 137.158 191.158C158.203 212.155 186.737 223.966 216.499 224ZM216.499 32C232.358 32 247.861 36.692 261.047 45.4825C274.233 54.273 284.511 66.7673 290.58 81.3854C296.649 96.0035 298.237 112.089 295.143 127.607C292.049 143.126 284.412 157.38 273.198 168.569C261.984 179.757 247.696 187.376 232.142 190.463C216.588 193.55 200.465 191.965 185.814 185.91C171.162 179.855 158.639 169.602 149.828 156.446C141.017 143.29 136.314 127.823 136.314 112C136.339 90.7904 144.795 70.4566 159.827 55.4591C174.859 40.4616 195.24 32.025 216.499 32Z"></path>
                                        </svg>
                                    </i>
                                    <div class="d-flex flex-column" style="line-height: 1.2;">
                                        <small style="font-size: 10px;">Welcome,</small>
                                        <small class="text-truncate" style="width:60px"><?= $first_name; ?></small>
                                    </div>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a href="<?= base_url('logout') ?>" class="dropdown-item">Logout</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                        <button class="btnico d-lg-none text-white" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuOffCanvas">
                            <svg fill="currentColor" enable-background="new 0 0 512 512" height="26" viewBox="0 0 512 512" width="26" xmlns="http://www.w3.org/2000/svg">
                                <path d="m128 102.4c0-14.138 11.462-25.6 25.6-25.6h332.8c14.138 0 25.6 11.462 25.6 25.6s-11.462 25.6-25.6 25.6h-332.8c-14.138 0-25.6-11.463-25.6-25.6zm358.4 128h-460.8c-14.138 0-25.6 11.463-25.6 25.6 0 14.138 11.462 25.6 25.6 25.6h460.8c14.138 0 25.6-11.462 25.6-25.6 0-14.137-11.462-25.6-25.6-25.6zm0 153.6h-230.4c-14.137 0-25.6 11.462-25.6 25.6 0 14.137 11.463 25.6 25.6 25.6h230.4c14.138 0 25.6-11.463 25.6-25.6 0-14.138-11.462-25.6-25.6-25.6z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php if (!empty($lastSegment)): ?>
        <div class="innerHero">
            <div class="container"></div>
        </div>
    <?php endif; ?>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenuOffCanvas">
        <div class="offcanvas-header bg-dark align-items-center p-4 text-white">
            <img src="<?= base_url('assets/customer/images/logo.svg') ?>" alt="" width="120" height="25">
            <button type="button" class="btnico text-white" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg width="20" height="20" viewBox="0 0 381 381" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.97081 7.97081C18.5988 -2.65694 35.8298 -2.65694 46.4579 7.97081L190.5 152.014L334.543 7.97081C345.17 -2.65694 362.402 -2.65694 373.03 7.97081C383.657 18.5988 383.657 35.8298 373.03 46.4579L228.987 190.5L373.03 334.543C383.657 345.17 383.657 362.402 373.03 373.03C362.402 383.657 345.17 383.657 334.543 373.03L190.5 228.987L46.4579 373.03C35.8298 383.657 18.5988 383.657 7.97081 373.03C-2.65694 362.402 -2.65694 345.17 7.97081 334.543L152.014 190.5L7.97081 46.4579C-2.65694 35.8298 -2.65694 18.5988 7.97081 7.97081Z" fill="currentColor" />
                </svg>
            </button>
        </div>
        <div class="offcanvas-body p-4">
            <ul class="mobileMainMenu d-flex flex-column gap-1">
                <li>
                    <a href="<?= base_url('') ?>" <?php if (empty($lastSegment)) { ?>class="active" <?php } ?>>Home</a>
                </li>
                <li>
                    <a href="<?= base_url('product-list') ?>" <?php if ($lastSegment == 'product-list') { ?>class="active" <?php } ?>>Shop</a>
                </li>
                <!-- <li>
                    <a href="<?= base_url('category') ?>" <?php if ($lastSegment == 'category') { ?>class="active" <?php } ?>>Category</a>
                </li> -->
                <li>
                    <a href="https://www.youtube.com/channel/UCqG_zja0MNnAPVdB4FpRBbg">Podcast</a>
                </li>
                <li>
                    <a href="<?= COMMOUNUTY_URL_LINK ?>">Community</a>
                </li>
                <li>
                    <a href="<?= base_url('blogs') ?>" <?php if ($lastSegment == 'blogs') { ?>class="active" <?php } ?>>Blogs</a>
                </li>
                <!-- <li>
                    <a href="<?= base_url('vendor-register') ?>" <?php if ($lastSegment == 'vendor-register') { ?>class="active" <?php } ?>>Vendor Resgister</a>
                </li>
                <li>
                    <a href="<?= base_url('vendor/login') ?>" <?php if ($lastSegment == 'login') { ?>class="active" <?php } ?>>Vendor Login</a>
                </li> -->
            </ul>
        </div>
        <div class="offcanvas-footer bg-dark d-flex flex-column gap-4 p-4">
            <a href="<?= base_url('vendor/login') ?>" target="_blank" class="btn btn-primary w-100">
                <i>
                    <svg fill="currentColor" width="16" height="16" viewBox="0 -31 512 512"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m497.09375 60.003906c-.03125 0-.0625-.003906-.09375-.003906h-136v-15c0-24.8125-20.1875-45-45-45h-120c-24.8125 0-45 20.1875-45 45v15h-136c-8.351562 0-15 6.84375-15 15v330c0 24.8125 20.1875 45 45 45h422c24.8125 0 45-20.1875 45-45v-329.683594c0-.019531 0-.039062 0-.058594-.574219-9.851562-6.632812-15.199218-14.90625-15.253906zm-316.09375-15.003906c0-8.269531 6.730469-15 15-15h120c8.269531 0 15 6.730469 15 15v15h-150zm295.1875 45-46.582031 139.742188c-2.042969 6.136718-7.761719 10.257812-14.226563 10.257812h-84.378906v-15c0-8.285156-6.714844-15-15-15h-120c-8.285156 0-15 6.714844-15 15v15h-84.378906c-6.464844 0-12.183594-4.121094-14.226563-10.257812l-46.582031-139.742188zm-175.1875 150v30h-90v-30zm181 165c0 8.269531-6.730469 15-15 15h-422c-8.269531 0-15-6.730469-15-15v-237.566406l23.933594 71.796875c6.132812 18.40625 23.289062 30.769531 42.6875 30.769531h84.378906v15c0 8.285156 6.714844 15 15 15h120c8.285156 0 15-6.714844 15-15v-15h84.378906c19.398438 0 36.554688-12.363281 42.6875-30.769531l23.933594-71.796875zm0 0">
                        </path>
                    </svg>
                </i>
                <span class="text-nowrap">Become a Partner</span>
            </a>
            <div class="d-flex flex-column gap-3">
                <a href="tel:917821839934" class="text-white d-flex align-items-center gap-3">
                    <i style="line-height: 0;">
                        <svg version="1.1" width="30" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 473.806 473.806" style="enable-background:new 0 0 473.806 473.806;" xml:space="preserve">
                            <path d="M374.456,293.506c-9.7-10.1-21.4-15.5-33.8-15.5c-12.3,0-24.1,5.3-34.2,15.4l-31.6,31.5c-2.6-1.4-5.2-2.7-7.7-4
                                c-3.6-1.8-7-3.5-9.9-5.3c-29.6-18.8-56.5-43.3-82.3-75c-12.5-15.8-20.9-29.1-27-42.6c8.2-7.5,15.8-15.3,23.2-22.8
                                c2.8-2.8,5.6-5.7,8.4-8.5c21-21,21-48.2,0-69.2l-27.3-27.3c-3.1-3.1-6.3-6.3-9.3-9.5c-6-6.2-12.3-12.6-18.8-18.6
                                c-9.7-9.6-21.3-14.7-33.5-14.7s-24,5.1-34,14.7c-0.1,0.1-0.1,0.1-0.2,0.2l-34,34.3c-12.8,12.8-20.1,28.4-21.7,46.5
                                c-2.4,29.2,6.2,56.4,12.8,74.2c16.2,43.7,40.4,84.2,76.5,127.6c43.8,52.3,96.5,93.6,156.7,122.7c23,10.9,53.7,23.8,88,26
                                c2.1,0.1,4.3,0.2,6.3,0.2c23.1,0,42.5-8.3,57.7-24.8c0.1-0.2,0.3-0.3,0.4-0.5c5.2-6.3,11.2-12,17.5-18.1c4.3-4.1,8.7-8.4,13-12.9
                                c9.9-10.3,15.1-22.3,15.1-34.6c0-12.4-5.3-24.3-15.4-34.3L374.456,293.506z M410.256,398.806
                                C410.156,398.806,410.156,398.906,410.256,398.806c-3.9,4.2-7.9,8-12.2,12.2c-6.5,6.2-13.1,12.7-19.3,20
                                c-10.1,10.8-22,15.9-37.6,15.9c-1.5,0-3.1,0-4.6-0.1c-29.7-1.9-57.3-13.5-78-23.4c-56.6-27.4-106.3-66.3-147.6-115.6
                                c-34.1-41.1-56.9-79.1-72-119.9c-9.3-24.9-12.7-44.3-11.2-62.6c1-11.7,5.5-21.4,13.8-29.7l34.1-34.1c4.9-4.6,10.1-7.1,15.2-7.1
                                c6.3,0,11.4,3.8,14.6,7c0.1,0.1,0.2,0.2,0.3,0.3c6.1,5.7,11.9,11.6,18,17.9c3.1,3.2,6.3,6.4,9.5,9.7l27.3,27.3
                                c10.6,10.6,10.6,20.4,0,31c-2.9,2.9-5.7,5.8-8.6,8.6c-8.4,8.6-16.4,16.6-25.1,24.4c-0.2,0.2-0.4,0.3-0.5,0.5
                                c-8.6,8.6-7,17-5.2,22.7c0.1,0.3,0.2,0.6,0.3,0.9c7.1,17.2,17.1,33.4,32.3,52.7l0.1,0.1c27.6,34,56.7,60.5,88.8,80.8
                                c4.1,2.6,8.3,4.7,12.3,6.7c3.6,1.8,7,3.5,9.9,5.3c0.4,0.2,0.8,0.5,1.2,0.7c3.4,1.7,6.6,2.5,9.9,2.5c8.3,0,13.5-5.2,15.2-6.9
                                l34.2-34.2c3.4-3.4,8.8-7.5,15.1-7.5c6.2,0,11.3,3.9,14.4,7.3c0.1,0.1,0.1,0.1,0.2,0.2l55.1,55.1
                                C420.456,377.706,420.456,388.206,410.256,398.806z" />
                            <path d="M256.056,112.706c26.2,4.4,50,16.8,69,35.8s31.3,42.8,35.8,69c1.1,6.6,6.8,11.2,13.3,11.2c0.8,0,1.5-0.1,2.3-0.2
                                c7.4-1.2,12.3-8.2,11.1-15.6c-5.4-31.7-20.4-60.6-43.3-83.5s-51.8-37.9-83.5-43.3c-7.4-1.2-14.3,3.7-15.6,11
                                S248.656,111.506,256.056,112.706z" />
                            <path d="M473.256,209.006c-8.9-52.2-33.5-99.7-71.3-137.5s-85.3-62.4-137.5-71.3c-7.3-1.3-14.2,3.7-15.5,11
                                c-1.2,7.4,3.7,14.3,11.1,15.6c46.6,7.9,89.1,30,122.9,63.7c33.8,33.8,55.8,76.3,63.7,122.9c1.1,6.6,6.8,11.2,13.3,11.2
                                c0.8,0,1.5-0.1,2.3-0.2C469.556,223.306,474.556,216.306,473.256,209.006z" />
                        </svg>
                    </i>
                    <div>
                        <h6 class="text-white">Phone</h6>
                        <div>+91 7821839934</div>
                    </div>
                </a>
                <a href="mailto:sales@foundrybiz.com" class="text-white d-flex align-items-center gap-3">
                    <i style="line-height: 0;">
                        <svg version="1.1" width="30" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <path d="M467,61H45C20.218,61,0,81.196,0,106v300c0,24.72,20.128,45,45,45h422c24.72,0,45-20.128,45-45V106
                                C512,81.28,491.872,61,467,61z M460.786,91L256.954,294.833L51.359,91H460.786z M30,399.788V112.069l144.479,143.24L30,399.788z
                                M51.213,421l144.57-144.57l50.657,50.222c5.864,5.814,15.327,5.795,21.167-0.046L317,277.213L460.787,421H51.213z M482,399.787
                                L338.213,256L482,112.212V399.787z" />
                        </svg>
                    </i>
                    <div>
                        <h6 class="text-white">Email</h6>
                        <div>sales@foundrybiz.com</div>
                    </div>
                </a>
            </div>
            <?php if (empty($user_details)) { ?>
                <button class="btn btn-primary h-auto w-100" data-bs-toggle="modal" data-bs-target="#loginRegisterModal" data-bs-dismiss="offcanvas">
                    <i>
                        <svg fill="currentColor" width="16" height="16" viewBox="0 0 434 434" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M369.635 228.813C367.804 227.295 365.619 226.087 363.208 225.261C360.796 224.434 358.206 224.006 355.588 224C352.97 223.994 350.376 224.411 347.959 225.227C345.542 226.043 343.349 227.241 341.508 228.751C339.667 230.261 338.215 232.054 337.236 234.024C336.258 235.994 335.772 238.103 335.809 240.227C335.845 242.351 336.401 244.448 337.446 246.396C338.491 248.343 340.003 250.103 341.895 251.571C358.631 264.935 371.91 280.876 380.951 298.459C389.992 316.042 394.614 334.914 394.545 353.966C394.545 373.544 325.383 401.987 217 401.987C108.617 401.987 39.4553 373.53 39.4553 353.934C39.3889 335.013 43.9486 316.269 52.8705 298.787C61.7925 281.305 74.8994 265.432 91.4325 252.088C93.3025 250.609 94.7918 248.843 95.8141 246.893C96.8365 244.943 97.3714 242.848 97.388 240.729C97.4045 238.61 96.9023 236.509 95.9105 234.549C94.9187 232.588 93.4571 230.807 91.6104 229.309C89.7637 227.811 87.5686 226.625 85.1526 225.82C82.7366 225.015 80.1478 224.608 77.5362 224.621C74.9246 224.634 72.3422 225.069 69.939 225.898C67.5358 226.728 65.3595 227.936 63.5363 229.453C43.3243 245.767 27.3014 265.172 16.3955 286.545C5.48952 307.918 -0.0828713 330.834 0.000931352 353.966C0.000931352 405.95 111.795 434 217 434C322.205 434 433.999 405.95 433.999 353.966C434.087 330.678 428.438 307.611 417.385 286.119C406.332 264.626 390.098 245.143 369.635 228.813Z" />
                            <path d="M216.499 224C238.702 224 260.406 217.431 278.866 205.125C297.327 192.818 311.716 175.326 320.212 154.861C328.709 134.395 330.932 111.876 326.601 90.1499C322.269 68.4241 311.577 48.4676 295.878 32.8041C280.178 17.1406 260.176 6.47364 238.399 2.1521C216.623 -2.16945 194.052 0.0485277 173.539 8.52554C153.027 17.0026 135.494 31.3579 123.159 49.7762C110.824 68.1945 104.24 89.8485 104.24 112C104.275 141.694 116.113 170.161 137.158 191.158C158.203 212.155 186.737 223.966 216.499 224ZM216.499 32C232.358 32 247.861 36.692 261.047 45.4825C274.233 54.273 284.511 66.7673 290.58 81.3854C296.649 96.0035 298.237 112.089 295.143 127.607C292.049 143.126 284.412 157.38 273.198 168.569C261.984 179.757 247.696 187.376 232.142 190.463C216.588 193.55 200.465 191.965 185.814 185.91C171.162 179.855 158.639 169.602 149.828 156.446C141.017 143.29 136.314 127.823 136.314 112C136.339 90.7904 144.795 70.4566 159.827 55.4591C174.859 40.4616 195.24 32.025 216.499 32Z" />
                        </svg>
                    </i>
                    <span>Login</span>
                </button>
            <?php } else { ?>
                <div class="btn-group">
                    <button class="btn btn-primary h-auto gap-2 rounded text-start py-1 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i>
                            <svg fill="currentColor" width="16" height="16" viewBox="0 0 434 434" xmlns="http://www.w3.org/2000/svg">
                                <path d="M369.635 228.813C367.804 227.295 365.619 226.087 363.208 225.261C360.796 224.434 358.206 224.006 355.588 224C352.97 223.994 350.376 224.411 347.959 225.227C345.542 226.043 343.349 227.241 341.508 228.751C339.667 230.261 338.215 232.054 337.236 234.024C336.258 235.994 335.772 238.103 335.809 240.227C335.845 242.351 336.401 244.448 337.446 246.396C338.491 248.343 340.003 250.103 341.895 251.571C358.631 264.935 371.91 280.876 380.951 298.459C389.992 316.042 394.614 334.914 394.545 353.966C394.545 373.544 325.383 401.987 217 401.987C108.617 401.987 39.4553 373.53 39.4553 353.934C39.3889 335.013 43.9486 316.269 52.8705 298.787C61.7925 281.305 74.8994 265.432 91.4325 252.088C93.3025 250.609 94.7918 248.843 95.8141 246.893C96.8365 244.943 97.3714 242.848 97.388 240.729C97.4045 238.61 96.9023 236.509 95.9105 234.549C94.9187 232.588 93.4571 230.807 91.6104 229.309C89.7637 227.811 87.5686 226.625 85.1526 225.82C82.7366 225.015 80.1478 224.608 77.5362 224.621C74.9246 224.634 72.3422 225.069 69.939 225.898C67.5358 226.728 65.3595 227.936 63.5363 229.453C43.3243 245.767 27.3014 265.172 16.3955 286.545C5.48952 307.918 -0.0828713 330.834 0.000931352 353.966C0.000931352 405.95 111.795 434 217 434C322.205 434 433.999 405.95 433.999 353.966C434.087 330.678 428.438 307.611 417.385 286.119C406.332 264.626 390.098 245.143 369.635 228.813Z"></path>
                                <path d="M216.499 224C238.702 224 260.406 217.431 278.866 205.125C297.327 192.818 311.716 175.326 320.212 154.861C328.709 134.395 330.932 111.876 326.601 90.1499C322.269 68.4241 311.577 48.4676 295.878 32.8041C280.178 17.1406 260.176 6.47364 238.399 2.1521C216.623 -2.16945 194.052 0.0485277 173.539 8.52554C153.027 17.0026 135.494 31.3579 123.159 49.7762C110.824 68.1945 104.24 89.8485 104.24 112C104.275 141.694 116.113 170.161 137.158 191.158C158.203 212.155 186.737 223.966 216.499 224ZM216.499 32C232.358 32 247.861 36.692 261.047 45.4825C274.233 54.273 284.511 66.7673 290.58 81.3854C296.649 96.0035 298.237 112.089 295.143 127.607C292.049 143.126 284.412 157.38 273.198 168.569C261.984 179.757 247.696 187.376 232.142 190.463C216.588 193.55 200.465 191.965 185.814 185.91C171.162 179.855 158.639 169.602 149.828 156.446C141.017 143.29 136.314 127.823 136.314 112C136.339 90.7904 144.795 70.4566 159.827 55.4591C174.859 40.4616 195.24 32.025 216.499 32Z"></path>
                            </svg>
                        </i>
                        <div class="d-flex flex-column" style="line-height: 1.2;">
                            <small style="font-size: 10px;">Welcome,</small>
                            <small class="text-truncate" style="width:60px"><?= $first_name; ?></small>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="<?= base_url('logout') ?>" class="dropdown-item">Logout</a></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- =============Login Register Modal ================= -->
    <div class="modal fade" id="loginRegisterModal" tabindex="-1" aria-labelledby="loginRegisterModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <ul class="nav nav-pills m-0 d-flex" id="pills-tab" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link rounded-0 w-100 active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true">Login</button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link w-100 rounded-0" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register" aria-selected="false">Register</button>
                        </li>
                    </ul>
                    <div class="tab-content p-4" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab" tabindex="0">
                            <form id="loginForm">
                                <div class="d-flex flex-column gap-3">
                                    <div>
                                        <input type="email" id="loginEmail" class="form-control" placeholder="Email address*" required />
                                    </div>
                                    <div>
                                        <input type="password" id="loginPassword" class="form-control" placeholder="************" required />
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="Remember" checked />
                                        <label class="form-check-label" for="Remember">Remember me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary justify-content-center w-100">Login</button>
                                </div>
                            </form>
                            <div class="mt-2 text-end">
                                <a href="javascript:void(0);" onclick="forgetPasswordModel()" class="text-decoration-none  fw-semibold">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab" tabindex="0">
                            <form id="registerForm">
                                <div class="d-flex flex-column gap-3">
                                    <div class="position-relative p-4 rounded-10 bg-light border overflow-hidden text-center">
                                        <img id="avatarPreview"
                                            src="<?= base_url('assets/customer/images/upload-image.svg') ?>"
                                            class="rounded-circle mb-2"
                                            width="80" height="80"
                                            style="object-fit: cover;">

                                        <strong class="d-block mb-1">Upload Profile Image</strong>
                                        <small class="d-block" style="color:#666">JPG, PNG, or GIF. Max: 2MB.</small>

                                        <input class="form-control position-absolute start-0 end-0 top-0 bottom-0"
                                            type="file"
                                            id="avatarInput"
                                            name="avatar"
                                            accept="image/*"
                                            style="opacity: 0; cursor: pointer;"
                                            required>

                                        <small class="text-danger d-block" id="error-avatar"></small>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const input = document.getElementById('avatarInput');
                                            const preview = document.getElementById('avatarPreview');
                                            const error = document.getElementById('error-avatar');

                                            input.addEventListener('change', function() {
                                                const file = this.files[0];
                                                error.textContent = '';

                                                if (!file) return;

                                                if (!file.type.startsWith('image/')) {
                                                    error.textContent = 'Only image files are allowed.';
                                                    return;
                                                }

                                                if (file.size > 2 * 1024 * 1024) {
                                                    error.textContent = 'Image size must be less than 2MB.';
                                                    return;
                                                }

                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    preview.src = e.target.result;
                                                };
                                                reader.readAsDataURL(file);
                                            });
                                        });
                                    </script>
                                    <!-- <div class="position-relative p-4 rounded-10 bg-light border overflow-hidden text-center">
                                
                                <div class="d-inline-flex mb-1">
                                    <img id="avatarPreview" src="<?= base_url('assets/customer/images/upload-image.svg') ?>" alt="Avatar Preview" class="rounded-circle" width="80" height="80" style="object-fit: cover;">
                                </div>
                                <strong class="d-block mb-1">Upload Profile Image*</strong>
                                <small class="d-block" style="color:#666">Choose a clear profile photo to help others recognize you. JPG, PNG, or GIF formats are supported. Max size: 2MB.</small>
                                <input style="opacity: 0;" class="form-control position-absolute start-0 end-0 top-0 bottom-0" type="file" id="avatarInput" accept="image/*" required>
                            </div> -->

                                    <div>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Name*" required>
                                        <small class="text-danger d-block" id="error-name"></small>
                                    </div>

                                    <div>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email*" required>
                                        <small class="text-danger d-block" id="error-email"></small>
                                    </div>

                                    <div>
                                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone Number*" required>
                                        <small class="text-danger d-block" id="error-phone"></small>
                                    </div>
                                    <div>
                                        <input type="text" inputmode="text" autocomplete="organization" autocapitalize="words " id="company" name="company" class="form-control" placeholder="Company*" required>
                                        <small class="text-danger d-block" id="error-company"></small>
                                    </div>
                                    <!-- <div>
                                        <lebel for="dob" class="form-label">Date of Birth*</label>
                                            <input type="date" id="dob" name="dob" class="form-control" placeholder="ented dob*" required>
                                            <small class="text-danger d-block" id="error-dob"></small>
                                    </div> -->
                                    <div>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password*" required>
                                        <small class="text-danger d-block" id="error-password"></small>
                                    </div>

                                    <!-- <div>
                                <textarea id="message" name="message" class="form-control" rows="3" placeholder="Message"></textarea>
                            </div> -->

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" checked>
                                        <label class="form-check-label" for="remember">Remember me</label>
                                    </div>

                                    <button type="button" id="saveButton" class="btn btn-primary justify-content-center w-100" onclick="submitRegistration()">Register</button>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- forget password  -->

    <div class="modal fade" id="forgetPasswordModal" tabindex="-1" aria-labelledby="forgetPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="forgetPasswordForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="forgetPasswordModalLabel">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="email" id="forgetEmail" class="form-control" placeholder="Enter your email" required>
                        <div id="forgetMessage" class="mt-2 small"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="forgetResetBtn" class="btn btn-primary">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        const BASEURL = "<?= base_url(); ?>";

        function forgetPasswordModel() {
            var myModal = new bootstrap.Modal(document.getElementById('forgetPasswordModal'));
            myModal.show();
            const regModal = bootstrap.Modal.getInstance(document.getElementById('loginRegisterModal'));
            regModal.hide();
        }



        document.getElementById("forgetPasswordForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let email = document.getElementById("forgetEmail").value;
            let resetBtn = document.getElementById("forgetResetBtn");
            resetBtn.disabled = true;
            resetBtn.innerText = "Please wait...";

            fetch(BASEURL + "customer/api/forget-password-email-check", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        MessError.fire({
                            icon: 'success',
                            title: data.message,
                        });
                        let modal = bootstrap.Modal.getInstance(document.getElementById('forgetPasswordModal'));
                        modal.hide();
                    } else {
                        MessError.fire({
                            icon: 'error',
                            title: data.message,
                        });

                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("❌ Server error, please try again later.");
                })
                .finally(() => {
                    resetBtn.disabled = false;
                    resetBtn.innerText = "Reset Password";
                });
        });
    </script>

    </script>

    <script>
        document.getElementById("avatarInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("avatarPreview").src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script>
        function redirectToregisterPage() {
            return window.location.href = BASEURL + 'vendor-register';
        }

        function vendorloginPage() {
            return window.location.href = BASEURL + 'vendor';
        }

        function submitRegistration() {
            // Clear all previous errors
            ['avatar', 'name', 'email', 'phone', 'password'].forEach(id => {
                document.getElementById('error-' + id).textContent = '';
            });

            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            // const dob = document.getElementById('dob').value.trim();
            const password = document.getElementById('password').value.trim();
            //const message = document.getElementById('message').value.trim();
            const avatarInput = document.getElementById('avatarInput');
            const company = document.getElementById('company').value.trim();
            const avatarFile = avatarInput.files[0];

            let hasError = false;

            // if (!avatarFile) {
            //     document.getElementById('error-avatar').textContent = 'Profile image is required.';
            //     hasError = true;
            // }
            if (!company) {
                document.getElementById('error-company').textContent = 'Company name is required.';
                hasError = true;
            }
            if (!name) {
                document.getElementById('error-name').textContent = 'Name is required.';
                hasError = true;
            }

            if (!email) {
                document.getElementById('error-email').textContent = 'Email is required.';
                hasError = true;
            }

            if (!phone) {
                document.getElementById('error-phone').textContent = 'Phone is required.';
                hasError = true;
            }

            // if (!dob) {
            //     document.getElementById('error-dob').textContent = 'dob is required.';
            //     hasError = true;
            // }

            if (!password) {
                document.getElementById('error-password').textContent = 'Password is required.';
                hasError = true;
            }

            if (hasError) return;

            const formData = new FormData();
            formData.append('image', avatarFile);
            formData.append('name', name);
            formData.append('email', email);
            formData.append('mobile', phone);
            // formData.append('dob', dob);
            formData.append('company', company);
            formData.append('password', password);
            //formData.append('message', message);
            const $button = $('#saveButton');
            $button.prop('disabled', true).text('Loading...');
            fetch(`${BASEURL}customer/api/ragister`, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(response => {
                    console.log(response);
                    if (response.success) {
                        MessSuccess.fire({
                            icon: 'success',
                            title: 'Registration Successful!',
                        });
                        // Close register, show login
                        const regModal = bootstrap.Modal.getInstance(document.getElementById('loginRegisterModal'));
                        regModal.hide();

                        setTimeout(() => {
                            const loginModal = new bootstrap.Modal(document.getElementById('loginRegisterModal'));
                            document.getElementById('pills-login-tab').click(); // Switch to login tab
                            loginModal.show();
                        }, 1600);


                    } else {
                        MessError.fire({
                            icon: 'error',
                            title: 'Email is already exits',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error submitting form:', error);
                    MessError.fire({
                        icon: 'error',
                        title: 'Unable to submit. Try again later.',
                    });
                });
        }
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');

            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const email = document.getElementById('loginEmail').value.trim();
                const password = document.getElementById('loginPassword').value.trim();
                const remember = document.getElementById('Remember').checked;

                // Make your API call here
                fetch(`${BASEURL}customer/api/login`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            email,
                            password
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {

                        if (data.success) {
                            MessSuccess.fire({
                                icon: 'success',
                                title: 'Login Successful !!',
                            });
                            location.reload();
                        } else {
                            MessError.fire({
                                icon: 'error',
                                title: data.message || 'Invalid credentials.',
                            });
                        }
                    })
                    .catch(err => {
                        console.error('Login error:', err);
                        MessError.fire({
                            icon: 'error',
                            title: 'Unable to login. Please try again later.',
                        });
                    });
            });
        });
    </script>