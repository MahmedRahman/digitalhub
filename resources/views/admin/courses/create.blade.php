<x-app-layout>
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">إضافة دورة جديدة</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">الدورات</a></li>
                            <li class="breadcrumb-item active">إضافة دورة</li>
                        </ol>
                    </nav>
                </div>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-dark">
                    <i class="fas fa-times me-1"></i>
                    إلغاء
                </a>
            </div>
        </div>

        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Basic Info -->
                    <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
                        <h5 class="border-bottom pb-3 mb-4">المعلومات الأساسية</h5>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">عنوان الدورة <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="أدخل عنوان الدورة"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">وصف الدورة <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="اكتب وصفاً مختصراً للدورة"
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">متطلبات الدورة</label>
                            <textarea class="form-control @error('requirements') is-invalid @enderror" 
                                      name="requirements" 
                                      rows="4"
                                      placeholder="ما هي المتطلبات السابقة للدورة؟">{{ old('requirements') }}</textarea>
                            @error('requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold">ماذا سيتعلم الطلاب؟</label>
                            <textarea class="form-control @error('what_you_will_learn') is-invalid @enderror" 
                                      name="what_you_will_learn" 
                                      rows="4"
                                      placeholder="اكتب النقاط الرئيسية التي سيتعلمها الطلاب">{{ old('what_you_will_learn') }}</textarea>
                            @error('what_you_will_learn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Media -->
                    <div class="bg-white rounded-3 shadow-sm p-4">
                        <h5 class="border-bottom pb-3 mb-4">الوسائط</h5>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">صورة الدورة</label>
                                <div class="drop-zone rounded-3 bg-light p-4 text-center cursor-pointer">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                    <p class="mb-0 text-muted small">اسحب الصورة هنا أو اضغط للاختيار</p>
                                    <input type="file" 
                                           class="form-control d-none @error('image') is-invalid @enderror" 
                                           name="image" 
                                           accept="image/*">
                                </div>
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">الفيديو الترويجي</label>
                                <div class="drop-zone rounded-3 bg-light p-4 text-center cursor-pointer">
                                    <i class="fas fa-film fa-2x text-muted mb-2"></i>
                                    <p class="mb-0 text-muted small">اسحب الفيديو هنا أو اضغط للاختيار</p>
                                    <input type="file" 
                                           class="form-control d-none @error('promotional_video') is-invalid @enderror" 
                                           name="promotional_video" 
                                           accept="video/*">
                                </div>
                                @error('promotional_video')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Course Settings -->
                    <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
                        <h5 class="border-bottom pb-3 mb-4">إعدادات الدورة</h5>

                        <div class="mb-4">
                            <label class="form-label fw-bold">القسم <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    name="category_id" 
                                    required>
                                <option value="">اختر القسم</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">المدربين <span class="text-danger">*</span></label>
                            <select class="form-select select2 @error('instructor_ids') is-invalid @enderror" 
                                    name="instructor_ids[]" 
                                    multiple 
                                    required>
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}" 
                                            {{ (is_array(old('instructor_ids')) && in_array($instructor->id, old('instructor_ids'))) ? 'selected' : '' }}>
                                        {{ $instructor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('instructor_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">السعر <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">ج.م</span>
                                <input type="number" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       name="price" 
                                       value="{{ old('price', 0) }}" 
                                       step="0.01" 
                                       required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <label class="form-label fw-bold">المدة (أسابيع)</label>
                                <input type="number" 
                                       class="form-control @error('duration_in_weeks') is-invalid @enderror" 
                                       name="duration_in_weeks" 
                                       value="{{ old('duration_in_weeks', 1) }}" 
                                       min="1">
                                @error('duration_in_weeks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label fw-bold">عدد المحاضرات</label>
                                <input type="number" 
                                       class="form-control @error('lectures_count') is-invalid @enderror" 
                                       name="lectures_count" 
                                       value="{{ old('lectures_count', 1) }}" 
                                       min="1">
                                @error('lectures_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">المستوى</label>
                            <select class="form-select @error('level') is-invalid @enderror" name="level">
                                <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                                <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                                <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>متقدم</option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">اللغة</label>
                            <select class="form-select @error('language') is-invalid @enderror" name="language">
                                <option value="arabic" {{ old('language') == 'arabic' ? 'selected' : '' }}>العربية</option>
                                <option value="english" {{ old('language') == 'english' ? 'selected' : '' }}>الإنجليزية</option>
                            </select>
                            @error('language')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">حالة النشر</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="status" 
                                       value="published" 
                                       id="statusSwitch" 
                                       {{ old('status') == 'published' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusSwitch">نشر الدورة</label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-white rounded-3 shadow-sm p-4">
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-save me-1"></i>
                            حفظ الدورة
                        </button>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-link text-muted w-100">
                            إلغاء
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('styles')
    <style>
        .drop-zone {
            border: 2px dashed #dee2e6;
            transition: all 0.3s ease;
        }
        .drop-zone:hover {
            border-color: #6c757d;
            background-color: #f8f9fa !important;
        }
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });

        // File Upload Preview
        document.querySelectorAll('.drop-zone').forEach(zone => {
            const input = zone.querySelector('input');
            
            zone.addEventListener('click', () => input.click());
            
            zone.addEventListener('dragover', e => {
                e.preventDefault();
                zone.classList.add('bg-light');
            });
            
            zone.addEventListener('dragleave', () => {
                zone.classList.remove('bg-light');
            });
            
            zone.addEventListener('drop', e => {
                e.preventDefault();
                input.files = e.dataTransfer.files;
                updateThumbnail(input, zone);
            });
            
            input.addEventListener('change', () => {
                updateThumbnail(input, zone);
            });
        });

        function updateThumbnail(input, zone) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = e => {
                    if (input.accept.includes('image')) {
                        zone.innerHTML = `
                            <img src="${e.target.result}" class="img-fluid rounded mb-2" style="max-height: 150px">
                            <p class="mb-0 text-muted small">انقر لتغيير الصورة</p>
                        `;
                    } else {
                        zone.innerHTML = `
                            <i class="fas fa-file-video fa-2x text-primary mb-2"></i>
                            <p class="mb-0 text-muted small">${input.files[0].name}</p>
                        `;
                    }
                };
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
</x-app-layout>
