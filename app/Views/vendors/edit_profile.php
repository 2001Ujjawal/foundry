<div class="content-body p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Vendor Profile Edit</h5>
    </div>
    <div class="card rounded-10 shadow border-0 overflow-hidden">
        <div class="card-body">
            <form id="vendorEditForm" method="post" enctype="multipart/form-data">
                <div class="row g-3">

                    <!-- Basic Vendor Details -->
                    <div class="col-lg-12">
                        <h4 class="mb-3">Vendor Details</h4>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required value="<?= $resp['name'] ?>">
                            <label for="name">Name <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required value="<?= $resp['email'] ?>">
                            <label for="email">Email<span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" required value="<?= $resp['mobile'] ?>">
                            <label for="mobile">Mobile<span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="country" name="country" required value="<?= $resp['country'] ?>">
                            <label for="country">Country<span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div style="display: none;" class="col-lg-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="dob" name="dob" required value="<?= $resp['dob']?>">
                            <label for="dob">Dob<span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <!-- <div class="col-lg-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="company_description" name="company_description" placeholder="Company Description" style="height: 100px;"><?= $details['company_basic_details']->company_description ?? "" ?></textarea>
                            <label for="company_description"></label>
                        </div>
                    </div> -->

                    <div class="col-lg-12">
                        <label for="company_logo">Uploaded Vendor Logo</label>
                        <?php $companyVendorImage = !empty($resp['image']) ? $resp['image'] : ""  ?>
                        <img width="100" height="100" class="object-fit-cover" src="<?= base_url() . '/' . $companyVendorImage ?>">
                    </div>

                    <input type="hidden" name="old_filepath" value="<?= $companyVendorImage  ?>">

                    <div class="col-lg-12">
                        <div class="form-floating">
                            <input type="file" class="form-control" id="image" name="image">
                            <label for="image">Upload New Vendor Logo</label>
                        </div>
                    </div>

                    <!-- <div class="col-lg-12">
                        <label>Address Line 1 <span class="text-danger">*</span></label>
                        <div class="form-floating">
                            <textarea class="form-control" id="address1" name="address1" placeholder="" required><?= $details['worlocation']->address1  ?? "" ?></textarea>
                        </div>
                    </div> -->

                    <!-- Submit Buttons -->
                    <div class="col-lg-12 d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-warning">RESET</button>
                        <button type="button" class="btn btn-primary" onclick="submitVendorProfile()">SUBMIT</button>
                        <!-- <a href="<?= base_url('companies') ?>" class="btn btn-danger">CANCEL</a> -->
                    </div>

                </div>
            </form>
        </div>
    </div>

<script>
    function submitVendorProfile() {
        const form = document.getElementById('vendorEditForm');
        const formData = new FormData(form);

        fetch('<?= base_url('vendor/api/edit-profile') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(result => {
            window.location.href = BASE_URL +'vendor/profile';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update profile');
        });
    }
</script>