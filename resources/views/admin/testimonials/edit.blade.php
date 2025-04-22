<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">تعديل رأي العميل: {{ $testimonial->client_name }}</h2>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right me-2"></i>العودة للقائمة
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="client_name" class="form-label">اسم العميل <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('client_name') is-invalid @enderror" 
                                id="client_name" name="client_name" value="{{ old('client_name', $testimonial->client_name) }}" required>
                            @error('client_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="rating" class="form-label">التقييم <span class="text-danger">*</span></label>
                            <div class="rating-input">
                                <div class="rating-stars d-flex">
                                    @for($i = 5; $i >= 1; $i--)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rating" 
                                                id="rating{{ $i }}" value="{{ $i }}" 
                                                {{ old('rating', $testimonial->rating) == $i ? 'checked' : '' }}>
                                            <label class="form-check-label" for="rating{{ $i }}">
                                                @for($j = 1; $j <= 5; $j++)
                                                    @if($j <= $i)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-muted"></i>
                                                    @endif
                                                @endfor
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            @error('rating')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="comment" class="form-label">التعليق <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" 
                                id="comment" name="comment" rows="4" required>{{ old('comment', $testimonial->comment) }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="display_location" class="form-label">مكان العرض <span class="text-danger">*</span></label>
                            <select class="form-select @error('display_location') is-invalid @enderror" 
                                id="display_location" name="display_location" required>
                                <option value="">اختر مكان العرض</option>
                                @foreach($displayLocations as $value => $label)
                                    <option value="{{ $value }}" {{ old('display_location', $testimonial->display_location) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('display_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="course_id" class="form-label">الكورس (مطلوب إذا كان مكان العرض هو صفحة الكورس)</label>
                            <select class="form-select select2 @error('course_id') is-invalid @enderror" 
                                id="course_id" name="course_id">
                                <option value="">اختر الكورس</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id', $testimonial->course_id) == $course->id ? 'selected' : '' }}>
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" 
                                    id="is_active" name="is_active" value="1" 
                                    {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">تفعيل الرأي</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-save me-1"></i> حفظ التغييرات
                        </button>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> إلغاء
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .rating-stars {
        direction: ltr;
    }
    .rating-input {
        direction: ltr;
        text-align: right;
    }
    .form-check-inline {
        margin-left: 1rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            dir: "rtl",
            placeholder: "اختر",
            allowClear: true
        });
        
        // Show/hide course field based on display location
        $('#display_location').on('change', function() {
            const val = $(this).val();
            if (val === 'course' || val === 'both') {
                $('#course_id').prop('required', true);
                $('#course_id').closest('.mb-3').find('label').html('الكورس <span class="text-danger">*</span>');
            } else {
                $('#course_id').prop('required', false);
                $('#course_id').closest('.mb-3').find('label').html('الكورس (مطلوب إذا كان مكان العرض هو صفحة الكورس)');
            }
        });
        
        // Trigger on page load
        $('#display_location').trigger('change');
    });
</script>
@endpush
