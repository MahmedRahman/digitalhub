<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.hero-sections.index') }}" class="btn btn-outline-primary me-3">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <h2 class="fw-bold mb-0">تعديل البانر</h2>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.hero-sections.update', $heroSection) }}" 
                              method="POST" 
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">
                                        <i class="fas fa-heading me-2 text-primary"></i>العنوان
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $heroSection->title) }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">
                                        <i class="fas fa-align-left me-2 text-primary"></i>الوصف
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="3" 
                                              required>{{ old('description', $heroSection->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Button Text -->
                                <div class="col-md-6 mb-3">
                                    <label for="button_text" class="form-label">
                                        <i class="fas fa-mouse-pointer me-2 text-primary"></i>نص الزر
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('button_text') is-invalid @enderror" 
                                           id="button_text" 
                                           name="button_text" 
                                           value="{{ old('button_text', $heroSection->button_text) }}" 
                                           required>
                                    @error('button_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Button Link -->
                                <div class="col-md-6 mb-3">
                                    <label for="button_link" class="form-label">
                                        <i class="fas fa-link me-2 text-primary"></i>رابط الزر
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('button_link') is-invalid @enderror" 
                                           id="button_link" 
                                           name="button_link" 
                                           value="{{ old('button_link', $heroSection->button_link) }}" 
                                           required>
                                    @error('button_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Current Image -->
                                @if($heroSection->image)
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">الصورة الحالية</label>
                                        <div>
                                            <img src="{{ $heroSection->image_url }}" 
                                                 alt="Current Hero Image" 
                                                 class="rounded"
                                                 style="max-height: 200px;">
                                        </div>
                                    </div>
                                @endif

                                <!-- Image -->
                                <div class="col-md-12 mb-3">
                                    <label for="image" class="form-label">
                                        <i class="fas fa-image me-2 text-primary"></i>تغيير الصورة
                                    </label>
                                    <input type="file" 
                                           class="form-control @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image"
                                           accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">الأبعاد المثالية: 800×600 بكسل</div>
                                </div>

                                <!-- Sort Order -->
                                <div class="col-md-6 mb-3">
                                    <label for="sort_order" class="form-label">
                                        <i class="fas fa-sort-numeric-down me-2 text-primary"></i>الترتيب
                                    </label>
                                    <input type="number" 
                                           class="form-control @error('sort_order') is-invalid @enderror" 
                                           id="sort_order" 
                                           name="sort_order" 
                                           value="{{ old('sort_order', $heroSection->sort_order) }}">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Is Active -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label d-block">
                                        <i class="fas fa-toggle-on me-2 text-primary"></i>الحالة
                                    </label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1"
                                               {{ old('is_active', $heroSection->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">نشط</label>
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
</x-app-layout>
