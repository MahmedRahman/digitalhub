<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="card">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">إضافة درس جديد</h1>
                <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-right ml-2"></i>
                    العودة للدورة
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.lessons.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    <div class="row">
                        <div class="col-md-8">
                            <!-- Title Field -->
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold" for="title">عنوان الدرس<span class="text-danger">*</span></label>
                                <input type="text" 
                                    class="form-control @error('title') is-invalid @enderror" 
                                    id="title" 
                                    name="title" 
                                    value="{{ old('title') }}" 
                                    required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description Field -->
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold" for="description">وصف الدرس</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                    id="description" 
                                    name="description" 
                                    rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Content Field -->
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold" for="content">محتوى الدرس<span class="text-danger">*</span></label>
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                    id="content" 
                                    name="content" 
                                    rows="6" 
                                    required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">معلومات إضافية</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Video URL Field -->
                                    <div class="form-group mb-4">
                                        <label class="form-label fw-bold" for="video_url">رابط الفيديو</label>
                                        <input type="url" 
                                            class="form-control @error('video_url') is-invalid @enderror" 
                                            id="video_url" 
                                            name="video_url" 
                                            value="{{ old('video_url') }}">
                                        @error('video_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Video Duration Field -->
                                    <div class="form-group mb-4">
                                        <label class="form-label fw-bold" for="video_duration">مدة الفيديو (بالدقائق)</label>
                                        <input type="number" 
                                            class="form-control @error('video_duration') is-invalid @enderror" 
                                            id="video_duration" 
                                            name="video_duration" 
                                            value="{{ old('video_duration') }}" 
                                            min="1">
                                        @error('video_duration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Order Field -->
                                    <div class="form-group mb-4">
                                        <label class="form-label fw-bold" for="order">ترتيب الدرس<span class="text-danger">*</span></label>
                                        <input type="number" 
                                            class="form-control @error('order') is-invalid @enderror" 
                                            id="order" 
                                            name="order" 
                                            value="{{ old('order', $nextOrder) }}" 
                                            required 
                                            min="1">
                                        @error('order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Checkboxes -->
                                    <div class="form-group mb-3">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" 
                                                class="form-check-input" 
                                                id="is_free" 
                                                name="is_free" 
                                                {{ old('is_free') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_free">درس مجاني</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" 
                                                class="form-check-input" 
                                                id="is_published" 
                                                name="is_published" 
                                                {{ old('is_published') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_published">نشر الدرس</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-save ml-2"></i>
                            حفظ الدرس
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Add Bootstrap form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    @endpush
</x-app-layout>
