<section class="py-md-5 py-4">
    <div class="container">
        <div class="row g-4 gx-lg-5">
            <div class="col-md-6">
                <div class="zoom-wrapper-container">
                    <div style="--swiper-navigation-color: #000; --swiper-pagination-color: #000;"
                        class="swiper product-main-slider">
                        <div class="swiper-wrapper">
                            <?php

                            use Config\View;


                            foreach ($resp['images'] as $row) {
                            ?>
                                <div class="swiper-slide">
                                    <img class="drift-img" src="<?= base_url($row['image']) ?>"
                                        data-zoom="<?= base_url($row['image']) ?>" />
                                </div>
                            <?php }
                            ?>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                <!-- Thumbnail Slider -->
                <div class="swiper thumb-slider mt-3">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($resp['images'] as $row) {
                        ?>
                            <div class="swiper-slide"><img src="<?= base_url($row['image']) ?>" width="100" height="100" />
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
                <link rel="stylesheet"
                    href="https://cdnjs.cloudflare.com/ajax/libs/drift-zoom/1.3.1/drift-basic.min.css" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/drift-zoom/1.3.1/Drift.min.js"></script>
                <script>
                    let drift;

                    const thumbSwiper = new Swiper(".thumb-slider", {
                        spaceBetween: 10,
                        slidesPerView: 3,
                        freeMode: true,
                        watchSlidesProgress: true,
                        breakpoints: {
                            640: {
                                slidesPerView: 3
                            },
                            768: {
                                slidesPerView: 4
                            },
                            1024: {
                                slidesPerView: 5
                            },
                        },
                    });

                    const mainSwiper = new Swiper(".product-main-slider", {
                        spaceBetween: 10,
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                        thumbs: {
                            swiper: thumbSwiper,
                        },
                        on: {
                            init: function() {
                                initDriftZoom();
                            },
                            slideChangeTransitionEnd: function() {
                                setTimeout(() => {
                                    initDriftZoom();
                                }, 100);
                            }
                        }
                    });

                    function initDriftZoom() {
                        // Remove old zoom pane if it exists
                        const oldPane = document.querySelector(".drift-zoom-pane");
                        if (oldPane) oldPane.remove();

                        // Select new active image
                        const activeImage = document.querySelector(".product-main-slider .swiper-slide-active .drift-img");
                        const paneContainer = document.querySelector(".zoom-wrapper-container");

                        if (activeImage && paneContainer) {
                            // Recreate new Drift instance
                            drift = new Drift(activeImage, {
                                paneContainer: paneContainer,
                                inlinePane: 768,
                                zoomFactor: 2,
                                containInline: true,
                            });
                        }
                    }
                </script>
            </div>
            <div class="col-md-6">
                <div class="stkysec position-sticky" style="top: 100px;">
                    <h1 class="h2 mb-2"><?= $resp['name']; ?></h1>
                    <!--  verify components -->
                    <?= view('components/verify_badge', ['is_verify' => $resp['is_verify']]) ?>

                    <div class="mb-2 d-flex items-center gap-2">
                        <?php
                        $rating = $resp['total_rating_percent'];
                        $fullStars = floor($rating);
                        $halfStar = ($rating - $fullStars) >= 0.5;
                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

                        $starSvg = function ($fill) {
                            $color = match ($fill) {
                                'full' => '#F6AB27',
                                'half' => 'url(#halfGradient)',
                                'empty' => '#E0E0E0',
                            };
                            return <<<SVG
                            <svg width="16" height="16" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs> <linearGradient id="halfGradient"> <stop offset="50%" stop-color="#F6AB27"/> <stop offset="50%" stop-color="#E0E0E0"/> </linearGradient></defs>
                            <path d="M50 5L61 35H95L67 57L78 90L50 70L22 90L33 57L5 35H39L50 5Z" fill="$color"/>
                            </svg>
                            SVG;
                        };
                        ?>
                        <i style="display: flex; gap: 2px; line-height: 0;">
                            <?php
                            for ($i = 0; $i < $fullStars; $i++) echo $starSvg('full');
                            if ($halfStar) echo $starSvg('half');
                            for ($i = 0; $i < $emptyStars; $i++) echo $starSvg('empty');
                            ?>
                        </i>
                        <small style="color: #666;"><?= $resp['total_rating_percent'] ?>
                            (<?= $resp['total_customer_review'] ?> reviews)</small>
                    </div>

                    <?php if (!empty($customerDetails) && !empty($vendor)): ?>
                        <?php
                        $vendor = $vendor[0];
                        $image = !empty($resp['vendor_image'])
                            ? base_url($resp['vendor_image'])
                            : base_url('assets/customer/images/default_vendor.png');
                        ?>
                        <div class="p-3 rounded-10 border d-flex align-items-center gap-3 mb-3">
                            <i style="line-height: 0;">
                                <img src="<?= $image ?>" class="rounded-10 object-fit-cover" width="80" height="80">
                            </i>
                            <div>
                                <div class="d-flex flex-column gap-1">
                                    <?php if (!empty($resp['vendor_is_verify']) && $resp['vendor_is_verify'] == 1): ?>
                                        <small class="d-flex align-items-center gap-1">
                                            <i style="line-height: 0;">
                                                <!-- verified icon -->
                                                <svg width="13" height="14" viewBox="0 0 13 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.69883 1.04935 ... Z"
                                                        fill="#3A9F6C"></path>
                                                </svg>
                                            </i>
                                            <span class="fw-600">Verified</span>
                                        </small>
                                    <?php endif; ?>

                                    <h5 class="m-0"><?= $resp['vendor_name'] ?></h5>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="d-flex gap-3">
                        <button class="btn btn-primary d-inline-flex gap-2 " onclick="openCustomerVendorDetails()">
                            <i style="line-height: 0;">
                                <svg width="12" height="16" viewBox="0 0 12 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.9273 14.1883L9.73663 11.7164C9.48038 11.1883 9.14913 10.8039 8.57725 11.0383L7.44913 11.457C6.546 11.8758 6.096 11.457 5.64288 10.8258L3.61163 6.2039C3.35538 5.67577 3.48975 5.17889 4.06163 4.94452L5.63975 4.31327C6.21163 4.07577 6.121 3.58202 5.86475 3.05389L4.51163 0.535145C4.25538 0.00702 3.73038 -0.121105 3.1585 0.11327C2.01475 0.585145 1.06788 1.32577 0.452254 2.42265C-0.297746 3.76327 0.0772543 5.62889 0.227254 6.41327C0.377254 7.19765 0.902254 8.57265 1.58038 9.98202C2.2585 11.3945 2.85225 12.5039 3.38663 13.132C3.91788 13.7601 5.19288 15.4789 6.771 15.8633C8.06475 16.1758 9.46163 15.9133 10.6054 15.4414C11.1804 15.2164 11.1804 14.7195 10.9273 14.1883Z"
                                        fill="white" />
                                </svg>
                            </i>
                            <span>View Seller Details </span>
                        </button>
                    </div>
                    <p class="d-flex gap-3 mt-3"><?= $resp['description']; ?></p>
                </div>
            </div>
            <?php if (!empty($resp['html_description'])): ?>
                <!-- <div class="col-12">
                    <div class="card text-bg-dark m-0">
                        <h5 class="card-header">Description</h5>
                        <div class="card-body listStyle">
                            <?= $resp['html_description']; ?>
                        </div>
                    </div>
                </div> -->
            <?php endif; ?>
            <div class="col-12">
                <div class="card text-bg-dark m-0 fadeUp">
                    <h5 class="card-header">Customer Reviews</h5>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3 mb-4">
                            <?php if (!empty($reviews)) {
                                foreach ($reviews as $row) {
                            ?>
                                    <div class="bg-light p-3 rounded-10">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <i style="line-height: 0;">
                                                    <img src="<?= !empty($row['customer_image']) ? base_url($row['customer_image']) : 'https://app.pagarai.com/public/images/user.svg' ?>"
                                                        alt="" class="rounded-circle" height="60" width="60">
                                                </i>
                                                <div class="">
                                                    <strong class="d-block"><?= $row['customer_name'] ?></strong>
                                                    <?php
                                                    $rating = $row['rating'];
                                                    $fullStars = floor($rating);
                                                    $halfStar = ($rating - $fullStars) >= 0.5;
                                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

                                                    $starSvg = function ($fill) {
                                                        $color = match ($fill) {
                                                            'full' => '#F6AB27',
                                                            'half' => 'url(#halfGradient)',
                                                            'empty' => '#E0E0E0',
                                                        };
                                                        return <<<SVG
                                                <svg width="16" height="16" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                                <defs> <linearGradient id="halfGradient"> <stop offset="50%" stop-color="#F6AB27"/> <stop offset="50%" stop-color="#E0E0E0"/> </linearGradient></defs>
                                                <path d="M50 5L61 35H95L67 57L78 90L50 70L22 90L33 57L5 35H39L50 5Z" fill="$color"/>
                                                </svg>
                                                SVG;
                                                    };
                                                    ?>
                                                    <i style="display: flex; gap: 2px; line-height: 0;">
                                                        <?php
                                                        for ($i = 0; $i < $fullStars; $i++) echo $starSvg('full');
                                                        if ($halfStar) echo $starSvg('half');
                                                        for ($i = 0; $i < $emptyStars; $i++) echo $starSvg('empty');
                                                        ?>
                                                    </i>
                                                </div>
                                            </div>
                                            <small><?= $row['created_at'] ?></small>
                                        </div>
                                        <div><?= $row['review'] ?></div>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                        <div class="text-center fadeUp">
                            <button class="btn btn-primary d-inline-flex gap-2" data-bs-toggle="modal"
                                data-bs-target="#giveReviewModal">
                                <?php if (!empty($customerDetails)) { ?>
                                    <span>Leave A Review</span>
                                <?php } else { ?>
                                    <span>Sign in to leave a Review</span>
                                <?php } ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $filteredProducts = array_filter($product, function ($row) use ($resp) {
                return $row['uid'] !== $resp['uid'];
            });
            ?>
            <?php if (!empty($filteredProducts)) { ?>
                <div class="col-12">
                    <h2 class="mb-3">You Might Also Like</h2>
                    <div class="px-3 position-relative fadeUp">
                        <div class="swiper slide4">
                            <div class="swiper-wrapper">
                                <?php foreach ($filteredProducts as $row) {

                                    if ($row['uid'] == $resp['uid']) {
                                        continue;
                                    }
                                ?>
                                    <?php if ($row['slug'] === null) {
                                        $slug = $row['uid'];
                                    } else {
                                        $slug = $row['slug'];
                                    } ?>

                                    <div class="swiper-slide">
                                        <a href="<?= base_url('product/' . $slug) ?>"
                                            class="h-100 rounded-10 border bg-white overflow-hidden d-block">
                                            <img src="<?= base_url($row['main_image']) ?>" alt="" class="w-100 object-fit-cover"
                                                style="height:250px;">
                                            <div class="p-lg-3 p-2">
                                                <h5 class="mb-1" style="height:50px;">
                                                    <?= substr(strip_tags($row['name']), 0, 40) ?><?= strlen(strip_tags($row['name'])) > 40 ? '...' : '' ?>
                                                </h5>

                                                <?php if (!empty($row['is_vendor_verify']) && $row['is_vendor_verify'] == 1): ?>
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle-fill"></i> Sponsored
                                                    </span>
                                                <?php endif; ?>
                                                <!-- <small class="d-flex align-items-center gap-1">

                                                <span class="fw-600">Price: <?= $row['price']; ?></span> // vendor_name 
                                                    <span class="fw-600">Supplier Name: <?= $row['vendor_name']; ?></span>
                                                </small> -->
                                                <?php
                                                // Rating display
                                                $rating = $row['total_rating_percent'];
                                                $fullStars = floor($rating);
                                                $halfStar = ($rating - $fullStars) >= 0.5;
                                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

                                                $starSvg = function ($fill) {
                                                    $color = match ($fill) {
                                                        'full' => '#F6AB27',
                                                        'half' => 'url(#halfGradient)',
                                                        'empty' => '#E0E0E0',
                                                    };
                                                    return <<<SVG
                                                        <svg width="16" height="16" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                                        <defs><linearGradient id="halfGradient"><stop offset="50%" stop-color="#F6AB27"/><stop offset="50%" stop-color="#E0E0E0"/></linearGradient></defs>
                                                        <path d="M50 5L61 35H95L67 57L78 90L50 70L22 90L33 57L5 35H39L50 5Z" fill="$color"/>
                                                        </svg>
                                                        SVG;
                                                };
                                                ?>
                                                <i style="display: flex; gap: 2px; line-height: 0;">
                                                    <?php
                                                    for ($i = 0; $i < $fullStars; $i++) echo $starSvg('full');
                                                    if ($halfStar) echo $starSvg('half');
                                                    for ($i = 0; $i < $emptyStars; $i++) echo $starSvg('empty');
                                                    ?>
                                                </i>
                                                <small style="color: #666;"><?= $row['total_rating_percent'] ?>
                                                    (<?= $row['total_rating_percent'] ?> reviews)</small>

                                                <div class="my-1" style="color: #666;">
                                                    <?= substr(strip_tags($row['description']), 0, 95) ?><?= strlen(strip_tags($row['description'])) > 95 ? '...' : '' ?>
                                                </div>

                                                <!-- <div
                                                    class="text-dark fw-600 d-flex gap-2 justify-content-between align-items-center">
                                                    <span><?= $row['vendor_name'] ?></span>
                                                    <?php if (!empty($row['is_vendor_verify']) && $row['is_vendor_verify'] == 1): ?>
                                                        <small class="d-flex align-items-center gap-1">
                                                            <span class="fw-600">Verified</span>
                                                            <i style="line-height: 0;">
                                                                <svg width="13" height="14" viewBox="0 0 13 14" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M9.69883 1.04935C9.56974 0.843073 9.37955 0.682175 9.15473 0.589057C8.92992 0.495939 8.68167 0.475233 8.44454 0.529821L6.76156 0.916427C6.58908 0.956072 6.40986 0.956072 6.23739 0.916427L4.5544 0.529821C4.31727 0.475233 4.06902 0.495939 3.84421 0.589057C3.6194 0.682175 3.42921 0.843073 3.30012 1.04935L2.38281 2.5134C2.28921 2.66317 2.16284 2.78955 2.01308 2.88409L0.549128 3.80146C0.343218 3.93044 0.182567 4.12034 0.0894753 4.34478C-0.00361686 4.56922 -0.0245326 4.81708 0.0296313 5.05395L0.416212 6.73891C0.455711 6.9111 0.455711 7.09 0.416212 7.26219L0.0296313 8.94621C-0.0247431 9.18322 -0.00393263 9.43128 0.0891696 9.65592C0.182272 9.88055 0.34304 10.0706 0.549128 10.1996L2.01308 11.117C2.16284 11.2106 2.28921 11.337 2.38375 11.4868L3.30106 12.9508C3.56502 13.373 4.0686 13.5817 4.5544 13.4703L6.23739 13.0837C6.40986 13.0441 6.58908 13.0441 6.76156 13.0837L8.44548 13.4703C8.68247 13.5247 8.93052 13.5039 9.15514 13.4108C9.37976 13.3177 9.56979 13.1569 9.69883 12.9508L10.6161 11.4868C10.7097 11.337 10.8361 11.2106 10.9859 11.117L12.4508 10.1996C12.6569 10.0704 12.8175 9.88015 12.9105 9.65534C13.0034 9.43052 13.024 9.18233 12.9693 8.94528L12.5837 7.26219C12.544 7.0897 12.544 6.91046 12.5837 6.73798L12.9703 5.05395C13.0247 4.81704 13.004 4.56905 12.9111 4.34442C12.8182 4.1198 12.6576 3.9297 12.4517 3.80052L10.9868 2.88315C10.8372 2.78937 10.7108 2.66296 10.6171 2.5134L9.69883 1.04935ZM9.228 4.9126C9.2859 4.80613 9.30024 4.68136 9.26802 4.56453C9.23579 4.44771 9.15951 4.34793 9.05523 4.28621C8.95094 4.22448 8.82678 4.20561 8.70887 4.23358C8.59096 4.26154 8.48849 4.33415 8.42302 4.43613L5.9753 8.57927L4.4973 7.1639C4.45346 7.11887 4.40099 7.08314 4.34304 7.05883C4.28508 7.03452 4.22283 7.02214 4.15998 7.02241C4.09714 7.02269 4.03499 7.03562 3.97725 7.06043C3.91951 7.08524 3.86736 7.12143 3.82391 7.16683C3.78045 7.21224 3.74659 7.26593 3.72434 7.32471C3.70208 7.38348 3.69189 7.44614 3.69437 7.50894C3.69686 7.57174 3.71196 7.6334 3.73878 7.69023C3.76561 7.74707 3.80361 7.79792 3.85051 7.83976L5.75439 9.6642C5.80535 9.71292 5.86665 9.74951 5.93373 9.77122C6.00081 9.79292 6.07192 9.7992 6.14176 9.78957C6.21161 9.77994 6.27837 9.75465 6.33707 9.7156C6.39577 9.67655 6.44488 9.62473 6.48075 9.56403L9.228 4.9126Z"
                                                                        fill="#3A9F6C"></path>
                                                                </svg>
                                                            </i>
                                                        </small>
                                                    <?php endif; ?>
                                                </div> -->

                                                <?php if (!empty($customerDetails) && !empty($vendor)): ?>

                                                    <?php
                                                        // Handle vendor array safely
                                                        $vendorData = is_array($vendor) && isset($vendor[0]) ? $vendor[0] : $vendor;

                                                        // Vendor image fallback
                                                        $vendorImage = !empty($vendorData['vendor_image'])
                                                            ? base_url($vendorData['vendor_image'])
                                                            : base_url('assets/customer/images/default_vendor.png');

                                                        $vendorName     = $vendorData['vendor_name'] ?? '';
                                                        $vendorVerified = $vendorData['is_vendor_verify'] ?? 0;
                                                    ?>

                                                        <div
                                                        class="text-dark fw-600 d-flex gap-2 justify-content-between align-items-center">
                                                        <span><?= $row['vendor_name'] ?></span>
                                                        <?php if (!empty($row['is_vendor_verify']) && $row['is_vendor_verify'] == 1): ?>
                                                            <small class="d-flex align-items-center gap-1">
                                                                <span class="fw-600">Verified</span>
                                                                <i style="line-height: 0;">
                                                                    <svg width="13" height="14" viewBox="0 0 13 14" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M9.69883 1.04935C9.56974 0.843073 9.37955 0.682175 9.15473 0.589057C8.92992 0.495939 8.68167 0.475233 8.44454 0.529821L6.76156 0.916427C6.58908 0.956072 6.40986 0.956072 6.23739 0.916427L4.5544 0.529821C4.31727 0.475233 4.06902 0.495939 3.84421 0.589057C3.6194 0.682175 3.42921 0.843073 3.30012 1.04935L2.38281 2.5134C2.28921 2.66317 2.16284 2.78955 2.01308 2.88409L0.549128 3.80146C0.343218 3.93044 0.182567 4.12034 0.0894753 4.34478C-0.00361686 4.56922 -0.0245326 4.81708 0.0296313 5.05395L0.416212 6.73891C0.455711 6.9111 0.455711 7.09 0.416212 7.26219L0.0296313 8.94621C-0.0247431 9.18322 -0.00393263 9.43128 0.0891696 9.65592C0.182272 9.88055 0.34304 10.0706 0.549128 10.1996L2.01308 11.117C2.16284 11.2106 2.28921 11.337 2.38375 11.4868L3.30106 12.9508C3.56502 13.373 4.0686 13.5817 4.5544 13.4703L6.23739 13.0837C6.40986 13.0441 6.58908 13.0441 6.76156 13.0837L8.44548 13.4703C8.68247 13.5247 8.93052 13.5039 9.15514 13.4108C9.37976 13.3177 9.56979 13.1569 9.69883 12.9508L10.6161 11.4868C10.7097 11.337 10.8361 11.2106 10.9859 11.117L12.4508 10.1996C12.6569 10.0704 12.8175 9.88015 12.9105 9.65534C13.0034 9.43052 13.024 9.18233 12.9693 8.94528L12.5837 7.26219C12.544 7.0897 12.544 6.91046 12.5837 6.73798L12.9703 5.05395C13.0247 4.81704 13.004 4.56905 12.9111 4.34442C12.8182 4.1198 12.6576 3.9297 12.4517 3.80052L10.9868 2.88315C10.8372 2.78937 10.7108 2.66296 10.6171 2.5134L9.69883 1.04935ZM9.228 4.9126C9.2859 4.80613 9.30024 4.68136 9.26802 4.56453C9.23579 4.44771 9.15951 4.34793 9.05523 4.28621C8.95094 4.22448 8.82678 4.20561 8.70887 4.23358C8.59096 4.26154 8.48849 4.33415 8.42302 4.43613L5.9753 8.57927L4.4973 7.1639C4.45346 7.11887 4.40099 7.08314 4.34304 7.05883C4.28508 7.03452 4.22283 7.02214 4.15998 7.02241C4.09714 7.02269 4.03499 7.03562 3.97725 7.06043C3.91951 7.08524 3.86736 7.12143 3.82391 7.16683C3.78045 7.21224 3.74659 7.26593 3.72434 7.32471C3.70208 7.38348 3.69189 7.44614 3.69437 7.50894C3.69686 7.57174 3.71196 7.6334 3.73878 7.69023C3.76561 7.74707 3.80361 7.79792 3.85051 7.83976L5.75439 9.6642C5.80535 9.71292 5.86665 9.74951 5.93373 9.77122C6.00081 9.79292 6.07192 9.7992 6.14176 9.78957C6.21161 9.77994 6.27837 9.75465 6.33707 9.7156C6.39577 9.67655 6.44488 9.62473 6.48075 9.56403L9.228 4.9126Z"
                                                                            fill="#3A9F6C"></path>
                                                                    </svg>
                                                                </i>
                                                            </small>
                                                        <?php endif; ?>
                                                    </div> 

                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="slide4Swiper-button-next position-absolute top-50 translate-middle-y end-0" style="z-index: 1;">
                            <svg width="40" height="40" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_dd_126_1253)">
                                    <rect x="4" y="3" width="44" height="44" rx="10" fill="white" />
                                    <path
                                        d="M34.2148 25L34.6079 24.5822L35 25L34.6079 25.4178L34.2148 25ZM17.5553 25.5902C17.408 25.5902 17.2668 25.528 17.1626 25.4173C17.0585 25.3066 17 25.1565 17 25C17 24.8435 17.0585 24.6934 17.1626 24.5827C17.2668 24.472 17.408 24.4098 17.5553 24.4098V25.5902ZM27.9442 17.5L34.6079 24.5822L33.8216 25.4178L27.1578 18.3357L27.9442 17.5ZM34.6079 25.4178L27.9442 32.5L27.1578 31.6643L33.8216 24.5822L34.6079 25.4178ZM34.2148 25.5902H17.5553V24.4098H34.2148V25.5902Z"
                                        fill="#1C2730" />
                                </g>
                                <defs>
                                    <filter id="filter0_dd_126_1253" x="0" y="0" width="52" height="52" filterUnits="userSpaceOnUse"
                                        color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                        <feColorMatrix in="SourceAlpha" type="matrix"
                                            values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                        <feMorphology radius="1" operator="dilate" in="SourceAlpha"
                                            result="effect1_dropShadow_126_1253" />
                                        <feOffset dy="1" />
                                        <feGaussianBlur stdDeviation="1.5" />
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0" />
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_126_1253" />
                                        <feColorMatrix in="SourceAlpha" type="matrix"
                                            values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                        <feOffset dy="1" />
                                        <feGaussianBlur stdDeviation="1" />
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.3 0" />
                                        <feBlend mode="normal" in2="effect1_dropShadow_126_1253"
                                            result="effect2_dropShadow_126_1253" />
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect2_dropShadow_126_1253"
                                            result="shape" />
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                        <div class="slide4Swiper-button-prev position-absolute top-50 translate-middle-y start-0"
                            style="z-index: 1;">
                            <svg width="40" height="40" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_dd_126_1251)">
                                    <rect x="48" y="47" width="44" height="44" rx="10" transform="rotate(-180 48 47)"
                                        fill="white" />
                                    <path
                                        d="M17.7852 25L17.3921 25.4178L17 25L17.3921 24.5822L17.7852 25ZM34.4447 24.4098C34.592 24.4098 34.7332 24.472 34.8374 24.5827C34.9415 24.6934 35 24.8435 35 25C35 25.1565 34.9415 25.3066 34.8374 25.4173C34.7332 25.528 34.592 25.5902 34.4447 25.5902V24.4098ZM24.0558 32.5L17.3921 25.4178L18.1784 24.5822L24.8422 31.6643L24.0558 32.5ZM17.3921 24.5822L24.0558 17.5L24.8422 18.3357L18.1784 25.4178L17.3921 24.5822ZM17.7852 24.4098H34.4447V25.5902H17.7852V24.4098Z"
                                        fill="#1C2730" />
                                </g>
                                <defs>
                                    <filter id="filter0_dd_126_1251" x="0" y="0" width="52" height="52" filterUnits="userSpaceOnUse"
                                        color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                        <feColorMatrix in="SourceAlpha" type="matrix"
                                            values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                        <feMorphology radius="1" operator="dilate" in="SourceAlpha"
                                            result="effect1_dropShadow_126_1251" />
                                        <feOffset dy="1" />
                                        <feGaussianBlur stdDeviation="1.5" />
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0" />
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_126_1251" />
                                        <feColorMatrix in="SourceAlpha" type="matrix"
                                            values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                        <feOffset dy="1" />
                                        <feGaussianBlur stdDeviation="1" />
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.3 0" />
                                        <feBlend mode="normal" in2="effect1_dropShadow_126_1251"
                                            result="effect2_dropShadow_126_1251" />
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect2_dropShadow_126_1251"
                                            result="shape" />
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <script>
                        var swiper = new Swiper(".slide4", {
                            slidesPerView: 1,
                            loop: true,
                            navigation: {
                                nextEl: ".slide4Swiper-button-next",
                                prevEl: ".slide4Swiper-button-prev",
                            },
                            breakpoints: {
                                640: {
                                    slidesPerView: 1,
                                    spaceBetween: 10,
                                },
                                768: {
                                    slidesPerView: 3,
                                    spaceBetween: 20,
                                },
                                1024: {
                                    slidesPerView: 4,
                                    spaceBetween: 30,
                                },
                            },
                        });
                    </script>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!--=================Request A Quote Modal=================-->
<?php if (!empty($customerDetails)) { ?>
    <div class="modal fade" id="requestAQuote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Seller Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="d-flex flex-column gap-2">
                            <div><strong>Seller Name:</strong> <span id="sellerName"><?= $resp['vendor_name'] ?></span></div>
                            <!-- <div><strong>Email:</strong> <span id="sellerEmail"><?= $resp['vendor_email'] ?></span></div> -->
                            <div><strong>Phone:</strong> <span id="sellerPhone"><?= $resp['vendor_mobile'] ?></span></div>
                            <div>
                                <strong>Address:</strong>
                                <span id="sellerPhone">
                                    <?= $resp['vendor_country'] ?> ,
                                    <?= $resp['vendor_city'] ?> ,
                                    <?= $resp['vendor_states'] ?>
                                </span>
                            </div>
                            <div>
                                <strong>Website:</strong>
                                <a id="sellerPhone" href="<?= $resp['vendor_website'] ?>" target="_blank">
                                    <?= $resp['vendor_website'] ?>
                                </a>
                            </div>

                        </div>
                    </div>
                    <form action="#" method="post" class="" onsubmit="">
                        <div class="d-flex flex-column gap-3 mb-3">
                            <input type='hidden' name="productId" id="productId" value="<?= $resp['uid'] ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>

    <div class="modal fade" id="requestAQuote" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form class="modal-content review-form">
                <div class="modal-header">
                    <h5 class="modal-title">View Seller Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Actual review form -->
                    <div id="loginFirst">
                        Please login first to view seller .
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary w-100 justify-content-center"
                        onclick="openLoginModal1()">OK</button>
                </div>
            </form>
        </div>
    </div>


<?php } ?>
<!--=================Leave a Review Modal=================-->

<?php if (!empty($customerDetails)) { ?>

    <div class="modal fade" id="giveReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form class="modal-content review-form" onsubmit="submitReview(event)">
                <div class="modal-header">
                    <h5 class="modal-title">Leave a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type='hidden' name="productUid" id="productUid" value="<?= $resp['uid'] ?>">
                    <div class="d-flex flex-column gap-3">
                        <div class="position-relative">
                            <div class="star-rating">
                                <input type="radio" name="rating" id="star5" value="5"><label for="star5">★</label>
                                <input type="radio" name="rating" id="star4" value="4"><label for="star4">★</label>
                                <input type="radio" name="rating" id="star3" value="3"><label for="star3">★</label>
                                <input type="radio" name="rating" id="star2" value="2"><label for="star2">★</label>
                                <input type="radio" name="rating" id="star1" value="1"><label for="star1">★</label>
                            </div>
                            <div id="rating-error" class="text-danger small mt-1"></div>
                        </div>

                        <div class="position-relative">
                            <textarea class="form-control" name="details" rows="3" placeholder="Message"></textarea>
                            <div id="details-error" class="text-danger small mt-1"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100 justify-content-center">Submit</button>
                </div>
            </form>
        </div>
    </div>

<?php } else { ?>

    <div class="modal fade" id="giveReviewModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form class="modal-content review-form">
                <div class="modal-header">
                    <h5 class="modal-title">Give Your Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Actual review form -->
                    <div id="loginFirst">
                        Please login first to submit a review.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary w-100 justify-content-center"
                        onclick="openLoginModal()">OK</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>


<script>
    function openCustomerVendorDetails() {
        const productId = document.getElementById('productId')?.value;
        const message = document.getElementById('message')?.value || "";
        console.log("Sending productId:", productId);


        const vendorDetails = document.getElementById('requestAQuote');
        const showVendorDetails = bootstrap.Modal.getOrCreateInstance(vendorDetails);
        showVendorDetails.show();


        fetch(`${BASE_URL1}customer/api/request/created`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    productId,
                    message
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log("API Response:", data);

                if (data.status === "success") {

                    if (typeof aonsolve !== "undefined" && typeof aonsolve.log === "function") {
                        aonsolve.log("Quote request submitted successfully for product " + productId);
                    }
                    console.log("API success:", data.message);
                    // optional success alert
                    // MessSuccess.fire({
                    //     icon: 'success',
                    //     title: data.message || 'Quote request submitted successfully.',
                    // });

                } else {
                    console.error("API Error:", data.message);
                    // MessError.fire({
                    //     icon: 'error',
                    //     title: data.message || 'Failed to submit quote request.',
                    // });
                }
            })
            .catch(error => {
                console.error("API Error:", error);
                // MessError.fire({
                //     icon: 'error',
                //     title: 'Something went wrong. Please try again.',
                // });
            });
    }
</script>




<script>
    const BASE_URL1 = "<?= base_url(); ?>";

    function submitReview(event) {
        event.preventDefault();
        document.getElementById('rating-error').textContent = '';
        document.getElementById('details-error').textContent = '';
        const productUid = document.getElementById('productUid')?.value;
        const rating = document.querySelector('input[name="rating"]:checked');
        const detailsInput = document.querySelector('textarea[name="details"]');
        const details = detailsInput.value.trim();
        let hasError = false;
        if (!rating) {
            document.getElementById('rating-error').textContent = "Please select a rating.";
            hasError = true;
        }
        if (!details) {
            document.getElementById('details-error').textContent = "Please write a review message.";
            hasError = true;
        }
        if (hasError) return;

        const data = {
            productId: productUid,
            rating: rating.value,
            review: details
        };

        fetch(`${BASE_URL1}customer/api/rating/created`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        // Show error message from API response
                        MessError.fire({
                            icon: 'error',
                            title: data.message || 'Something went wrong',
                        });
                        throw new Error(data.message || 'Request failed');
                    });
                }
                return response.json();
            })
            .then(result => {
                // Success feedback
                MessSuccess.fire({
                    icon: 'success',
                    title: 'Review submitted successfully!',
                });
                window.location.reload();
            })
            .catch(error => {
                console.error(error);
                document.getElementById('details-error').textContent = "Failed to submit review. Please try again.";
            });
    }

    function openLoginModal() {
        // Hide the review modal
        const reviewModalEl = document.getElementById('giveReviewModal');
        const reviewModal = bootstrap.Modal.getInstance(reviewModalEl);
        reviewModal.hide();

        // Show the login modal
        const loginModalEl = document.getElementById('loginRegisterModal'); // make sure the ID matches
        const loginModal = new bootstrap.Modal(loginModalEl);
        loginModal.show();
    }

    function openLoginModal1() {
        // Hide the review modal
        const reviewModalEl = document.getElementById('requestAQuote');
        const reviewModal = bootstrap.Modal.getInstance(reviewModalEl);
        reviewModal.hide();

        // Show the login modal
        const loginModalEl = document.getElementById('loginRegisterModal'); // make sure the ID matches
        const loginModal = new bootstrap.Modal(loginModalEl);
        loginModal.show();
    }

    function submitQuote(event) {
        event.preventDefault();
        const productId = document.getElementById('productId').value;
        const message = document.querySelector('textarea[placeholder="Message"]').value;
        // console.log("Quote Request Data:", {
        //     productId,
        //     message
        // });
        const btn = document.getElementById('btnQuoteSubmit');
        // Disable button to prevent multiple submissions

        fetch(`${BASE_URL1}customer/api/request/created`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    productId,
                    message
                })
            })
            .then(response => response.json())
            .then(data => {
                btn.disabled = true;
                if (data.success) {
                    MessSuccess.fire({
                        icon: 'success',
                        title: 'Request submitted successfully!',
                    });
                    window.location.reload();
                } else {
                    MessError.fire({
                        icon: 'error',
                        title: data.message || 'Failed to submit quote request.',
                    });
                }
            })
            .catch(error => {
                console.error("API Error:", error);
                MessError.fire({
                    icon: 'error',
                    title: 'Something went wrong. Please try again.',
                });
            });
    }
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