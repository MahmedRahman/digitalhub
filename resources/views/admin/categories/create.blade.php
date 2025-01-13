<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary me-3">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <h2 class="fw-bold mb-0">إضافة تصنيف جديد</h2>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.categories.store') }}">
                            @csrf

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-folder me-2 text-primary"></i>اسم التصنيف
                                        <span class="text-danger">*</span>
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

                                <!-- Slug -->
                                <div class="col-md-6 mb-3">
                                    <label for="slug" class="form-label">
                                        <i class="fas fa-link me-2 text-primary"></i>Slug
                                    </label>
                                    <input id="slug" 
                                           type="text" 
                                           name="slug" 
                                           class="form-control @error('slug') is-invalid @enderror" 
                                           value="{{ old('slug') }}" />
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">إذا تركت هذا الحقل فارغاً، سيتم إنشاؤه تلقائياً من اسم التصنيف</div>
                                </div>

                                <!-- Description -->
                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">
                                        <i class="fas fa-align-left me-2 text-primary"></i>الوصف
                                    </label>
                                    <textarea id="description" 
                                              name="description" 
                                              class="form-control @error('description') is-invalid @enderror" 
                                              rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Icon -->
                                <div class="col-md-4 mb-3">
                                    <label for="icon" class="form-label">
                                        <i class="fas fa-icons me-2 text-primary"></i>الأيقونة
                                    </label>
                                    <div class="input-group">
                                        <input id="icon" 
                                               type="text" 
                                               name="icon" 
                                               class="form-control @error('icon') is-invalid @enderror" 
                                               value="{{ old('icon') }}"
                                               placeholder="مثال: home, user, folder"
                                               autocomplete="off">
                                        <span class="input-group-text">
                                            <i class="fas fa-{{ old('icon', 'icons') }}"></i>
                                        </span>
                                    </div>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">أدخل اسم الأيقونة من Font Awesome. مثال: home, user, folder</div>
                                </div>

                                <!-- Sort Order -->
                                <div class="col-md-4 mb-3">
                                    <label for="sort_order" class="form-label">
                                        <i class="fas fa-sort-numeric-down me-2 text-primary"></i>ترتيب العرض
                                    </label>
                                    <input id="sort_order" 
                                           type="number" 
                                           name="sort_order" 
                                           class="form-control @error('sort_order') is-invalid @enderror" 
                                           value="{{ old('sort_order', 0) }}" />
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="col-md-4 mb-3">
                                    <label for="is_active" class="form-label">
                                        <i class="fas fa-toggle-on me-2 text-primary"></i>الحالة
                                    </label>
                                    <select id="is_active" 
                                            name="is_active" 
                                            class="form-select @error('is_active') is-invalid @enderror">
                                        <option value="1" {{ old('is_active', '1') === '1' ? 'selected' : '' }}>نشط</option>
                                        <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>غير نشط</option>
                                    </select>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
</x-app-layout>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const iconInput = document.getElementById('icon');
        const iconPreview = iconInput.nextElementSibling.querySelector('i');

        iconInput.addEventListener('input', function() {
            const iconName = this.value.trim() || 'icons';
            iconPreview.className = `fas fa-${iconName}`;
        });
    });
</script>
@endpush
