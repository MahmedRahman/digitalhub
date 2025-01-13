<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-4">
            <label for="name" class="form-label fw-bold">
                <i class="fas fa-user me-2 text-primary"></i>الاسم
            </label>
            <input id="name" 
                   name="name" 
                   type="text" 
                   class="form-control"
                   value="{{ old('name', $user->name) }}" 
                   required 
                   autofocus 
                   autocomplete="name" />
            <x-input-error class="mt-2 text-danger small" :messages="$errors->get('name')" />
        </div>

        <div class="mb-4">
            <label for="email" class="form-label fw-bold">
                <i class="fas fa-envelope me-2 text-primary"></i>البريد الإلكتروني
            </label>
            <input id="email" 
                   name="email" 
                   type="email" 
                   class="form-control"
                   value="{{ old('email', $user->email) }}" 
                   required 
                   autocomplete="username" />
            <x-input-error class="mt-2 text-danger small" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm mt-2 text-muted">
                        البريد الإلكتروني غير مؤكد.
                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                            اضغط هنا لإعادة إرسال رسالة التأكيد
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success small">
                            تم إرسال رابط تأكيد جديد إلى بريدك الإلكتروني
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label for="phone" class="form-label fw-bold">
                <i class="fas fa-phone me-2 text-primary"></i>رقم الهاتف
            </label>
            <input id="phone" 
                   name="phone" 
                   type="tel" 
                   class="form-control"
                   value="{{ old('phone', $user->phone) }}" 
                   required />
            <x-input-error class="mt-2 text-danger small" :messages="$errors->get('phone')" />
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>حفظ التغييرات
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-success mb-0">
                    <i class="fas fa-check-circle me-1"></i>تم الحفظ
                </p>
            @endif
        </div>
    </form>
</section>
