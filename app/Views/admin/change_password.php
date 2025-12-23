<div class="content-body p-3">
    <form method="post" class="mx-auto p-4 col-md-8 col-lg-6 rounded-10 border bg-white d-block">

        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <label class="form-label">Password <span style="color: red;">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
            </div>
            <div class="col-md-12">
                <label class="form-label">Confirm Password <span style="color: red;">*</span></label>
                <input type="password" class="form-control" id="con_password" name="con_password" placeholder="Enter Confirm Password">
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-end gap-3">
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-primary-outline py-2">
                <span>Cancel</span>
            </a>
            <button type="submit" id="saveButton" class="btn btn-primary d-flex align-items-center gap-1 py-2">
                <span>Change Password</span>
            </button>
        </div>
    </form>
</div>

<script>
    document.querySelector("form").addEventListener("submit", async function(event) {
        event.preventDefault();

        var password = $("#password").val();
        var con_password = $("#con_password").val();
        var clinicId = $("#clinicId").val();

        $('.text-danger').remove();
        let isValid = true;

        $(this).find('input[type="password"]').each(function() {
            const input = $(this);
            const value = input.val().trim();

            if (value === '') {
                isValid = false;
                input.after('<div class="text-danger mt-1">This field is required</div>');
            }
        });

        if (password !== con_password) {
            $('#con_password').after('<div class="text-danger mt-1">Passwords do not match</div>');
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        let formData = new FormData();
        formData.append("password", password);

        const $button = $('#saveButton');
        $button.prop('disabled', true).text('Loading...');

        $.ajax({
            url: BASE_URL + 'admin/api/change-password',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                window.location.href = BASE_URL + 'admin/logout';
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
</script>