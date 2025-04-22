<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">إضافة رأيك في الخدمة</h3>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('testimonials.submit') }}" method="POST" id="testimonialForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="client_name" class="form-label">الاسم <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('client_name') is-invalid @enderror" 
                                        id="client_name" name="client_name" value="{{ old('client_name') }}" required>
                                    @error('client_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label for="rating" class="form-label">تقييمك للخدمة <span class="text-danger">*</span></label>
                                    <div class="rating-input text-center mb-3">
                                        <div class="rating-stars d-flex justify-content-center">
                                            @for($i = 5; $i >= 1; $i--)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="rating" 
                                                        id="rating{{ $i }}" value="{{ $i }}" 
                                                        {{ old('rating', 5) == $i ? 'checked' : '' }}>
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
                                    <label for="comment" class="form-label">رأيك وتعليقك <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('comment') is-invalid @enderror" 
                                        id="comment" name="comment" rows="4" required>{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                @if(isset($course))
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <input type="hidden" name="display_location" value="course">
                                @else
                                <input type="hidden" name="display_location" value="home">
                                @endif
                            </div>
                            
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>إرسال رأيك
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
<style>
    .rating-stars {
        direction: ltr;
    }
    .rating-input {
        direction: ltr;
    }
    .form-check-inline {
        margin-left: 1rem;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Highlight stars on hover
        $('.rating-stars .form-check-label').hover(
            function() {
                const stars = $(this).find('.fa-star');
                stars.addClass('text-warning');
                $(this).prevAll().find('.fa-star').addClass('text-warning');
            },
            function() {
                if (!$(this).prev('input').prop('checked')) {
                    const stars = $(this).find('.fa-star');
                    stars.removeClass('text-warning');
                    $(this).prevAll().find('.fa-star').removeClass('text-warning');
                }
            }
        );
    });
</script>
@endpush
