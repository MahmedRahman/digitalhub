<x-guest-layout>
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4 class="text-center mb-4 fw-bold">إنشاء حساب جديد</h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">
                        <i class="fas fa-user me-2 text-primary"></i>الاسم
                    </label>
                    <input id="name" 
                           type="text" 
                           name="name" 
                           class="form-control" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger small" />
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2 text-primary"></i>البريد الإلكتروني
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           class="form-control" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label for="phone" class="form-label">
                        <i class="fas fa-phone me-2 text-primary"></i>رقم الهاتف
                    </label>
                    <input id="phone" 
                           type="tel" 
                           name="phone" 
                           class="form-control" 
                           value="{{ old('phone') }}" 
                           required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2 text-danger small" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2 text-primary"></i>كلمة المرور
                    </label>
                    <div class="input-group">
                        <input id="password" 
                               type="password"
                               name="password"
                               class="form-control"
                               required 
                               autocomplete="new-password" />
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-lock me-2 text-primary"></i>تأكيد كلمة المرور
                    </label>
                    <div class="input-group">
                        <input id="password_confirmation" 
                               type="password"
                               name="password_confirmation" 
                               class="form-control"
                               required 
                               autocomplete="new-password" />
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger small" />
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary py-2">
                        <i class="fas fa-user-plus me-2"></i>إنشاء الحساب
                    </button>
                </div>

                <div class="mt-4 text-center">
                    <p class="mb-0">لديك حساب بالفعل؟ 
                        <a href="{{ route('login') }}" class="text-decoration-none">تسجيل الدخول</a>
                    </p>
                </div>
            </form>
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
</x-guest-layout>
