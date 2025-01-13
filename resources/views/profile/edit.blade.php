<x-app-layout>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold mb-4">الملف الشخصي</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <!-- Profile Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">المعلومات الشخصية</h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">تحديث كلمة المرور</h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="card border-danger">
                    <div class="card-header bg-danger bg-opacity-10 text-danger">
                        <h5 class="card-title mb-0">حذف الحساب</h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- User Stats -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-4 d-inline-block">
                                <i class="fas fa-user-circle fa-4x text-primary"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold">{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                        <hr>
                        <div class="row g-3">
                            <div class="col-4">
                                <div class="border rounded p-2">
                                    <h6 class="mb-1">0</h6>
                                    <small class="text-muted">الدورات</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border rounded p-2">
                                    <h6 class="mb-1">0</h6>
                                    <small class="text-muted">الشهادات</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border rounded p-2">
                                    <h6 class="mb-1">0%</h6>
                                    <small class="text-muted">الإنجاز</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">روابط سريعة</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-graduation-cap me-2 text-primary"></i>دوراتي
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-certificate me-2 text-primary"></i>شهاداتي
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-bell me-2 text-primary"></i>الإشعارات
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
