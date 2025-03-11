<x-app-layout>
    <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
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
                                <input type="file" 
                                       name="image" 
                                       id="courseImage"
                                       class="form-control @error('image') is-invalid @enderror" 
                                       accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="imagePreview" class="mt-2 d-none">
                                    <img src="#" alt="Course Image Preview" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">الفيديو الترويجي</label>
                                <div class="card p-3">
                                    <div class="mb-3">
                                        <input type="text" 
                                               class="form-control @error('promotional_video') is-invalid @enderror" 
                                               name="promotional_video" 
                                               value="{{ old('promotional_video') }}"
                                               placeholder="ضع رابط الفيديو الخارجي">
                                        <div class="form-text">قم بنسخ رابط الفيديو من يوتيوب أو أي مصدر خارجي</div>
                                    </div>
                                    @error('promotional_video')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
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
                            @error('instructor_id')
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
                            <label class="form-label fw-bold">المستوى <span class="text-danger">*</span></label>
                            <select class="form-select @error('level') is-invalid @enderror" name="level" required>
                                <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                                <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                                <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>متقدم</option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">حالة النشر <span class="text-danger">*</span></label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="statusSwitch" 
                                       onchange="document.getElementById('statusInput').value = this.checked ? 'published' : 'draft'"
                                       {{ old('status', 'published') == 'published' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusSwitch">نشر الدورة</label>
                            </div>
                            <input type="hidden" id="statusInput" name="status" value="{{ old('status', 'published') }}">
                            @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
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
        /* Custom styles for the course creation form */
    </style>
    @endpush

    @push('scripts')
    <script>
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });

        document.getElementById('courseImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.querySelector('img').src = e.target.result;
                    preview.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    @endpush
</x-app-layout>
