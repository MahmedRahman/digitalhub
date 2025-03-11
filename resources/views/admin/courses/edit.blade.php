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
                    <h2 class="mb-1">تعديل الدورة</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">الدورات</a></li>
                            <li class="breadcrumb-item active">{{ $course->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-primary">
                        <i class="fas fa-book-open me-1"></i>
                        عرض الدروس
                    </a>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-dark">
                        <i class="fas fa-times me-1"></i>
                        إلغاء
                    </a>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                   value="{{ old('title', $course->title) }}" 
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
                                      required>{{ old('description', $course->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">متطلبات الدورة</label>
                            <textarea class="form-control @error('requirements') is-invalid @enderror" 
                                      name="requirements" 
                                      rows="4"
                                      placeholder="ما هي المتطلبات السابقة للدورة؟">{{ old('requirements', $course->requirements) }}</textarea>
                            @error('requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold">ماذا سيتعلم الطلاب؟</label>
                            <textarea class="form-control @error('what_you_will_learn') is-invalid @enderror" 
                                      name="what_you_will_learn" 
                                      rows="4"
                                      placeholder="اكتب النقاط الرئيسية التي سيتعلمها الطلاب">{{ old('what_you_will_learn', $course->what_you_will_learn) }}</textarea>
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
                                <div class="card p-3">
                                    @if($course->image)
                                        <img src="{{ $course->image_url }}" 
                                             alt="{{ $course->title }}" 
                                             class="img-fluid rounded mb-3" 
                                             style="max-height: 150px">
                                    @endif
                                    <div class="mb-3">
                                        <input type="file" 
                                               class="form-control @error('image') is-invalid @enderror" 
                                               name="image" 
                                               accept="image/*">
                                        <div class="form-text">اختر صورة للدورة (JPG, PNG, GIF)</div>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">رابط الفيديو الترويجي</label>
                                <div class="card p-3">
                                    @if($course->promotional_video)
                                        <div class="ratio ratio-16x9 mb-3">
                                            <iframe 
                                                src="{{ $course->promotional_video }}" 
                                                title="فيديو ترويجي للدورة"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <input type="text" 
                                               class="form-control @error('promotional_video') is-invalid @enderror" 
                                               name="promotional_video" 
                                               value="{{ old('promotional_video', $course->promotional_video) }}"
                                               placeholder="ضع رابط الفيديو من جوجل درايف">
                                        <div class="form-text">قم بنسخ رابط الفيديو من جوجل درايف</div>
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
                                            {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
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
                                            {{ (is_array(old('instructor_ids', $selectedInstructors)) && in_array($instructor->id, old('instructor_ids', $selectedInstructors))) ? 'selected' : '' }}>
                                        {{ $instructor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('instructor_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">المدة (أسابيع) <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('duration_in_weeks') is-invalid @enderror" 
                                   name="duration_in_weeks" 
                                   value="{{ old('duration_in_weeks', $course->duration_in_weeks) }}"
                                   placeholder="مثال: 12 أسبوع"
                                   required>
                            @error('duration_in_weeks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">عدد المحاضرات <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('lectures_count') is-invalid @enderror" 
                                   name="lectures_count" 
                                   value="{{ old('lectures_count', $course->lectures_count) }}"
                                   placeholder="مثال: 24 محاضرة"
                                   required>
                            @error('lectures_count')
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
                                       value="{{ old('price', $course->price) }}" 
                                       step="0.01" 
                                       required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">المستوى</label>
                            <select class="form-select @error('level') is-invalid @enderror" name="level">
                                <option value="beginner" {{ old('level', $course->level) == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                                <option value="intermediate" {{ old('level', $course->level) == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                                <option value="advanced" {{ old('level', $course->level) == 'advanced' ? 'selected' : '' }}>متقدم</option>
                            </select>
                            @error('level')
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
                                       {{ old('status', $course->status) == 'published' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusSwitch">نشر الدورة</label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-white rounded-3 shadow-sm p-4">
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-save me-1"></i>
                            حفظ التغييرات
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
            position: relative;
            border: 2px dashed #dee2e6;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .drop-zone:hover {
            border-color: #6c757d;
            background-color: #f8f9fa !important;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropZones = document.querySelectorAll('.drop-zone');
            
            dropZones.forEach(zone => {
                const input = zone.querySelector('input[type="file"]');
                const preview = zone.querySelector('img') || document.createElement('img');
                preview.classList.add('img-fluid', 'rounded', 'mb-2');
                preview.style.maxHeight = '150px';
                preview.style.display = 'none';
                
                if (!zone.querySelector('img')) {
                    zone.insertBefore(preview, zone.firstChild);
                }
                
                input.addEventListener('change', function(e) {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            zone.querySelector('.fa-cloud-upload-alt')?.style.setProperty('display', 'none');
                        }
                        reader.readAsDataURL(file);
                    }
                });
                
                zone.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.style.borderColor = '#6c757d';
                    this.style.backgroundColor = '#f8f9fa';
                });
                
                zone.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.style.borderColor = '#dee2e6';
                    this.style.backgroundColor = '#f8f9fa';
                });
                
                zone.addEventListener('drop', function(e) {
                    e.preventDefault();
                    const file = e.dataTransfer.files[0];
                    if (file && file.type.startsWith('image/')) {
                        input.files = e.dataTransfer.files;
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            zone.querySelector('.fa-cloud-upload-alt')?.style.setProperty('display', 'none');
                        }
                        reader.readAsDataURL(file);
                    }
                    this.style.borderColor = '#dee2e6';
                    this.style.backgroundColor = '#f8f9fa';
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
