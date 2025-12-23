 <section class="py-5">
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-md-6">
                 <form id="vendorForm" enctype="multipart/form-data" method="post">
                     <div class="d-flex flex-column gap-3">
                         <div class="position-relative p-4 rounded-10 bg-light border overflow-hidden text-center">
                             <div class="d-inline-flex mb-1">
                                 <img id="avatarPreviewVendor"
                                     src="<?= base_url('assets/customer/images/upload-image.svg') ?>"
                                     alt="Avatar Preview"
                                     class="rounded-circle"
                                     width="80" height="80"
                                     style="object-fit: cover;">
                             </div>
                             <strong class="d-block mb-1">Upload Logo*</strong>
                             <small class="d-block" style="color:#666">
                                 Choose a clear Logo to help others recognize you. JPG, PNG, or GIF formats are supported. Max size: 2MB.
                             </small>
                             <input style="opacity: 0;"
                                 class="form-control position-absolute start-0 end-0 top-0 bottom-0"
                                 name="image"
                                 type="file"
                                 id="avatarInputVendor"
                                 accept="image/*" required>
                         </div>

                         <div class="position-relative">
                             <input type="text" name="name" inputmode="text" autocomplete="name" autocapitalize="words" class="form-control" placeholder="Seller Name*" required>
                         </div>
                         <div class="position-relative">
                             <input type="email" name="email" inputmode="email" autocomplete="email" class="form-control" placeholder="Email id*" required>
                         </div>
                         <div class="position-relative">
                             <input type="tel" name="mobile" inputmode="tel" autocomplete="tel" class="form-control" placeholder="Phone Number*" required>
                         </div>
                         <div class="position-relative">
                             <input type="text" name="company" inputmode="text" autocomplete="organization" autocapitalize="words" class="form-control" placeholder="Company Name*" required>
                         </div>
                         <div class="position-relative">
                             <input type="text" name="gst" class="form-control" placeholder="GST/Tax ID">
                         </div>
                         <div class="position-relative">
                             <input type="url" name="website" class="form-control" placeholder="Website">
                         </div>
                         <div class="position-relative">
                             <input type="text" name="country" class="form-control" placeholder="Country*" required>
                         </div>
                         <div class="position-relative">
                             <input type="text" name="states" class="form-control" placeholder="State*" required>
                         </div>
                         <div class="position-relative">
                             <input type="text" name="city" class="form-control" placeholder="City*" required>
                         </div>
                         <div class="position-relative">
                             <textarea name="address" class="form-control" rows="3" placeholder="Address*" required></textarea>
                         </div>

                         <button id="vendorRegisterBtn" type="submit" class="btn btn-primary justify-content-center w-100">
                             Register
                         </button>
                     </div>
                 </form>



             </div>
         </div>
     </div>
 </section>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
     const base_url = "<?= base_url() ?>";
     console.log("=-=-=-=-=-=-=-=-=-=-=-=-=-=-" , base_url);
     
     document.getElementById("avatarInputVendor").addEventListener("change", function(event) {

         console.log("input");

         const file = event.target.files[0];
         if (file && file.type.startsWith("image/")) {
             const reader = new FileReader();
             reader.onload = function(e) {
                 document.getElementById("avatarPreviewVendor").src = e.target.result;
             };
             reader.readAsDataURL(file);
         }
     });


     document.getElementById("vendorForm").addEventListener("submit", function(e) {
         console.log("=====");

         e.preventDefault();

         let form = document.getElementById("vendorForm");
         let submitBtn = document.getElementById("vendorRegisterBtn");

         // Disable button
         submitBtn.disabled = true;
         submitBtn.textContent = "Please wait...";

         let formData = new FormData(form);

         fetch(base_url + "/admin/api/created-vendor", {
                 method: "POST",
                 body: formData
             })
             .then(async (response) => {
                 const res = await response.json();

                 if (response.ok && res.success) {
                     Swal.fire({
                         title: 'Success!',
                         text: 'Thank you for Registering with FoundryBiz as a Seller!',
                         icon: 'success',
                         confirmButtonText: 'OK'
                     });

                     setTimeout(function() {
                         window.location.href = base_url;
                     }, 2000);

                     form.reset();
                     document.getElementById("avatarPreviewVendor").src = "<?= base_url('assets/customer/images/upload-image.svg') ?>";

                 } else {
                     Swal.fire({
                         title: 'Error!',
                         text: res.message || "Failed to create vendor.",
                         icon: 'error',
                         confirmButtonText: 'OK'
                     });
                 }
                 submitBtn.disabled = false;
                 submitBtn.textContent = "Register";
             })
             .catch(error => {
                 console.error("Request error:", error);
                 Swal.fire({
                     title: 'Error!',
                     text: "Something went wrong. Please try again.",
                     icon: 'error',
                     confirmButtonText: 'OK'
                 });

                 // Re-enable button
                 submitBtn.disabled = false;
                 submitBtn.textContent = "Register";
             });
     });
 </script>