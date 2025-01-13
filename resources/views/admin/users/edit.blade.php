<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary me-3">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <h2 class="fw-bold mb-0">تعديل المستخدم</h2>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.users.update', $user) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2 text-primary"></i>الاسم
                                    </label>
                                    <input id="name" 
                                           type="text" 
                                           name="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $user->name) }}" 
                                           required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2 text-primary"></i>البريد الإلكتروني
                                    </label>
                                    <input id="email" 
                                           type="email" 
                                           name="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $user->email) }}" 
                                           required />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone me-2 text-primary"></i>رقم الهاتف
                                    </label>
                                    <input id="phone" 
                                           type="tel" 
                                           name="phone" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           value="{{ old('phone', $user->phone) }}" 
                                           required />
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- User Type -->
                                <div class="col-md-6 mb-3">
                                    <label for="type" class="form-label">
                                        <i class="fas fa-user-shield me-2 text-primary"></i>نوع المستخدم
                                    </label>
                                    <select id="type" 
                                            name="type" 
                                            class="form-select @error('type') is-invalid @enderror" 
                                            required>
                                        <option value="">اختر نوع المستخدم</option>
                                        <option value="user" {{ (old('type', $user->type) === 'user') ? 'selected' : '' }}>مستخدم عادي</option>
                                        <option value="admin" {{ (old('type', $user->type) === 'admin') ? 'selected' : '' }}>مدير</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2 text-primary"></i>كلمة المرور الجديدة
                                    </label>
                                    <div class="input-group">
                                        <input id="password" 
                                               type="password" 
                                               name="password" 
                                               class="form-control @error('password') is-invalid @enderror" />
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">اتركها فارغة إذا كنت لا تريد تغيير كلمة المرور</small>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6 mb-4">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock me-2 text-primary"></i>تأكيد كلمة المرور الجديدة
                                    </label>
                                    <div class="input-group">
                                        <input id="password_confirmation" 
                                               type="password" 
                                               name="password_confirmation" 
                                               class="form-control" />
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i>حفظ التغييرات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const type = input.type === 'password' ? 'text' : 'password';
            input.type = type;
            
            const icon = event.currentTarget.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    </script>
</x-app-layout>
