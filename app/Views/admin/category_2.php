<style>
    .accordion-button {
        position: relative;
        padding-left: 30px;
    }

    .accordion-button::after {
        position: absolute;
        left: 0;
        top: 15px;
    }

    .noSubCat.accordion-button:after {
        display: none;
    }
</style>

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
        <div class="px-3">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header d-flex border-bottom px-3" id="headingOne">
                        <button class="accordion-button bg-white border-0 shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Category title here
                        </button>
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <button class="btn btn-primary d-flex align-items-center gap-2">
                                    <i style="line-height:0">
                                        <svg version="1.1" height="16" width="16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 348.882 348.882" style="enable-background:new 0 0 348.882 348.882;" xml:space="preserve">
                                            <path d="M333.988,11.758l-0.42-0.383C325.538,4.04,315.129,0,304.258,0c-12.187,0-23.888,5.159-32.104,14.153L116.803,184.231
                                                c-1.416,1.55-2.49,3.379-3.154,5.37l-18.267,54.762c-2.112,6.331-1.052,13.333,2.835,18.729c3.918,5.438,10.23,8.685,16.886,8.685
                                                c0,0,0.001,0,0.001,0c2.879,0,5.693-0.592,8.362-1.76l52.89-23.138c1.923-0.841,3.648-2.076,5.063-3.626L336.771,73.176
                                                C352.937,55.479,351.69,27.929,333.988,11.758z M130.381,234.247l10.719-32.134l0.904-0.99l20.316,18.556l-0.904,0.99
                                                L130.381,234.247z M314.621,52.943L182.553,197.53l-20.316-18.556L294.305,34.386c2.583-2.828,6.118-4.386,9.954-4.386
                                                c3.365,0,6.588,1.252,9.082,3.53l0.419,0.383C319.244,38.922,319.63,47.459,314.621,52.943z" />
                                            <path d="M303.85,138.388c-8.284,0-15,6.716-15,15v127.347c0,21.034-17.113,38.147-38.147,38.147H68.904
                                                c-21.035,0-38.147-17.113-38.147-38.147V100.413c0-21.034,17.113-38.147,38.147-38.147h131.587c8.284,0,15-6.716,15-15
                                                s-6.716-15-15-15H68.904c-37.577,0-68.147,30.571-68.147,68.147v180.321c0,37.576,30.571,68.147,68.147,68.147h181.798
                                                c37.576,0,68.147-30.571,68.147-68.147V153.388C318.85,145.104,312.134,138.388,303.85,138.388z" />
                                        </svg>
                                    </i>
                                    <span>Edit</span>
                                </button>
                            </div>
                            <div>
                                <button class="btn btn-danger d-flex align-items-center gap-2">
                                    <i style="line-height:0">
                                        <svg height="16" width="16" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Line">
                                                <path d="m21 5h-3v-1a3 3 0 0 0 -3-3h-6a3 3 0 0 0 -3 3v1h-3a1 1 0 0 0 0 2h.06l.71 11.31a5 5 0 0 0 5 4.69h6.48a5 5 0 0 0 5-4.69l.69-11.31h.06a1 1 0 0 0 0-2zm-13-1a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h-8zm10.24 14.19a3 3 0 0 1 -3 2.81h-6.48a3 3 0 0 1 -3-2.81l-.7-11.19h13.88z" />
                                                <path d="m10 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                                <path d="m14 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                            </g>
                                        </svg>
                                    </i>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group">
                                <li class="list-group-item bg-light">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>SubCategory title here</div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <button class="btn btn-primary d-flex align-items-center gap-2">
                                                    <i style="line-height:0">
                                                        <svg version="1.1" height="16" width="16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                            viewBox="0 0 348.882 348.882" style="enable-background:new 0 0 348.882 348.882;" xml:space="preserve">
                                                            <path d="M333.988,11.758l-0.42-0.383C325.538,4.04,315.129,0,304.258,0c-12.187,0-23.888,5.159-32.104,14.153L116.803,184.231
                                                                c-1.416,1.55-2.49,3.379-3.154,5.37l-18.267,54.762c-2.112,6.331-1.052,13.333,2.835,18.729c3.918,5.438,10.23,8.685,16.886,8.685
                                                                c0,0,0.001,0,0.001,0c2.879,0,5.693-0.592,8.362-1.76l52.89-23.138c1.923-0.841,3.648-2.076,5.063-3.626L336.771,73.176
                                                                C352.937,55.479,351.69,27.929,333.988,11.758z M130.381,234.247l10.719-32.134l0.904-0.99l20.316,18.556l-0.904,0.99
                                                                L130.381,234.247z M314.621,52.943L182.553,197.53l-20.316-18.556L294.305,34.386c2.583-2.828,6.118-4.386,9.954-4.386
                                                                c3.365,0,6.588,1.252,9.082,3.53l0.419,0.383C319.244,38.922,319.63,47.459,314.621,52.943z" />
                                                            <path d="M303.85,138.388c-8.284,0-15,6.716-15,15v127.347c0,21.034-17.113,38.147-38.147,38.147H68.904
                                                                c-21.035,0-38.147-17.113-38.147-38.147V100.413c0-21.034,17.113-38.147,38.147-38.147h131.587c8.284,0,15-6.716,15-15
                                                                s-6.716-15-15-15H68.904c-37.577,0-68.147,30.571-68.147,68.147v180.321c0,37.576,30.571,68.147,68.147,68.147h181.798
                                                                c37.576,0,68.147-30.571,68.147-68.147V153.388C318.85,145.104,312.134,138.388,303.85,138.388z" />
                                                        </svg>
                                                    </i>
                                                    <span>Edit</span>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="btn btn-danger d-flex align-items-center gap-2">
                                                    <i style="line-height:0">
                                                        <svg height="16" width="16" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <g id="Line">
                                                                <path d="m21 5h-3v-1a3 3 0 0 0 -3-3h-6a3 3 0 0 0 -3 3v1h-3a1 1 0 0 0 0 2h.06l.71 11.31a5 5 0 0 0 5 4.69h6.48a5 5 0 0 0 5-4.69l.69-11.31h.06a1 1 0 0 0 0-2zm-13-1a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h-8zm10.24 14.19a3 3 0 0 1 -3 2.81h-6.48a3 3 0 0 1 -3-2.81l-.7-11.19h13.88z" />
                                                                <path d="m10 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                                                <path d="m14 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                                            </g>
                                                        </svg>
                                                    </i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item bg-light">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>SubCategory title here</div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <button class="btn btn-primary d-flex align-items-center gap-2">
                                                    <i style="line-height:0">
                                                        <svg version="1.1" height="16" width="16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                            viewBox="0 0 348.882 348.882" style="enable-background:new 0 0 348.882 348.882;" xml:space="preserve">
                                                            <path d="M333.988,11.758l-0.42-0.383C325.538,4.04,315.129,0,304.258,0c-12.187,0-23.888,5.159-32.104,14.153L116.803,184.231
                                                                c-1.416,1.55-2.49,3.379-3.154,5.37l-18.267,54.762c-2.112,6.331-1.052,13.333,2.835,18.729c3.918,5.438,10.23,8.685,16.886,8.685
                                                                c0,0,0.001,0,0.001,0c2.879,0,5.693-0.592,8.362-1.76l52.89-23.138c1.923-0.841,3.648-2.076,5.063-3.626L336.771,73.176
                                                                C352.937,55.479,351.69,27.929,333.988,11.758z M130.381,234.247l10.719-32.134l0.904-0.99l20.316,18.556l-0.904,0.99
                                                                L130.381,234.247z M314.621,52.943L182.553,197.53l-20.316-18.556L294.305,34.386c2.583-2.828,6.118-4.386,9.954-4.386
                                                                c3.365,0,6.588,1.252,9.082,3.53l0.419,0.383C319.244,38.922,319.63,47.459,314.621,52.943z" />
                                                            <path d="M303.85,138.388c-8.284,0-15,6.716-15,15v127.347c0,21.034-17.113,38.147-38.147,38.147H68.904
                                                                c-21.035,0-38.147-17.113-38.147-38.147V100.413c0-21.034,17.113-38.147,38.147-38.147h131.587c8.284,0,15-6.716,15-15
                                                                s-6.716-15-15-15H68.904c-37.577,0-68.147,30.571-68.147,68.147v180.321c0,37.576,30.571,68.147,68.147,68.147h181.798
                                                                c37.576,0,68.147-30.571,68.147-68.147V153.388C318.85,145.104,312.134,138.388,303.85,138.388z" />
                                                        </svg>
                                                    </i>
                                                    <span>Edit</span>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="btn btn-danger d-flex align-items-center gap-2">
                                                    <i style="line-height:0">
                                                        <svg height="16" width="16" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <g id="Line">
                                                                <path d="m21 5h-3v-1a3 3 0 0 0 -3-3h-6a3 3 0 0 0 -3 3v1h-3a1 1 0 0 0 0 2h.06l.71 11.31a5 5 0 0 0 5 4.69h6.48a5 5 0 0 0 5-4.69l.69-11.31h.06a1 1 0 0 0 0-2zm-13-1a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h-8zm10.24 14.19a3 3 0 0 1 -3 2.81h-6.48a3 3 0 0 1 -3-2.81l-.7-11.19h13.88z" />
                                                                <path d="m10 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                                                <path d="m14 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                                            </g>
                                                        </svg>
                                                    </i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header d-flex border-bottom px-3" id="headingTwo">
                        <button class="accordion-button bg-white border-0 shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Category title here
                        </button>
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <button class="btn btn-primary d-flex align-items-center gap-2">
                                    <i style="line-height:0">
                                        <svg version="1.1" height="16" width="16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 348.882 348.882" style="enable-background:new 0 0 348.882 348.882;" xml:space="preserve">
                                            <path d="M333.988,11.758l-0.42-0.383C325.538,4.04,315.129,0,304.258,0c-12.187,0-23.888,5.159-32.104,14.153L116.803,184.231
                                                c-1.416,1.55-2.49,3.379-3.154,5.37l-18.267,54.762c-2.112,6.331-1.052,13.333,2.835,18.729c3.918,5.438,10.23,8.685,16.886,8.685
                                                c0,0,0.001,0,0.001,0c2.879,0,5.693-0.592,8.362-1.76l52.89-23.138c1.923-0.841,3.648-2.076,5.063-3.626L336.771,73.176
                                                C352.937,55.479,351.69,27.929,333.988,11.758z M130.381,234.247l10.719-32.134l0.904-0.99l20.316,18.556l-0.904,0.99
                                                L130.381,234.247z M314.621,52.943L182.553,197.53l-20.316-18.556L294.305,34.386c2.583-2.828,6.118-4.386,9.954-4.386
                                                c3.365,0,6.588,1.252,9.082,3.53l0.419,0.383C319.244,38.922,319.63,47.459,314.621,52.943z" />
                                            <path d="M303.85,138.388c-8.284,0-15,6.716-15,15v127.347c0,21.034-17.113,38.147-38.147,38.147H68.904
                                                c-21.035,0-38.147-17.113-38.147-38.147V100.413c0-21.034,17.113-38.147,38.147-38.147h131.587c8.284,0,15-6.716,15-15
                                                s-6.716-15-15-15H68.904c-37.577,0-68.147,30.571-68.147,68.147v180.321c0,37.576,30.571,68.147,68.147,68.147h181.798
                                                c37.576,0,68.147-30.571,68.147-68.147V153.388C318.85,145.104,312.134,138.388,303.85,138.388z" />
                                        </svg>
                                    </i>
                                    <span>Edit</span>
                                </button>
                            </div>
                            <div>
                                <button class="btn btn-danger d-flex align-items-center gap-2">
                                    <i style="line-height:0">
                                        <svg height="16" width="16" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Line">
                                                <path d="m21 5h-3v-1a3 3 0 0 0 -3-3h-6a3 3 0 0 0 -3 3v1h-3a1 1 0 0 0 0 2h.06l.71 11.31a5 5 0 0 0 5 4.69h6.48a5 5 0 0 0 5-4.69l.69-11.31h.06a1 1 0 0 0 0-2zm-13-1a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h-8zm10.24 14.19a3 3 0 0 1 -3 2.81h-6.48a3 3 0 0 1 -3-2.81l-.7-11.19h13.88z" />
                                                <path d="m10 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                                <path d="m14 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                            </g>
                                        </svg>
                                    </i>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group">
                                <li class="list-group-item bg-light">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>SubCategory title here</div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <button class="btn btn-primary d-flex align-items-center gap-2">
                                                    <i style="line-height:0">
                                                        <svg version="1.1" height="16" width="16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                            viewBox="0 0 348.882 348.882" style="enable-background:new 0 0 348.882 348.882;" xml:space="preserve">
                                                            <path d="M333.988,11.758l-0.42-0.383C325.538,4.04,315.129,0,304.258,0c-12.187,0-23.888,5.159-32.104,14.153L116.803,184.231
                                                                c-1.416,1.55-2.49,3.379-3.154,5.37l-18.267,54.762c-2.112,6.331-1.052,13.333,2.835,18.729c3.918,5.438,10.23,8.685,16.886,8.685
                                                                c0,0,0.001,0,0.001,0c2.879,0,5.693-0.592,8.362-1.76l52.89-23.138c1.923-0.841,3.648-2.076,5.063-3.626L336.771,73.176
                                                                C352.937,55.479,351.69,27.929,333.988,11.758z M130.381,234.247l10.719-32.134l0.904-0.99l20.316,18.556l-0.904,0.99
                                                                L130.381,234.247z M314.621,52.943L182.553,197.53l-20.316-18.556L294.305,34.386c2.583-2.828,6.118-4.386,9.954-4.386
                                                                c3.365,0,6.588,1.252,9.082,3.53l0.419,0.383C319.244,38.922,319.63,47.459,314.621,52.943z" />
                                                            <path d="M303.85,138.388c-8.284,0-15,6.716-15,15v127.347c0,21.034-17.113,38.147-38.147,38.147H68.904
                                                                c-21.035,0-38.147-17.113-38.147-38.147V100.413c0-21.034,17.113-38.147,38.147-38.147h131.587c8.284,0,15-6.716,15-15
                                                                s-6.716-15-15-15H68.904c-37.577,0-68.147,30.571-68.147,68.147v180.321c0,37.576,30.571,68.147,68.147,68.147h181.798
                                                                c37.576,0,68.147-30.571,68.147-68.147V153.388C318.85,145.104,312.134,138.388,303.85,138.388z" />
                                                        </svg>
                                                    </i>
                                                    <span>Edit</span>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="btn btn-danger d-flex align-items-center gap-2">
                                                    <i style="line-height:0">
                                                        <svg height="16" width="16" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <g id="Line">
                                                                <path d="m21 5h-3v-1a3 3 0 0 0 -3-3h-6a3 3 0 0 0 -3 3v1h-3a1 1 0 0 0 0 2h.06l.71 11.31a5 5 0 0 0 5 4.69h6.48a5 5 0 0 0 5-4.69l.69-11.31h.06a1 1 0 0 0 0-2zm-13-1a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h-8zm10.24 14.19a3 3 0 0 1 -3 2.81h-6.48a3 3 0 0 1 -3-2.81l-.7-11.19h13.88z" />
                                                                <path d="m10 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                                                <path d="m14 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                                            </g>
                                                        </svg>
                                                    </i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item bg-light">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>SubCategory title here</div>
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <button class="btn btn-primary d-flex align-items-center gap-2">
                                                    <i style="line-height:0">
                                                        <svg version="1.1" height="16" width="16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                            viewBox="0 0 348.882 348.882" style="enable-background:new 0 0 348.882 348.882;" xml:space="preserve">
                                                            <path d="M333.988,11.758l-0.42-0.383C325.538,4.04,315.129,0,304.258,0c-12.187,0-23.888,5.159-32.104,14.153L116.803,184.231
                                                                c-1.416,1.55-2.49,3.379-3.154,5.37l-18.267,54.762c-2.112,6.331-1.052,13.333,2.835,18.729c3.918,5.438,10.23,8.685,16.886,8.685
                                                                c0,0,0.001,0,0.001,0c2.879,0,5.693-0.592,8.362-1.76l52.89-23.138c1.923-0.841,3.648-2.076,5.063-3.626L336.771,73.176
                                                                C352.937,55.479,351.69,27.929,333.988,11.758z M130.381,234.247l10.719-32.134l0.904-0.99l20.316,18.556l-0.904,0.99
                                                                L130.381,234.247z M314.621,52.943L182.553,197.53l-20.316-18.556L294.305,34.386c2.583-2.828,6.118-4.386,9.954-4.386
                                                                c3.365,0,6.588,1.252,9.082,3.53l0.419,0.383C319.244,38.922,319.63,47.459,314.621,52.943z" />
                                                            <path d="M303.85,138.388c-8.284,0-15,6.716-15,15v127.347c0,21.034-17.113,38.147-38.147,38.147H68.904
                                                                c-21.035,0-38.147-17.113-38.147-38.147V100.413c0-21.034,17.113-38.147,38.147-38.147h131.587c8.284,0,15-6.716,15-15
                                                                s-6.716-15-15-15H68.904c-37.577,0-68.147,30.571-68.147,68.147v180.321c0,37.576,30.571,68.147,68.147,68.147h181.798
                                                                c37.576,0,68.147-30.571,68.147-68.147V153.388C318.85,145.104,312.134,138.388,303.85,138.388z" />
                                                        </svg>
                                                    </i>
                                                    <span>Edit</span>
                                                </button>
                                            </div>
                                            <div>
                                                <button class="btn btn-danger d-flex align-items-center gap-2">
                                                    <i style="line-height:0">
                                                        <svg height="16" width="16" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <g id="Line">
                                                                <path d="m21 5h-3v-1a3 3 0 0 0 -3-3h-6a3 3 0 0 0 -3 3v1h-3a1 1 0 0 0 0 2h.06l.71 11.31a5 5 0 0 0 5 4.69h6.48a5 5 0 0 0 5-4.69l.69-11.31h.06a1 1 0 0 0 0-2zm-13-1a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h-8zm10.24 14.19a3 3 0 0 1 -3 2.81h-6.48a3 3 0 0 1 -3-2.81l-.7-11.19h13.88z" />
                                                                <path d="m10 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                                                <path d="m14 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                                            </g>
                                                        </svg>
                                                    </i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header d-flex border-bottom px-3" id="headingThree">
                        <button class="accordion-button bg-white border-0 shadow-none collapsed noSubCat" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Category title here
                        </button>
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <button class="btn btn-primary d-flex align-items-center gap-2">
                                    <i style="line-height:0">
                                        <svg version="1.1" height="16" width="16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 348.882 348.882" style="enable-background:new 0 0 348.882 348.882;" xml:space="preserve">
                                            <path d="M333.988,11.758l-0.42-0.383C325.538,4.04,315.129,0,304.258,0c-12.187,0-23.888,5.159-32.104,14.153L116.803,184.231
                                                c-1.416,1.55-2.49,3.379-3.154,5.37l-18.267,54.762c-2.112,6.331-1.052,13.333,2.835,18.729c3.918,5.438,10.23,8.685,16.886,8.685
                                                c0,0,0.001,0,0.001,0c2.879,0,5.693-0.592,8.362-1.76l52.89-23.138c1.923-0.841,3.648-2.076,5.063-3.626L336.771,73.176
                                                C352.937,55.479,351.69,27.929,333.988,11.758z M130.381,234.247l10.719-32.134l0.904-0.99l20.316,18.556l-0.904,0.99
                                                L130.381,234.247z M314.621,52.943L182.553,197.53l-20.316-18.556L294.305,34.386c2.583-2.828,6.118-4.386,9.954-4.386
                                                c3.365,0,6.588,1.252,9.082,3.53l0.419,0.383C319.244,38.922,319.63,47.459,314.621,52.943z" />
                                            <path d="M303.85,138.388c-8.284,0-15,6.716-15,15v127.347c0,21.034-17.113,38.147-38.147,38.147H68.904
                                                c-21.035,0-38.147-17.113-38.147-38.147V100.413c0-21.034,17.113-38.147,38.147-38.147h131.587c8.284,0,15-6.716,15-15
                                                s-6.716-15-15-15H68.904c-37.577,0-68.147,30.571-68.147,68.147v180.321c0,37.576,30.571,68.147,68.147,68.147h181.798
                                                c37.576,0,68.147-30.571,68.147-68.147V153.388C318.85,145.104,312.134,138.388,303.85,138.388z" />
                                        </svg>
                                    </i>
                                    <span>Edit</span>
                                </button>
                            </div>
                            <div>
                                <button class="btn btn-danger d-flex align-items-center gap-2">
                                    <i style="line-height:0">
                                        <svg height="16" width="16" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Line">
                                                <path d="m21 5h-3v-1a3 3 0 0 0 -3-3h-6a3 3 0 0 0 -3 3v1h-3a1 1 0 0 0 0 2h.06l.71 11.31a5 5 0 0 0 5 4.69h6.48a5 5 0 0 0 5-4.69l.69-11.31h.06a1 1 0 0 0 0-2zm-13-1a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h-8zm10.24 14.19a3 3 0 0 1 -3 2.81h-6.48a3 3 0 0 1 -3-2.81l-.7-11.19h13.88z" />
                                                <path d="m10 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                                <path d="m14 10a1 1 0 0 0 -1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0 -1-1z" />
                                            </g>
                                        </svg>
                                    </i>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </h2>
                </div>
            </div>
        </div>

        <div class="px-3 pb-3 mt-5" id="categoryTree"></div>
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
        function loadCategories() {
            $.ajax({
                url: "https://devs.v-xplore.com/foundry/admin/categories",
                type: "GET",
                success: function(response) {
                    console.log("============================", response);
                    if (response.success) {

                        let html = buildTreeHtml(response.data);


                        $("#categoryTree").html(html);
                    }
                }
            });
        }

        function buildTreeHtml(categories, parentId = "root") {
            let html = "<ul class='list-group gap-2'>";
            categories.forEach((cat, index) => {
                let hasChildren = cat.children && cat.children.length > 0;
                let collapseId = parentId + "-" + index; // unique ID per child set

                html += `
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span ${hasChildren ? `data-bs-toggle="collapse" data-bs-target="#sub-${collapseId}" role="button" aria-expanded="false" aria-controls="sub-${collapseId}"` : ""}>
                <i class="bi bi-folder-fill me-2 text-warning"></i> ${cat.title}
            </span>
            <span>
                <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                <button class="btn btn-sm btn-outline-danger">Delete</button>
            </span>
        </li>
        `;

                if (hasChildren) {
                    html += `
            <ul class="list-group collapse ms-4 mt-2" id="sub-${collapseId}">
                ${buildTreeHtml(cat.children, collapseId)}
            </ul>
            `;
                }
            });
            html += "</ul>";
            return html;
        }


        $(document).ready(function() {
            loadCategories();
        });
    </script>


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