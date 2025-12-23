<div class="content-body p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Vendor Details</h5>
        <!-- <a href="<?= base_url('vendor/edit-profile') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-pencil-fill"></i> Edit Profile
        </a> -->
    </div>
    <div class="card p-4 shadow-sm">
        <!-- Header with title and edit button -->

        <div class="row align-items-center">
            <!-- Vendor Profile Image -->
            <div class="col-md-3 text-center mb-3 mb-md-0">
                <img src="<?= base_url($resp['image']) ?>"
                    alt="Vendor Image"
                    class="img-fluid rounded-circle border border-3 border-primary shadow"
                    style="width: 120px; height: 120px; object-fit: cover;">
            </div>

            <!-- Vendor Details -->
            <div class="col-md-9">
                <div class="row g-3">
                    <div class="col-md-6">
                        <strong>Company Name:</strong> <?= esc($resp['company'] ?? 'N/A') ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong> <?= esc($resp['email'] ?? 'N/A') ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Name:</strong> <?= esc($resp['name'] ?? 'N/A') ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Mobile:</strong> <?= esc($resp['mobile'] ?? 'N/A') ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Country:</strong> <?= esc($resp['country'] ?? 'N/A') ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Date of Birth:</strong> <?= !empty($resp['dob']) ? esc(date('d F Y', strtotime($resp['dob']))) : 'N/A' ?>
                    </div>
                    <!-- <div class="col-md-6">
                        <strong>Country:</strong> <?= esc($resp['country'] ?? 'N/A') ?>
                    </div> -->
                    <div class="col-md-6">
                        <strong>Status:</strong> <?= ucfirst($resp['status'] ?? 'N/A') ?>
                    </div>
                    <!-- Add more fields if needed -->
                </div>
            </div>
        </div>
    </div>
    </die>