<x-main-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Function to submit the invoice form
        function submitInvoiceForm() {
            console.log('Submitting invoice form');
            
            // Client-side validation
            let hasErrors = false;
            const requiredFields = ['name', 'phone', 'email', 'invoicetype', 'invoicevalue'];
            
            // Check required fields
            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('invalid-feedback')) {
                        const feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback d-flex align-items-center';
                        feedback.innerHTML = `<i class="fas fa-exclamation-circle me-1"></i>هذا الحقل مطلوب`;
                        input.parentNode.appendChild(feedback);
                    }
                    hasErrors = true;
                }
            });
            
            // If there are errors, stop form submission
            if (hasErrors) {
                // Show validation error message
                Swal.fire({
                    title: 'خطأ في البيانات',
                    text: 'يرجى ملء جميع الحقول المطلوبة',
                    icon: 'error',
                    confirmButtonText: 'حسناً',
                    confirmButtonColor: '#dc3545',
                    customClass: {
                        popup: 'rtl-swal'
                    }
                });
                return false;
            }
            
            // Show loading state on button
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>جاري الإرسال...';
            submitBtn.disabled = true;
            
            // Clear previous validation errors
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            
            // Get form data
            const form = document.getElementById('paymentForm');
            const formData = new FormData(form);
            
            // Add CSRF token
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            
            // Log form data for debugging
            console.log('Form action:', form.getAttribute('action'));
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            
            // Hard-code the public route for invoice submission
            const publicRoute = '/invoices';
            console.log('Using public route:', publicRoute);
            
            // Submit via jQuery AJAX (more compatible with Laravel)
            jQuery.ajax({
                url: publicRoute,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .done(function(response) {
                // Success
                console.log('Success:', response);
                
                // Reset form
                form.reset();
                
                // Show success message
                Swal.fire({
                    title: 'تم إرسال الفاتورة بنجاح!',
                    text: 'سيتم مراجعة الفاتورة والرد عليك في أقرب وقت ممكن.',
                    icon: 'success',
                    confirmButtonText: 'حسناً',
                    confirmButtonColor: '#0d6efd',
                    customClass: {
                        popup: 'rtl-swal'
                    }
                });
            })
            .fail(function(xhr, status, error) {
                console.error('Error:', xhr, status, error);
                console.log('Response Text:', xhr.responseText);
                
                try {
                    // Try to parse the error response
                    let errorData = xhr.responseJSON;
                    console.log('Error Data:', errorData);
                    
                    if (xhr.status === 422 && errorData && errorData.errors) {
                        // Validation errors
                        const errors = errorData.errors;
                        
                        // Display validation errors
                        jQuery.each(errors, function(key, value) {
                            const input = jQuery('#' + key);
                            if (input.length) {
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback d-flex align-items-center"><i class="fas fa-exclamation-circle me-1"></i>' + value[0] + '</div>');
                            }
                        });
                        
                        // Show validation error message
                        Swal.fire({
                            title: 'خطأ في البيانات',
                            text: 'يرجى التحقق من البيانات المدخلة وإعادة المحاولة.',
                            icon: 'error',
                            confirmButtonText: 'حسناً',
                            confirmButtonColor: '#dc3545',
                            customClass: {
                                popup: 'rtl-swal'
                            }
                        });
                    } else if (errorData && errorData.message) {
                        // Show specific error message from server
                        Swal.fire({
                            title: 'حدث خطأ!',
                            text: errorData.message,
                            icon: 'error',
                            confirmButtonText: 'حسناً',
                            confirmButtonColor: '#dc3545',
                            customClass: {
                                popup: 'rtl-swal'
                            }
                        });
                    } else {
                        // General error
                        Swal.fire({
                            title: 'حدث خطأ!',
                            text: 'حدث خطأ أثناء إرسال الفاتورة. يرجى المحاولة مرة أخرى.',
                            icon: 'error',
                            confirmButtonText: 'حسناً',
                            confirmButtonColor: '#dc3545',
                            customClass: {
                                popup: 'rtl-swal'
                            }
                        });
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    
                    // Fallback error message
                    Swal.fire({
                        title: 'حدث خطأ!',
                        text: 'حدث خطأ أثناء إرسال الفاتورة. يرجى المحاولة مرة أخرى.',
                        icon: 'error',
                        confirmButtonText: 'حسناً',
                        confirmButtonColor: '#dc3545',
                        customClass: {
                            popup: 'rtl-swal'
                        }
                    });
                }
            })
            .always(function() {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        }
    </script>
    <div class="container">
        <!-- Payment Methods Section -->
        <section class="py-5 px-3" dir="rtl">
            <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center px-3 py-1 rounded-pill bg-primary bg-opacity-10 text-primary fs-6 fw-medium mb-3">
                    <span class="bg-primary rounded-circle me-2" style="width: 8px; height: 8px;"></span>
                    <span>خيارات متعددة</span>
                </div>
                <h2 class="display-5 fw-bold mb-3 text-dark">طرق الدفع المتاحة</h2>
                <p class="text-secondary mx-auto" style="max-width: 42rem;">اختر طريقة الدفع المناسبة لك من الخيارات التالية</p>
            </div>

            <div class="row g-4">
                <!-- Mobile Payment Card -->
                <div class="col-12">
                    <hr class="my-3">
                </div>
                <div class="col-12 py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-wallet text-primary fs-1 me-3"></i>
                                <h2 class="mb-0">انستا باي</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-primary">انستا باي</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5 class="mb-2">digitalhubegypt@instapay</h5>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <button class="btn btn-outline-secondary">نسخ</button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr class="my-3">
                </div>
                <div class="col-12 py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-mobile-alt text-primary fs-1 me-3"></i>
                                <h2 class="mb-0">فودافون كاش</h2>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3 pt-md-0">
                            <button class="btn btn-outline-primary me-2 mb-2 mb-md-0">فودافون كاش</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h2 class="mb-0">01066843185</h2>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-secondary">نسخ</button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr class="my-3">
                </div>

                <div class="col-12 py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-university text-primary fs-1 me-3"></i>
                                <h2 class="mb-0">pay pal</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-primary">pay pal</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5 class="mb-2">ahmedgamal50@gmail.com</h5>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <button class="btn btn-outline-secondary">نسخ</button>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <hr class="my-3">
                </div>

                <div class="col-12 py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-university text-primary fs-1 me-3"></i>
                                <h2 class="mb-0">watson union</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-primary">watson union</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5 class="mb-2">Ahmed Gamal Eldin Mohamed Hazee</h5>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <button class="btn btn-outline-secondary">نسخ</button>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <hr class="my-3">
                </div>
            </div>
        </section>

        <!-- Invoice Form Section -->
        <section class="mb-5 py-5">
            <header class="text-center mb-4">
                <h2 class="display-5 fw-bold mb-3 text-dark">إضافة فاتورة جديدة</h2>
                <p class="text-secondary mx-auto" style="max-width: 42rem;">قم بملئ النموذج التالي لإرسال فاتورتك</p>
                <div class="mx-auto mt-3 rounded" style="width: 6rem; height: 0.25rem; background-color: var(--bs-primary);"></div>
            </header>
            
            <div class="bg-white rounded shadow-sm p-4">
                <form action="/invoices" method="POST" enctype="multipart/form-data" class="mb-4" id="paymentForm" onsubmit="return false;">
                    @csrf
                    
                    <div class="row g-4">
                        <div class="col-md-6 position-relative">
                            <label for="name" class="form-label fw-medium d-flex align-items-center">
                                <i class="fas fa-user text-primary me-2"></i>
                                الاسم <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" placeholder="الاسم الكامل" required>
                            @error('name')
                                <div class="invalid-feedback d-flex align-items-center"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="phone" class="form-label fw-medium d-flex align-items-center">
                                <i class="fas fa-phone-alt text-primary me-2"></i>
                                رقم الهاتف <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                id="phone" name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX" required>
                            @error('phone')
                                <div class="invalid-feedback d-flex align-items-center"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="email" class="form-label fw-medium d-flex align-items-center">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                البريد الإلكتروني <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email') }}" placeholder="example@domain.com" required>
                            @error('email')
                                <div class="invalid-feedback d-flex align-items-center"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="invoicetime" class="form-label fw-medium d-flex align-items-center">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                تاريخ ووقت الفاتورة <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="datetime-local" class="form-control @error('invoicetime') is-invalid @enderror" 
                                id="invoicetime" name="invoicetime" value="{{ old('invoicetime') ?? now()->format('Y-m-d\\TH:i') }}" required>
                            @error('invoicetime')
                                <div class="invalid-feedback d-flex align-items-center"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="invoicevalue" class="form-label fw-medium d-flex align-items-center">
                                <i class="fas fa-money-bill-wave text-primary me-2"></i>
                                قيمة الفاتورة <span class="text-danger ms-1">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('invoicevalue') is-invalid @enderror" 
                                    id="invoicevalue" name="invoicevalue" value="{{ old('invoicevalue') }}" step="0.01" min="0" placeholder="0.00" required>
                                <span class="input-group-text bg-light">ج.م</span>
                            </div>
                            @error('invoicevalue')
                                <div class="invalid-feedback d-flex align-items-center"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="invoicetype" class="form-label fw-medium d-flex align-items-center">
                                <i class="fas fa-tag text-primary me-2"></i>
                                نوع الفاتورة <span class="text-danger ms-1">*</span>
                            </label>
                            <select class="form-select @error('invoicetype') is-invalid @enderror" 
                                id="invoicetype" name="invoicetype" required>
                                <option value="">اختر نوع الفاتورة</option>
                                <option value="course" {{ old('invoicetype') == 'course' ? 'selected' : '' }}>كورس</option>
                                <option value="subscription" {{ old('invoicetype') == 'subscription' ? 'selected' : '' }}>اشتراك</option>
                                <option value="service" {{ old('invoicetype') == 'service' ? 'selected' : '' }}>خدمة</option>
                                <option value="other" {{ old('invoicetype') == 'other' ? 'selected' : '' }}>أخرى</option>
                            </select>
                            <div class="form-text text-muted mt-1">
                                <i class="fas fa-info-circle"></i> يجب اختيار نوع الفاتورة
                            </div>
                            @error('invoicetype')
                                <div class="invalid-feedback d-flex align-items-center"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="position-relative bg-light p-4 rounded border mt-4">
                        <label for="invoiceimage" class="form-label fw-medium mb-3 d-flex align-items-center">
                            <i class="fas fa-image text-primary me-2"></i>
                            صورة الفاتورة
                        </label>
                        <div class="d-flex align-items-center justify-content-center w-100">
                            <label for="invoiceimage" class="d-flex flex-column align-items-center justify-content-center w-100 border border-2 border-dashed rounded p-3 bg-white" style="height: 9rem; cursor: pointer;">
                                <div class="d-flex flex-column align-items-center justify-content-center py-3">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 4rem; height: 4rem; background-color: rgba(var(--bs-primary-rgb), 0.1);">
                                        <i class="fas fa-cloud-upload-alt fs-3 text-primary"></i>
                                    </div>
                                    <p class="text-secondary fw-medium fs-6 mb-1">اسحب وأفلت الملف هنا أو انقر للتحميل</p>
                                    <p class="text-muted small">يمكنك رفع صورة بصيغة JPG, PNG, GIF بحجم أقصى 2 ميجابايت</p>
                                </div>
                                <input type="file" class="d-none" id="invoiceimage" name="invoiceimage" accept="image/*">
                            </label>
                        </div>
                        @error('invoiceimage')
                            <div class="text-danger small mt-2 d-flex align-items-center"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="position-relative mt-4">
                        <label for="invoicenote" class="form-label fw-medium d-flex align-items-center">
                            <i class="fas fa-sticky-note text-primary me-2"></i>
                            ملاحظات
                        </label>
                        <textarea class="form-control @error('invoicenote') is-invalid @enderror" 
                            id="invoicenote" name="invoicenote" rows="4" placeholder="أي ملاحظات إضافية ترغب في إضافتها">{{ old('invoicenote') }}</textarea>
                        @error('invoicenote')
                            <div class="invalid-feedback d-flex align-items-center"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center mt-5">
                        <button type="button" class="btn btn-primary btn-lg px-5 py-3 fw-bold d-flex align-items-center" id="submitBtn" onclick="submitInvoiceForm()">
                            <i class="fas fa-paper-plane me-2"></i>إرسال الفاتورة
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Contact Information Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="text-center mb-4">
                            <h2 class="h3 mb-3">تواصل معنا</h2>
                            <p class="text-muted">للاستفسارات أو المساعدة، يمكنك التواصل معنا عبر:</p>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                            <i class="fas fa-envelope text-primary fs-4"></i>
                                        </div>
                                        <h5 class="card-title">البريد الإلكتروني</h5>
                                        <p class="card-text">
                                            <a href="mailto:info@digitalhubegypt.com" class="text-decoration-none text-primary">
                                                info@digitalhubegypt.com
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                            <i class="fas fa-phone text-primary fs-4"></i>
                                        </div>
                                        <h5 class="card-title">الهاتف</h5>
                                        <p class="card-text">
                                            <a href="tel:+201066843185" class="text-decoration-none text-primary" dir="ltr">
                                                01066843185
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- No modal needed here as we're using SweetAlert2 -->
    </div>
</x-main-layout>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Bootstrap RTL CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">

<style>
    /* SweetAlert RTL support */
    .rtl-swal {
        direction: rtl;
        text-align: right;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    $(document).ready(function() {
        // Initialize AOS animation library
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Initialize Select2
        $('#invoicetype').select2({
            dir: "rtl",
            placeholder: "اختر نوع الفاتورة",
            allowClear: true
        });
        
        // File upload preview
        $('#invoiceimage').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Remove any existing preview
                    $('.file-preview').remove();
                    
                    const filePreview = `
                        <div class="mt-3 p-3 bg-light rounded d-flex align-items-center file-preview">
                            <div class="bg-white rounded d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 3rem; height: 3rem;">
                                <i class="fas fa-file-image text-primary fs-4"></i>
                            </div>
                            <div>
                                <p class="fw-medium mb-0">${file.name}</p>
                                <p class="small text-muted mb-0">${(file.size / 1024).toFixed(2)} KB</p>
                            </div>
                        </div>
                    `;
                    $('#invoiceimage').closest('.position-relative').append(filePreview);
                };
                reader.readAsDataURL(file);
            }
        });
        
        // File upload preview
        $('#invoiceimage').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Remove any existing preview
                    $('.file-preview').remove();
                    
                    const filePreview = `
                        <div class="mt-3 p-3 bg-light rounded d-flex align-items-center file-preview">
                            <div class="bg-white rounded d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 3rem; height: 3rem;">
                                <i class="fas fa-file-image text-primary fs-4"></i>
                            </div>
                            <div>
                                <p class="fw-medium mb-0">${file.name}</p>
                                <p class="small text-muted mb-0">${(file.size / 1024).toFixed(2)} KB</p>
                            </div>
                        </div>
                    `;
                    $('#invoiceimage').closest('.position-relative').append(filePreview);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush