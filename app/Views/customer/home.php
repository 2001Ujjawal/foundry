<section>
    <div class="homeHreo text-center">
        <div class="container">
            <div class="mx-auto col-md-8 p-0">
                <h1 class="mb-3 fadeUp">Find ANY Product for your <span>Foundry</span></h1>
                <!-- <h1 class="mb-3 fadeUp">India's Most Trusted <span>Foundry Equipment</span> Marketplace</h1> -->
                <!-- <div class="px-lg-5 mb-3 fadeUp">Explore 25,000+ industrial-grade products from 1,200+ verified manufacturers and brands in the foundry, metallurgy, and metalworking industry.</div> -->
                <div class="mb-3 col-lg-9 mx-auto p-0 fadeUp position-relative" style="z-index: 50;">
                    <div class="input-group">
                        <input
                            type="text"
                            id="searchInput"
                            class="form-control"
                            placeholder="Find ANY Product for your Foundry...">
                        <a href="#">
                            <button onclick="serachBtnforProductList()" class="btn btn-primary" id="searchBtn">
                                <svg width="20" height="20" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.5002 19.5001L15.1572 15.1571M15.1572 15.1571C15.9001 14.4142 16.4894 13.5323 16.8914 12.5617C17.2935 11.591 17.5004 10.5507 17.5004 9.50011C17.5004 8.44951 17.2935 7.4092 16.8914 6.43857C16.4894 5.46794 15.9001 4.586 15.1572 3.84311C14.4143 3.10023 13.5324 2.51094 12.5618 2.10889C11.5911 1.70684 10.5508 1.49991 9.50021 1.49991C8.4496 1.49991 7.40929 1.70684 6.43866 2.10889C5.46803 2.51094 4.58609 3.10023 3.84321 3.84311C2.34288 5.34344 1.5 7.37833 1.5 9.50011C1.5 11.6219 2.34288 13.6568 3.84321 15.1571C5.34354 16.6574 7.37842 17.5003 9.50021 17.5003C11.622 17.5003 13.6569 16.6574 15.1572 15.1571Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </a>
                    </div>
                    <div id="searchResults" class="position-absolute w-100 start-0 text-start overflow-auto" style="display: none; top:100%;z-index:5;height:300px;font-size:12px;">
                        <!-- <div class="d-flex flex-column overflow-hidden bg-white list-group">
                            <a href="" class="d-flex gap-2 list-group-item text-dark">
                                <div style="line-height: 0;">
                                    <img src="https://placehold.co/60x60" alt="" width="60" height="60" class="object-fit-cover rounded border m-0">
                                </div>
                                <div>
                                    <h5 class="mb-1 h6">Casting Simulation for Gating</h5>
                                    <div class="mb-1">
                                        Macro Design Solution ✅
                                    </div>
                                    <small class="d-flex gap-1">
                                        <span>Category: </span>
                                        <div class="d-flex flex-wrap gap-1">
                                            <span class="badge rounded-pill bg-light text-dark border">Category1</span>
                                            <span class="badge rounded-pill bg-light text-dark border">Category2</span>
                                            <span class="badge rounded-pill bg-light text-dark border">Category3</span>
                                        </div>
                                    </small>
                                </div>
                            </a>
                            <a href="" class="d-flex gap-2 list-group-item text-dark">
                                <div style="line-height: 0;">
                                    <img src="https://placehold.co/60x60" alt="" width="60" height="60" class="object-fit-cover rounded border m-0">
                                </div>
                                <div>
                                    <h5 class="mb-1 h6">Casting Simulation for Gating</h5>
                                    <div class="mb-1">
                                        Macro Design Solution ✅
                                    </div>
                                    <small class="d-flex gap-1">
                                        <span>Category: </span>
                                        <div class="d-flex flex-wrap gap-1">
                                            <span class="badge rounded-pill bg-light text-dark border">Category1</span>
                                            <span class="badge rounded-pill bg-light text-dark border">Category2</span>
                                            <span class="badge rounded-pill bg-light text-dark border">Category3</span>
                                        </div>
                                    </small>
                                </div>
                            </a>
                            <a href="" class="d-flex gap-2 list-group-item text-dark">
                                <div style="line-height: 0;">
                                    <img src="https://placehold.co/60x60" alt="" width="60" height="60" class="object-fit-cover rounded border m-0">
                                </div>
                                <div>
                                    <h5 class="mb-1 h6">Casting Simulation for Gating</h5>
                                    <div class="mb-1">
                                        Macro Design Solution ✅
                                    </div>
                                    <small class="d-flex gap-1">
                                        <span>Category: </span>
                                        <div class="d-flex flex-wrap gap-1">
                                            <span class="badge rounded-pill bg-light text-dark border">Category1</span>
                                            <span class="badge rounded-pill bg-light text-dark border">Category2</span>
                                            <span class="badge rounded-pill bg-light text-dark border">Category3</span>
                                        </div>
                                    </small>
                                </div>
                            </a>
                        </div> -->
                    </div>

                    <!-- <div id="searchResults" class="position-absolute w-100 start-0 text-start" style="display: none;top:100%;z-index:5;font-size:12px;">
                    </div> -->
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center gap-3 mb-3 fadeUp">
                <a href="<?= base_url('/product-list') ?>" class="btn btn-primary">Go to shop</a>
                <!-- <a href="<?= base_url('/category') ?>" class="btn btn-white">Browse Categories</a> -->
            </div>
            <!-- <div class="fadeUp">
                <img src="<?= base_url('assets/customer/images/xdfvbdfv.webp') ?>" alt="" width="300">
            </div> -->
        </div>
    </div>
    </div>
</section>
<!-- <section class="py-5" style="background-color: #F9F9F9;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3 fadeUp" style="transition-delay: 0;">
                <div class="d-flex gap-3">
                    <i style="line-height: 0;">
                        <svg width="25" height="29" viewBox="0 0 25 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25 4.39014L12.5 0L0 4.39014V14.5C0 19.6766 3.1675 23.2953 6.12 25.5418C7.9026 26.8845 9.85778 27.9794 11.9325 28.7968C12.0742 28.8503 12.2167 28.9013 12.36 28.9498L12.5 29L12.6425 28.9498C12.9158 28.8546 13.1867 28.7525 13.455 28.6438C15.3872 27.845 17.2102 26.8026 18.88 25.5418C21.8337 23.2953 25 19.6766 25 14.5V4.39014ZM11.2513 18.7835L5.95 13.4614L7.7175 11.6865L11.2525 15.235L18.3237 8.13932L20.0925 9.91293L11.2513 18.7835Z" fill="#4B4D56" />
                        </svg>
                    </i>
                    <div>
                        <h5 class="mb-1">100% Secure payments</h5>
                        <small class="d-block">Your privacy and security are our top priority. With 100% secure payments.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 fadeUp" style="transition-delay: 0.2s;">
                <div class="d-flex gap-3">
                    <i style="line-height: 0;">
                        <svg width="29" height="26" viewBox="0 0 29 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.666504 1.29989C0.666504 0.955138 0.800595 0.624506 1.03928 0.380729C1.27796 0.136952 1.60168 0 1.93923 0H15.9392C16.2768 0 16.6005 0.136952 16.8392 0.380729C17.0779 0.624506 17.212 0.955138 17.212 1.29989V7.79935H22.3029C23.1386 7.79935 23.9661 7.96746 24.7381 8.29409C25.5102 8.62072 26.2117 9.09946 26.8026 9.70299C27.3936 10.3065 27.8623 11.023 28.1821 11.8116C28.5019 12.6001 28.6665 13.4453 28.6665 14.2988V19.4984C28.6668 20.3352 28.4036 21.15 27.9156 21.8223C27.4277 22.4946 26.7409 22.9887 25.9569 23.2317C25.7234 24.0181 25.2527 24.7091 24.6119 25.2061C23.9711 25.703 23.193 25.9806 22.3886 25.999C21.5842 26.0175 20.7947 25.7759 20.1327 25.3088C19.4707 24.8417 18.9701 24.173 18.7023 23.398H10.632C10.3642 24.173 9.8636 24.8417 9.20161 25.3088C8.53962 25.7759 7.75007 26.0175 6.94567 25.999C6.14127 25.9806 5.36313 25.703 4.72234 25.2061C4.08154 24.7091 3.61084 24.0181 3.37741 23.2317C2.5931 22.9889 1.90607 22.4949 1.41788 21.8226C0.929693 21.1503 0.666253 20.3354 0.666504 19.4984V14.2988H8.30287C8.64042 14.2988 8.96414 14.1618 9.20282 13.9181C9.4415 13.6743 9.57559 13.3437 9.57559 12.9989C9.57559 12.6542 9.4415 12.3235 9.20282 12.0797C8.96414 11.836 8.64042 11.699 8.30287 11.699H0.666504V9.09924H5.75741C6.09496 9.09924 6.41868 8.96228 6.65737 8.71851C6.89605 8.47473 7.03014 8.1441 7.03014 7.79935C7.03014 7.45459 6.89605 7.12396 6.65737 6.88018C6.41868 6.63641 6.09496 6.49945 5.75741 6.49945H0.666504V1.29989ZM17.212 20.7983H18.7023C18.9539 20.0709 19.4111 19.4361 20.016 18.9742C20.6209 18.5122 21.3464 18.2439 22.1006 18.2031C22.8549 18.1623 23.604 18.351 24.2533 18.7451C24.9025 19.1393 25.4228 19.7212 25.7481 20.4174C25.9868 20.1737 26.121 19.8431 26.121 19.4984V14.2988C26.121 13.2645 25.7188 12.2726 25.0027 11.5413C24.2867 10.81 23.3155 10.3991 22.3029 10.3991H17.212V20.7983ZM8.30287 22.0981C8.30287 21.7534 8.16878 21.4228 7.93009 21.179C7.69141 20.9352 7.36769 20.7983 7.03014 20.7983C6.69259 20.7983 6.36887 20.9352 6.13019 21.179C5.8915 21.4228 5.75741 21.7534 5.75741 22.0981C5.75741 22.4429 5.8915 22.7735 6.13019 23.0173C6.36887 23.2611 6.69259 23.398 7.03014 23.398C7.36769 23.398 7.69141 23.2611 7.93009 23.0173C8.16878 22.7735 8.30287 22.4429 8.30287 22.0981ZM21.403 21.1791C21.1643 21.4228 21.0302 21.7534 21.0301 22.0981C21.0301 22.3989 21.1321 22.6903 21.3189 22.9229C21.5056 23.1554 21.7655 23.3146 22.0543 23.3733C22.3431 23.432 22.6429 23.3867 22.9026 23.2449C23.1623 23.1032 23.3659 22.8739 23.4786 22.5961C23.5914 22.3183 23.6063 22.0091 23.5209 21.7213C23.4354 21.4335 23.2549 21.1848 23.0101 21.0177C22.7653 20.8506 22.4714 20.7753 22.1783 20.8048C21.8853 20.8342 21.6113 20.9665 21.403 21.1791Z" fill="#4B4D56" />
                        </svg>
                    </i>
                    <div>
                        <h5 class="mb-1">Fast Delivery, Every Time</h5>
                        <small class="d-block">We know time matters. That’s why we offer fast delivery on all orders.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 fadeUp" style="transition-delay: 0.4s;">
                <div class="d-flex gap-3">
                    <i style="line-height: 0;">
                        <svg width="29" height="24" viewBox="0 0 29 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M22.7475 0H5.9195L0.333496 5.586V24H28.3335V5.586L22.7475 0ZM3.7475 5L6.7475 2H21.9195L24.9195 5H3.7475ZM11.7475 12L13.0415 10.708L11.6275 9.292L6.9195 14H18.3335C18.5987 14 18.8531 14.1054 19.0406 14.2929C19.2281 14.4804 19.3335 14.7348 19.3335 15C19.3335 15.2652 19.2281 15.5196 19.0406 15.7071C18.8531 15.8946 18.5987 16 18.3335 16H10.3335V18H18.3335C19.1291 18 19.8922 17.6839 20.4548 17.1213C21.0174 16.5587 21.3335 15.7956 21.3335 15C21.3335 14.2044 21.0174 13.4413 20.4548 12.8787C19.8922 12.3161 19.1291 12 18.3335 12H11.7475Z" fill="#4B4D56" />
                        </svg>
                    </i>

                    <div>
                        <h5 class="mb-1">Easy Returns</h5>
                        <small class="d-block">Changed your mind? No problem! With our Easy Returns policy, you can return your purchase for a hassle-free refund or exchange.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 fadeUp" style="transition-delay: 0.6s;">
                <div class="d-flex gap-3">
                    <i style="line-height: 0;">
                        <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.65454 10.4974C8.65454 9.68049 8.81544 8.87161 9.12805 8.11691C9.44066 7.36221 9.89885 6.67647 10.4765 6.09885C11.0541 5.52123 11.7398 5.06303 12.4945 4.75043C13.2492 4.43782 14.0581 4.27692 14.875 4.27692C15.6919 4.27692 16.5008 4.43782 17.2555 4.75043C18.0102 5.06303 18.6959 5.52123 19.2735 6.09885C19.8511 6.67647 20.3093 7.36221 20.622 8.11691C20.9346 8.87161 21.0955 9.68049 21.0955 10.4974V23.4792C21.0955 24.4745 20.6086 25.3529 19.8579 25.8938C19.3126 25.2447 18.4948 24.8315 17.5795 24.8315H12.1705C11.3814 24.8315 10.6247 25.1449 10.0668 25.7028C9.50889 26.2607 9.19545 27.0174 9.19545 27.8065C9.19545 28.5955 9.50889 29.3522 10.0668 29.9101C10.6247 30.468 11.3814 30.7815 12.1705 30.7815H17.5795C18.921 30.7815 20.0569 29.8922 20.4269 28.6698C21.4301 28.2224 22.2825 27.4943 22.881 26.5733C23.4795 25.6522 23.7987 24.5776 23.8 23.4792V21.3156H26.2341C28.177 21.3156 29.75 19.7404 29.75 17.7996V13.4724C29.75 11.5316 28.177 9.95647 26.2341 9.95647H24.8667C24.7259 7.40164 23.6119 4.99777 21.7536 3.23895C19.8952 1.48014 17.4337 0.5 14.875 0.5C12.3163 0.5 9.8548 1.48014 7.99644 3.23895C6.13808 4.99777 5.02405 7.40164 4.88333 9.95647H3.51591C1.57513 9.95647 0 11.5316 0 13.4724V17.7996C0 19.7404 1.57513 21.3156 3.51591 21.3156H7.30227C8.04873 21.3156 8.65454 20.7097 8.65454 19.9633V10.4974ZM2.70455 13.4724C2.70455 13.0245 3.06804 12.661 3.51591 12.661H5.95V18.611H3.51591C3.30072 18.611 3.09435 18.5255 2.94219 18.3734C2.79003 18.2212 2.70455 18.0148 2.70455 17.7996V13.4724ZM23.8 18.611V12.661H26.2341C26.682 12.661 27.0455 13.0245 27.0455 13.4724V17.7996C27.0455 18.0148 26.96 18.2212 26.8078 18.3734C26.6556 18.5255 26.4493 18.611 26.2341 18.611H23.8Z" fill="#4B4D56" />
                        </svg>
                    </i>
                    <div>
                        <h5 class="mb-1">24/7 Support</h5>
                        <small class="d-block">Need help with your order? Our dedicated team is available 24/7.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section class="py-5">
    <div class="container">
        <div class="row g-lg-4 g-2 justify-content-center">
            <div class="col-md-6 col-lg-3 fadeUp" style="transition-delay: 0;">
                <div class="text-white d-flex align-items-center justify-content-between gap-3 p-3 rounded-10 h-100" style="background-color: #1F58BD;">
                    <div>
                        <h4 class="mb-1 text-white"><?= $statics['total_vendors'] ?>+</h4>
                        <small class="d-block">Number of Sellers</small>
                    </div>
                    <i style="line-height: 0;">
                        <svg width="37" height="26" viewBox="0 0 37 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.55 11.1429C7.59078 11.1429 9.25 9.47723 9.25 7.42857C9.25 5.37991 7.59078 3.71429 5.55 3.71429C3.50922 3.71429 1.85 5.37991 1.85 7.42857C1.85 9.47723 3.50922 11.1429 5.55 11.1429ZM31.45 11.1429C33.4908 11.1429 35.15 9.47723 35.15 7.42857C35.15 5.37991 33.4908 3.71429 31.45 3.71429C29.4092 3.71429 27.75 5.37991 27.75 7.42857C27.75 9.47723 29.4092 11.1429 31.45 11.1429ZM33.3 13H29.6C28.5825 13 27.6633 13.4121 26.9927 14.0795C29.3225 15.3621 30.9759 17.6777 31.3344 20.4286H35.15C36.1733 20.4286 37 19.5987 37 18.5714V16.7143C37 14.6656 35.3408 13 33.3 13ZM18.5 13C22.0786 13 24.975 10.0924 24.975 6.5C24.975 2.90759 22.0786 0 18.5 0C14.9214 0 12.025 2.90759 12.025 6.5C12.025 10.0924 14.9214 13 18.5 13ZM22.94 14.8571H22.4602C21.2577 15.4375 19.9222 15.7857 18.5 15.7857C17.0778 15.7857 15.7481 15.4375 14.5398 14.8571H14.06C10.3831 14.8571 7.4 17.8518 7.4 21.5429V23.2143C7.4 24.7522 8.64297 26 10.175 26H26.825C28.357 26 29.6 24.7522 29.6 23.2143V21.5429C29.6 17.8518 26.6169 14.8571 22.94 14.8571ZM10.0073 14.0795C9.33672 13.4121 8.4175 13 7.4 13H3.7C1.65922 13 0 14.6656 0 16.7143V18.5714C0 19.5987 0.826719 20.4286 1.85 20.4286H5.65984C6.02406 17.6777 7.6775 15.3621 10.0073 14.0795Z" fill="white" />
                        </svg>
                    </i>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 fadeUp" style="transition-delay: 0.2s;">
                <div class="text-white d-flex align-items-center justify-content-between gap-3 p-3 rounded-10 h-100" style="background-color: #3A9F6C;">
                    <div>
                        <h4 class="mb-1 text-white"><?= $statics['total_products'] ?>+</h4>
                        <small class="d-block">Number of Products</small>
                    </div>
                    <i style="line-height: 0;">
                        <svg fill="currentColor" enable-background="new 0 0 512 512" height="36" viewBox="0 0 512 512" width="36" xmlns="http://www.w3.org/2000/svg">
                            <path d="m434.929 46.131c-10.38-10.402-24.184-16.131-38.871-16.131h-24.808v-5c0-13.785-11.215-25-25-25h-180c-13.785 0-25 11.215-25 25v5h-24.897c-30.261 0-54.908 24.646-54.942 54.939l-.411 372c-.016 14.702 5.691 28.528 16.07 38.93 10.38 10.402 24.185 16.131 38.872 16.131h279.704c30.262 0 54.909-24.646 54.942-54.939l.412-372c.017-14.703-5.691-28.529-16.071-38.93zm-263.679-16.131h170v30h-170zm249.37 427.027c-.016 13.771-11.219 24.973-24.974 24.973h-279.704c-6.676 0-12.951-2.604-17.669-7.332-4.718-4.729-7.312-11.013-7.305-17.695l.411-372c.015-13.771 11.218-24.973 24.974-24.973h24.897v5c0 13.785 11.215 25 25 25h180c13.785 0 25-11.215 25-25v-5h24.808c6.676 0 12.951 2.604 17.669 7.332s7.313 11.013 7.305 17.695z" />
                            <path d="m261.099 200h106.571c8.284 0 15-6.716 15-15s-6.716-15-15-15h-106.571c-8.284 0-15 6.716-15 15s6.716 15 15 15z" />
                            <path d="m261.099 300h106.571c8.284 0 15-6.716 15-15s-6.716-15-15-15h-106.571c-8.284 0-15 6.716-15 15s6.716 15 15 15z" />
                            <path d="m368.099 370h-107c-8.284 0-15 6.716-15 15s6.716 15 15 15h107c8.284 0 15-6.716 15-15s-6.715-15-15-15z" />
                            <path d="m197.256 144.157-34.592 34.592-8.156-8.157c-5.858-5.858-15.355-5.858-21.213 0-5.858 5.857-5.858 15.355 0 21.213l18.763 18.764c2.813 2.813 6.628 4.394 10.607 4.394 3.978 0 7.793-1.58 10.606-4.394l45.199-45.198c5.858-5.857 5.858-15.355 0-21.213-5.858-5.859-15.355-5.859-21.214-.001z" />
                            <path d="m197.256 251.794-34.592 34.592-8.156-8.156c-5.858-5.858-15.355-5.858-21.213 0-5.858 5.857-5.858 15.354 0 21.213l18.763 18.764c2.813 2.813 6.628 4.394 10.607 4.394 3.978 0 7.794-1.58 10.606-4.394l45.199-45.199c5.858-5.857 5.858-15.355 0-21.213s-15.356-5.858-21.214-.001z" />
                            <path d="m197.256 351.794-34.592 34.592-8.156-8.156c-5.858-5.858-15.355-5.858-21.213 0-5.858 5.857-5.858 15.354 0 21.213l18.763 18.764c2.813 2.813 6.628 4.394 10.607 4.394 3.978 0 7.794-1.58 10.606-4.394l45.199-45.199c5.858-5.857 5.858-15.355 0-21.213s-15.356-5.858-21.214-.001z" />
                        </svg>
                    </i>
                </div>
            </div>
            <!-- <div class="col-md-6 col-lg-3 fadeUp" style="transition-delay: 0.4s;">
                <div class="text-white d-flex align-items-center justify-content-between gap-3 p-3 rounded-10 h-100" style="background-color: #CB9C44;">
                    <div>
                        <h4 class="mb-1 text-white"><?= $statics['total_customers'] ?>+</h4>
                        <small class="d-block">Number of Customers</small>
                    </div>
                    <i style="line-height: 0;">
                        <svg width="37" height="38" viewBox="0 0 37 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25.2266 5.54435V3.86292H21.8637V7.22579H5.04599V3.86292H1.68312V5.54435H0V35.8186H1.68144V37.5H23.5451V35.8186H21.8637V34.1372H23.5451V32.4557H21.8637V29.0912H23.5451V27.4097H21.8637V25.7283H23.5451V24.0469H25.2266V22.3638H26.908V5.54603L25.2266 5.54435ZM18.5008 29.0912H11.7734V25.7283H18.4992L18.5008 29.0912ZM18.5008 34.1355H3.36287V32.4541H18.5008V34.1355ZM3.36287 12.2751H5.04431V13.9566H6.72574V12.2751H8.40886V10.5937H10.0903V12.2751H8.40886V13.9566H6.72574L6.72743 15.638H5.04599L5.04431 13.9566H3.36455L3.36287 12.2751ZM3.36287 19.0009H5.04431V20.6823H6.72574V19.0009H8.40886V17.3194H10.0903V19.0009H8.40886V20.6823H6.72574L6.72743 22.3654H5.04599V20.684H3.36455L3.36287 19.0009ZM5.04431 25.7283V27.4097H6.72574V25.7283H8.40886V24.0469H10.0903V25.7283H8.40886V27.4097H6.72574L6.72743 29.0912H5.04599L5.04431 27.4097H3.36455V25.7283H5.04431ZM23.5451 20.684H21.8637V22.3654H11.7734V19.0026H23.5451V20.684ZM23.5451 15.6397H11.7734V12.2718H23.5451V15.6397Z" fill="white" />
                            <path d="M36.9998 27.408V25.7266H35.3184V24.0451H33.637V25.7266H31.9555V24.0451H28.591V25.7266H26.9095V24.0451H25.2281V25.7266H23.5467V27.408H25.2281V29.0895H23.5467V32.454H25.2281V34.1354H23.5467V35.8169H25.2281V37.4983H26.9095V35.8169H28.591V37.4983H31.9539V35.8169H33.6353V37.4983H35.3167V35.8169H36.9998V34.1354H35.3184V32.454H36.9998V29.0911H35.3184V27.4097L36.9998 27.408ZM31.9555 32.454H28.591V29.0911H31.9539L31.9555 32.454ZM20.1821 2.18144V5.54431H6.72559V2.18144H8.40702V0.5H18.4973V2.18144H20.1821Z" fill="white" />
                        </svg>
                    </i>
                </div>
            </div> -->
            <div class="col-md-6 col-lg-3 fadeUp" style="transition-delay: 0.4s;">
                <div class="text-white d-flex align-items-center justify-content-between gap-3 p-3 rounded-10 h-100" style="background-color: #9049C2;">
                    <div>
                        <h4 class="mb-1 text-white"><?= $statics['total_country'] ?>+</h4>
                        <small class="d-block">Number of Countries</small>
                    </div>
                    <i style="line-height: 0;">
                        <svg width="28" height="48" viewBox="0 0 28 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 28.7C10.287 28.7 6.72601 27.2145 4.10051 24.5702C1.475 21.9259 0 18.3396 0 14.6C0 10.8604 1.475 7.27406 4.10051 4.62979C6.72601 1.98553 10.287 0.5 14 0.5C17.713 0.5 21.274 1.98553 23.8995 4.62979C26.525 7.27406 28 10.8604 28 14.6C28 18.3396 26.525 21.9259 23.8995 24.5702C21.274 27.2145 17.713 28.7 14 28.7ZM14 21.65C15.8565 21.65 17.637 20.9072 18.9497 19.5851C20.2625 18.263 21 16.4698 21 14.6C21 12.7302 20.2625 10.937 18.9497 9.6149C17.637 8.29277 15.8565 7.55 14 7.55C12.1435 7.55 10.363 8.29277 9.05025 9.6149C7.7375 10.937 7 12.7302 7 14.6C7 16.4698 7.7375 18.263 9.05025 19.5851C10.363 20.9072 12.1435 21.65 14 21.65ZM23.3333 28.1125V47.5L14 38.1L4.66667 47.5V28.1125C7.40163 30.0428 10.6603 31.0783 14 31.0783C17.3397 31.0783 20.5984 30.0428 23.3333 28.1125Z" fill="white" />
                        </svg>
                    </i>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="p-0 col-md-6 mx-auto mb-4 titsec text-center fadeUp">

            <h2 class="mb-2">Featured <span> Products</span></h2>
            <!-- <div>Browse through our wide range of curated categories, from smartphones and laptops to smart home gadgets and audio gear.</div> -->
        </div>
        <div class="row g-lg-4 g-3">
            <?php if (!empty($product)) {
                foreach ($product as $row) {
            ?>
                    <div class="col5 fadeUp">
                        <?php
                        if ($row['slug'] ===  null) {
                            $slug = $row['uid'];
                        } else {
                            $slug = $row['slug'];
                        }

                        ?>
                        <div class="h-100 rounded-10 border bg-white overflow-hidden">
                            <a href="<?= base_url('product/' . $slug) ?>" class=" d-block">
                                <?php if (!empty($row['is_vendor_verify']) && $row['is_vendor_verify'] == 1): ?>
                                    <small class="verified-top-right d-flex align-items-center gap-1">
                                        <span class="fw-600">Verified</span>
                                        <i style="line-height: 0;">
                                            <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.69883 1.04935C9.56974 0.843073 9.37955 0.682175 9.15473 0.589057C8.92992 0.495939 8.68167 0.475233 8.44454 0.529821L6.76156 0.916427C6.58908 0.956072 6.40986 0.956072 6.23739 0.916427L4.5544 0.529821C4.31727 0.475233 4.06902 0.495939 3.84421 0.589057C3.6194 0.682175 3.42921 0.843073 3.30012 1.04935L2.38281 2.5134C2.28921 2.66317 2.16284 2.78955 2.01308 2.88409L0.549128 3.80146C0.343218 3.93044 0.182567 4.12034 0.0894753 4.34478C-0.00361686 4.56922 -0.0245326 4.81708 0.0296313 5.05395L0.416212 6.73891C0.455711 6.9111 0.455711 7.09 0.416212 7.26219L0.0296313 8.94621C-0.0247431 9.18322 -0.00393263 9.43128 0.0891696 9.65592C0.182272 9.88055 0.34304 10.0706 0.549128 10.1996L2.01308 11.117C2.16284 11.2106 2.28921 11.337 2.38375 11.4868L3.30106 12.9508C3.56502 13.373 4.0686 13.5817 4.5544 13.4703L6.23739 13.0837C6.40986 13.0441 6.58908 13.0441 6.76156 13.0837L8.44548 13.4703C8.68247 13.5247 8.93052 13.5039 9.15514 13.4108C9.37976 13.3177 9.56979 13.1569 9.69883 12.9508L10.6161 11.4868C10.7097 11.337 10.8361 11.2106 10.9859 11.117L12.4508 10.1996C12.6569 10.0704 12.8175 9.88015 12.9105 9.65534C13.0034 9.43052 13.024 9.18233 12.9693 8.94528L12.5837 7.26219C12.544 7.0897 12.544 6.91046 12.5837 6.73798L12.9703 5.05395C13.0247 4.81704 13.004 4.56905 12.9111 4.34442C12.8182 4.1198 12.6576 3.9297 12.4517 3.80052L10.9868 2.88315C10.8372 2.78937 10.7108 2.66296 10.6171 2.5134L9.69883 1.04935ZM9.228 4.9126C9.2859 4.80613 9.30024 4.68136 9.26802 4.56453C9.23579 4.44771 9.15951 4.34793 9.05523 4.28621C8.95094 4.22448 8.82678 4.20561 8.70887 4.23358C8.59096 4.26154 8.48849 4.33415 8.42302 4.43613L5.9753 8.57927L4.4973 7.1639C4.45346 7.11887 4.40099 7.08314 4.34304 7.05883C4.28508 7.03452 4.22283 7.02214 4.15998 7.02241C4.09714 7.02269 4.03499 7.03562 3.97725 7.06043C3.91951 7.08524 3.86736 7.12143 3.82391 7.16683C3.78045 7.21224 3.74659 7.26593 3.72434 7.32471C3.70208 7.38348 3.69189 7.44614 3.69437 7.50894C3.69686 7.57174 3.71196 7.6334 3.73878 7.69023C3.76561 7.74707 3.80361 7.79792 3.85051 7.83976L5.75439 9.6642C5.80535 9.71292 5.86665 9.74951 5.93373 9.77122C6.00081 9.79292 6.07192 9.7992 6.14176 9.78957C6.21161 9.77994 6.27837 9.75465 6.33707 9.7156C6.39577 9.67655 6.44488 9.62473 6.48075 9.56403L9.228 4.9126Z" fill="#3A9F6C"></path>
                                            </svg>
                                        </i>
                                    </small>
                                <?php endif; ?>
                                <?php
                                $image = "";
                                $proudctImage = $row['image'];
                                if (empty($proudctImage)) {
                                    $image  = (string)$row['main_image'];
                                } else {
                                    $image = $proudctImage;
                                }
                                ?>
                                <img src="<?= base_url($image) ?>" alt="<?= $slug ?>" class="w-100 object-fit-cover" style="height:250px;">
                                <div class="p-lg-3 p-2">
                                    <h5 class="mb-1" style="height:50px;">
                                        <?= substr(strip_tags($row['name']), 0, 40) ?><?= strlen(strip_tags($row['name'])) > 40 ? '...' : '' ?>
                                    </h5>



                                    <!--  verify components -->
                                    <?= view('components/verify_badge', ['is_verify' => $row['is_verify']]) ?>

                                    <!-- <small class="d-flex align-items-center gap-1">
                                    <span class="fw-600">Supplier Name: <?= $row['vendor_name']; ?></span>
                                </small> -->

                                    <div class="d-flex align-items-center justify-content-between">
                                        <?php
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
                                        <small style="color: #666;"><?= $row['total_rating_percent'] ?> (<?= $row['total_customer_review'] ?> reviews)</small>
                                    </div>
                                    <!-- <div class="my-1" style="color: #666;">
                                    <?= substr(strip_tags($row['description']), 0, 95) ?><?= strlen(strip_tags($row['description'])) > 95 ? '...' : '' ?>
                                </div> -->

                                    <div>


                                    </div>
                                </div>
                            </a>
                            <!-- <button class="image-btn w-100">
                               Login To View Seller Details
                            </button> -->
                            <div class="">
                                <?php if ($customerLoggedIn): ?>
                                    <div class="fw-600 text-dark text-center">
                                        <?= esc($row['vendor_company']) ?>
                                    </div>
                                <?php else: ?>
                                    <button type="button"
                                            class="image-btn w-100"
                                            data-bs-toggle="modal"
                                            data-bs-target="#loginRegisterModal">
                                        Login To View Seller Details
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="rounded-15 py-5 px-4 px-lg-5 bannerCta position-relative overflow-hidden text-center text-white">
            <video autoplay muted loop playsinline poster="<?= base_url('assets/customer/images/bannerCTAbg.webp') ?>" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="z-index: -2;">
                <source src="<?= base_url('assets/customer/videos/ctaVideoBg.mp4') ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="py-lg-5 px-0 mx-auto col-md-8 col-lg-6 fadeUp">
                <h6 class="text-white mb-2">Top Quality Tech</h6>
                <h2 class="text-white mb-3">Upgrade Your Foundry with Precision Equipment</h2>
                <div class="mb-3">Explore cutting-edge foundry systems for melting, molding, machining, and quality assurance—all in one marketplace.</div>
                <a href="<?= base_url('product-list') ?>" class="btn btn-white px-4">Shop Now</a>
            </div>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="p-0 col-md-6 mx-auto mb-4 titsec text-center fadeUp">
            <!-- <h2 class="mb-2">Customer <span>Reviews</span></h2>  Reviews -->
            <h2 class="mb-2">Top <span>Reviews</span></h2>
            <div>See what our customers are saying about their purchases</div>
        </div>
        <div class="fadeUp">
            <div class="swiper testimonialsSlider">
                <div class="swiper-wrapper">
                    <?php if (!empty($review)) {
                        foreach ($review as $row) {
                    ?>
                            <div class="swiper-slide">
                                <div class="h-100 rounded-10 border bg-light p-3 p-lg-4">
                                    <div class="d-flex align-itens-center gap-3 mb-3">
                                        <div>
                                            <img
                                                src="<?= !empty($row['customer_image']) ? base_url($row['customer_image']) : 'https://app.pagarai.com/public/images/user.svg' ?>"
                                                alt="Customer"
                                                width="50" height="50"
                                                class="rounded-circle"
                                                onerror="this.onerror=null;this.src='https://app.pagarai.com/public/images/user.svg';">
                                        </div>

                                        <div class="d-flex flex-column gap-1">
                                            <h5 class="text-dark fw-600"><?= $row['customer_name'] ?></h5>
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
                                    <i class="d-block mb-3 textiText">
                                        <?= $row['review'] ?>
                                    </i>
                                    <!-- <small class="d-flex align-items-center gap-1">
                                <i style="line-height: 0;">
                                    <svg version="1.1" width="14" height="14" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <path d="M347.216,301.211l-71.387-53.54V138.609c0-10.966-8.864-19.83-19.83-19.83c-10.966,0-19.83,8.864-19.83,19.83v118.978
                                                c0,6.246,2.935,12.136,7.932,15.864l79.318,59.489c3.569,2.677,7.734,3.966,11.878,3.966c6.048,0,11.997-2.717,15.884-7.952
                                                C357.766,320.208,355.981,307.775,347.216,301.211z"/>
                                            <path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.833,256-256S397.167,0,256,0z M256,472.341
                                                c-119.275,0-216.341-97.066-216.341-216.341S136.725,39.659,256,39.659c119.295,0,216.341,97.066,216.341,216.341
                                                S375.275,472.341,256,472.341z"/>
                                    </svg>
                                </i>
                                <span>Purchased 2 months ago</span>
                            </small> -->
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
            <script>
                var swiper = new Swiper(".testimonialsSlider", {
                    slidesPerView: 1,
                    loop: true,
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                            spaceBetween: 10,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                    },
                });
            </script>
        </div>

    </div>
</section>
<!-- <script>
    const baseUrl = " <?= base_url(); ?>"
    console.log(baseUrl);
    const BASE_URL = baseUrl + "customer/api/product-search?search=";
    console.log(BASE_URL);
    const searchInput = document.getElementById("searchInput");
    const searchResults = document.getElementById("searchResults");
    let categoryID = '';

    function fetchSearchResults(query) {

        if (!query.trim()) {
            searchResults.style.display = "none";
            searchResults.innerHTML = "";
            return;
        }
        var verifyLogo = '';


        fetch(BASE_URL + encodeURIComponent(query))
            .then(res => res.json())
            .then(data => {
                if (data.success && data.data.products.length > 0) {
                    let html = `
                <div class="d-flex flex-column overflow-hidden bg-white list-group">
            `;
                    data.data.products.forEach(product => {


                        categoryID = data.data.products[0].category_id;


                        if (product.vendor_is_verify === "1") {
                            verifyLogo = '✅';
                        }

                        html += `
               <a onclick="redirectProductListPage('` + product.uid + `')"  href="#" 
   class="d-flex gap-2 list-group-item text-dark">

    
    <div >
        <span>${product.category_name}</span>
    </div>

</a>
                `;
                    });

                    html += `</div>`;
                    searchResults.innerHTML = html;
                    searchResults.style.display = "block";

                } else {
                    searchResults.innerHTML = "<p style='text-align:center;'>Keep typing to search</p>";
                    searchResults.style.display = "block";
                }

                // close when clicking outside
                document.addEventListener("click", function handleClickOutside(event) {
                    if (!searchResults.contains(event.target) && event.target.id !== "searchInput") {
                        searchResults.style.display = "none";
                        searchResults.innerHTML = "";
                        document.removeEventListener("click", handleClickOutside);
                    }
                });
            })
            .catch(err => {
                console.error("Search API Error:", err);
                searchResults.innerHTML = "<p>Error fetching results</p>";
                searchResults.style.display = "block";
            });


    }

    // Run search on typing (debounced)
    let debounceTimer;
    searchInput.addEventListener("input", () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchSearchResults(searchInput.value);
        }, 500);
    });




    function redirectProductListPage(productUid) {
        window.location.href = baseUrl + `/product/${productUid}`;
    }



    function serachBtnforProductList() {
        if (!categoryID) {
            console.log();
            ("No category ID found");
            return;
        }

        const filterData = {
            categories: [categoryID],
            price: {
                from: 100,
                to: 50000
            }
        };

        const jsonStr = JSON.stringify(filterData);
        const base64 = btoa(jsonStr);
        const url = "<?= base_url('product-list?filter=') ?>" + encodeURIComponent(base64);

        // now redirect
        window.location.href = url;
    }
</script> -->


<script>
    const baseUrl = "<?= base_url(); ?>";
    const BASE_URL = baseUrl + "customer/api/product-search?search=";

    const searchInput = document.getElementById("searchInput");
    const searchResults = document.getElementById("searchResults");

    function fetchSearchResults(query) {

        if (!query.trim()) {
            searchResults.style.display = "none";
            searchResults.innerHTML = "";
            return;
        }

        fetch(BASE_URL + encodeURIComponent(query))
            .then(res => res.json())
            .then(data => {

                if (
                    !data.success ||
                    !data.data ||
                    !data.data.products ||
                    data.data.products.length === 0
                ) {
                    searchResults.innerHTML =
                        "<p class='text-center p-2'>No category found</p>";
                    searchResults.style.display = "block";
                    return;
                }

                // 🔑 Extract unique categories from products
                const categories = {};

                data.data.products.forEach(product => {
                    if (product.category_id && product.category_name) {
                        categories[product.category_id] = product.category_name;
                    }
                });

                let html = `<div class="list-group bg-white">`;

                Object.keys(categories).forEach(categoryId => {
                    html += `
                        <a href="javascript:void(0)"
                           class="list-group-item list-group-item-action"
                           onclick="redirectToCategory('${categoryId}')">
                            ${categories[categoryId]}
                        </a>
                    `;
                });

                html += `</div>`;

                searchResults.innerHTML = html;
                searchResults.style.display = "block";

                document.addEventListener("click", function handleClickOutside(e) {
                    if (!searchResults.contains(e.target) && e.target !== searchInput) {
                        searchResults.style.display = "none";
                        searchResults.innerHTML = "";
                        document.removeEventListener("click", handleClickOutside);
                    }
                });

            })
            .catch(err => {
                console.error("Search API Error:", err);
                searchResults.innerHTML =
                    "<p class='text-center p-2'>Error fetching categories</p>";
                searchResults.style.display = "block";
            });
    }

    // debounce
    let debounceTimer;
    searchInput.addEventListener("input", () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchSearchResults(searchInput.value);
        }, 400);
    });

    function redirectToCategory(categoryUid) {

        const filterData = {
            categories: [categoryUid],
            price: {
                from: 100,
                to: 50000
            }
        };

        const base64 = btoa(JSON.stringify(filterData));
        const url = "<?= base_url('product-list?filter=') ?>" + encodeURIComponent(base64);

        window.location.href = url;
    }
</script>





<script>
    function handleCategoryClick(element) {
        const uid = element.getAttribute('data-uid');

        const categoryData = [uid];

        const filterData = {
            categories: categoryData,
            price: {
                from: 100,
                to: 50000
            }
        };

        const jsonStr = JSON.stringify(filterData);
        const base64 = btoa(jsonStr);
        const url = "<?= base_url('product-list?filter=') ?>" + encodeURIComponent(base64);
        window.location.href = url;
    }
</script>



<script>
const token = <?= !empty($customerLoggedIn) ? 'true' : 'false'; ?>;
console.log("HHHHHHHHHHHH", isLoggedIn);

if (token) {
    document.getElementById('loginBtn').classList.add('d-none');
    document.getElementById('vendorName').classList.remove('d-none');
} else {
    document.getElementById('loginBtn').addEventListener('click', () => {
        const modal = new bootstrap.Modal(
            document.getElementById('loginRegisterModal')
        );
        modal.show();
    });
}
</script>
