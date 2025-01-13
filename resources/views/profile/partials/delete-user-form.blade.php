<section class="space-y-6">
    <div class="alert alert-danger">
        <h5 class="alert-heading mb-3">
            <i class="fas fa-exclamation-triangle me-2"></i>تحذير
        </h5>
        <p class="mb-0">
            بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته بشكل نهائي. قبل حذف حسابك، يرجى تحميل أي بيانات أو معلومات ترغب في الاحتفاظ بها.
        </p>
    </div>

    <button type="button" 
            class="btn btn-danger" 
            data-bs-toggle="modal" 
            data-bs-target="#confirm-user-deletion">
        <i class="fas fa-trash-alt me-2"></i>حذف الحساب
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                @csrf
                @method('delete')

                <div class="modal-header border-danger">
                    <h5 class="modal-title text-danger" id="confirmUserDeletionLabel">
                        <i class="fas fa-exclamation-circle me-2"></i>هل أنت متأكد من حذف حسابك؟
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">
                        بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته بشكل نهائي. الرجاء إدخال كلمة المرور الخاصة بك لتأكيد رغبتك في حذف حسابك بشكل دائم.
                    </p>

                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <div class="input-group">
                            <input id="password"
                                   name="password"
                                   type="password"
                                   class="form-control"
                                   placeholder="كلمة المرور"
                                   required />
                            <button class="btn btn-outline-secondary" type="button" onclick="toggleDeletePassword()">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-danger small" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>إلغاء
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-2"></i>حذف الحساب
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleDeletePassword() {
            const input = document.getElementById('password');
            const type = input.type === 'password' ? 'text' : 'password';
            input.type = type;
            
            const icon = event.currentTarget.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    </script>
</section>
