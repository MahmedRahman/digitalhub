<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mb-4">
            <label for="current_password" class="form-label fw-bold">
                <i class="fas fa-lock me-2 text-primary"></i>كلمة المرور الحالية
            </label>
            <div class="input-group">
                <input id="current_password"
                       name="current_password"
                       type="password"
                       class="form-control"
                       autocomplete="current-password" />
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger small" />
        </div>

        <div class="mb-4">
            <label for="password" class="form-label fw-bold">
                <i class="fas fa-key me-2 text-primary"></i>كلمة المرور الجديدة
            </label>
            <div class="input-group">
                <input id="password"
                       name="password"
                       type="password"
                       class="form-control"
                       autocomplete="new-password" />
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger small" />
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-bold">
                <i class="fas fa-check-double me-2 text-primary"></i>تأكيد كلمة المرور
            </label>
            <div class="input-group">
                <input id="password_confirmation"
                       name="password_confirmation"
                       type="password"
                       class="form-control"
                       autocomplete="new-password" />
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger small" />
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>تحديث كلمة المرور
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-success mb-0">
                    <i class="fas fa-check-circle me-1"></i>تم التحديث
                </p>
            @endif
        </div>
    </form>

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
</section>
