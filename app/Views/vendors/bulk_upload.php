<div class="content-body p-3">
    <div class="mt-4 rounded-10 bg-white border">

        <!-- Header Title + Buttons -->
        <div class="p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">

                    <!-- Back Button -->
                    <a href="<?= base_url('vendor/products'); ?>"
                        class="btn btn-light d-flex align-items-center gap-2 py-2 px-3"
                        style="border: 1px solid #ddd;">

                        <!-- Back Arrow Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>

                        <span>Back</span>
                    </a>

                    <!-- Page Title -->
                    <div class="m-0 h5 fw-600">Bulk Upload Products</div>
                </div>
            </div>
        </div>

        <!-- Content Body -->
        <div class="px-3 pb-3">
            <div class="p-3">

                <p class="mb-2">
                    Upload an Excel file (.xlsx / .xls / .csv). The file MUST contain these columns:
                </p>

                <ul style="line-height: 1.8;">
                    <li><strong>Product Name</strong> — required</li>
                    <li><strong>Category Name</strong> — required</li>
                    <!-- <li><strong>Sub Category</strong> — optional</li> -->
                    <li><strong>Description</strong> — required</li>
                    <li><strong>Meta Description</strong></li>
                    <li><strong>Meta Keywords</strong></li>
                    <li><strong>Meta Title</strong></li>
                    <li><strong>Meta Tags</strong></li>
                    
                    
                </ul>

                <!-- <a class="btn btn-sm btn-light my-2" 
                   href="<?= base_url('assets/templates/product_bulk_template.xlsx') ?>" download>
                    Download Excel Template
                </a> -->
                <a href="<?= base_url('assets/templates/product_bulk_template.xlsx') ?>"
                    download
                    class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill shadow-sm"
                    style="background:#0D9488;color:#fff;border:none;transition:background .2s ease;"
                    onmouseover="this.style.background='#AB3D3C'"
                    onmouseout="this.style.background='#0D9488'">

                    <svg width="25" height="25" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" y1="15" x2="12" y2="3" />
                    </svg>

                    Download Excel Template
                </a>
                <!-- Form -->
                <form id="bulkUploadForm" enctype="multipart/form-data" class="mt-3">

                    <div class="mb-3">
                        <label class="form-label fw-600">Upload Excel File</label>
                        <input type="file"
                            class="form-control"
                            name="excel_file"
                            id="excelFile"
                            accept=".xlsx,.xls,.csv"
                            required>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">

                        <a href="<?= base_url('vendor/products'); ?>"
                            class="btn btn-secondary px-4">
                            CANCEL
                        </a>

                        <button id="bulkUploadBtn"
                            type="submit"
                            class="btn btn-primary px-4">
                            UPLOAD
                        </button>
                    </div>
                </form>

                <!-- Results -->
                <div id="bulkUploadResult" class="mt-4"></div>

            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {

        $('#bulkUploadForm').on('submit', function(e) {
            e.preventDefault();

            $('#bulkUploadResult').html('');
            var fileInput = $('#excelFile')[0];

            if (fileInput.files.length === 0) {
                MessError.fire({
                    icon: 'error',
                    title: 'Please select a file.'
                });
                return;
            }

            var formData = new FormData(this);
            var btn = $('#bulkUploadBtn');

            btn.prop('disabled', true).text('Uploading...');

            $.ajax({
                url: BASE_URL + '/vendor/bulk-upload-submit',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,

                success: function(response) {
                    MessSuccess.fire({
                        icon: 'success',
                        title: response.message
                    });

                    setTimeout(() => {
                        window.location.href = BASE_URL + '/vendor/products';
                    }, 1500);
                },

                error: function(xhr) {
                    var json = {};
                    try {
                        json = JSON.parse(xhr.responseText);
                    } catch (e) {}

                    let errBox = `
                    <div class="alert alert-danger">
                        <strong>${json.message || 'Upload failed'}</strong>
                `;

                    if (json.errors && json.errors.length) {
                        errBox += '<ul>';
                        json.errors.forEach(e => errBox += '<li>' + e + '</li>');
                        errBox += '</ul>';
                    }

                    errBox += '</div>';

                    $('#bulkUploadResult').html(errBox);

                    MessError.fire({
                        icon: 'error',
                        title: json.message || 'Upload failed'
                    });
                },

                complete: function() {
                    btn.prop('disabled', false).text('UPLOAD');
                }
            });
        });
    });
</script>