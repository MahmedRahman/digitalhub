<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary me-3">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <h2 class="fw-bold mb-0">إضافة مستخدم جديد</h2>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf

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
                                           value="{{ old('name') }}" 
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
                                           value="{{ old('email') }}" 
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
                                           value="{{ old('phone') }}" 
                                           required 
                                           dir="ltr" />
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
                                        <option value="student" {{ old('type') === 'student' ? 'selected' : '' }}>طالب</option>
                                        <option value="instructor" {{ old('type') === 'instructor' ? 'selected' : '' }}>محاضر</option>
                                        <option value="admin" {{ old('type') === 'admin' ? 'selected' : '' }}>مدير</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2 text-primary"></i>كلمة المرور
                                    </label>
                                    <div class="input-group">
                                        <input id="password" 
                                               type="password" 
                                               name="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               required />
                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary" onclick="generatePassword()">
                                            <i class="fas fa-key"></i> توليد
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password Confirmation -->
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock me-2 text-primary"></i>تأكيد كلمة المرور
                                    </label>
                                    <div class="input-group">
                                        <input id="password_confirmation" 
                                               type="password" 
                                               name="password_confirmation" 
                                               class="form-control" 
                                               required />
                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i>حفظ
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
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }

        function generatePassword() {
            const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const lowercase = 'abcdefghijklmnopqrstuvwxyz';
            const numbers = '0123456789';
            const symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?';
            
            const length = 12;
            let password = '';
            
            password += uppercase[Math.floor(Math.random() * uppercase.length)];
            password += lowercase[Math.floor(Math.random() * lowercase.length)];
            password += numbers[Math.floor(Math.random() * numbers.length)];
            password += symbols[Math.floor(Math.random() * symbols.length)];
            
            const allChars = uppercase + lowercase + numbers + symbols;
            for (let i = password.length; i < length; i++) {
                password += allChars[Math.floor(Math.random() * allChars.length)];
            }
            
            password = password.split('').sort(() => Math.random() - 0.5).join('');
            
            document.getElementById('password').value = password;
            document.getElementById('password_confirmation').value = password;
            
            document.getElementById('password').type = 'text';
            document.getElementById('password_confirmation').type = 'text';
            
            showPasswordAlert(password);
        }

        function showPasswordAlert(password) {
            const alert = document.createElement('div');
            alert.className = 'alert alert-success alert-dismissible fade show mt-3';
            alert.innerHTML = `
                <strong>تم توليد كلمة مرور جديدة!</strong>
                <br>
                <span class="text-monospace">${password}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            
            const form = document.querySelector('form');
            form.insertBefore(alert, form.firstChild);
            
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }
    </script>
</x-app-layout>
