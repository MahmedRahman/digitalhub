<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">عرض رأي العميل: {{ $testimonial->client_name }}</h2>
            <div>
                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-primary me-2">
                    <i class="fas fa-edit me-1"></i> تعديل
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right me-1"></i> العودة للقائمة
                </a>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">تفاصيل الرأي</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex">
                            <div class="fw-bold text-muted" style="width: 150px;">اسم العميل:</div>
                            <div>{{ $testimonial->client_name }}</div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="d-flex">
                            <div class="fw-bold text-muted" style="width: 150px;">التقييم:</div>
                            <div class="rating-display">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $testimonial->rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-muted"></i>
                                    @endif
                                @endfor
                                <span class="ms-2">({{ $testimonial->rating }} من 5)</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="d-flex">
                            <div class="fw-bold text-muted" style="width: 150px;">مكان العرض:</div>
                            <div>
                                @if($testimonial->display_location == 'home')
                                    الصفحة الرئيسية
                                @elseif($testimonial->display_location == 'course')
                                    صفحة الكورس
                                @elseif($testimonial->display_location == 'both')
                                    الصفحة الرئيسية وصفحة الكورس
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="d-flex">
                            <div class="fw-bold text-muted" style="width: 150px;">الكورس:</div>
                            <div>
                                @if($testimonial->course)
                                    {{ $testimonial->course->title }}
                                @else
                                    <span class="text-muted">غير محدد</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="d-flex">
                            <div class="fw-bold text-muted" style="width: 150px;">الحالة:</div>
                            <div>
                                @if($testimonial->is_active)
                                    <span class="badge bg-success">مفعل</span>
                                @else
                                    <span class="badge bg-danger">غير مفعل</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="d-flex">
                            <div class="fw-bold text-muted" style="width: 150px;">تاريخ الإنشاء:</div>
                            <div>{{ $testimonial->created_at->format('Y-m-d H:i') }}</div>
                        </div>
                    </div>
                    
                    <div class="col-12 mt-3">
                        <div class="fw-bold text-muted mb-2">التعليق:</div>
                        <div class="p-3 bg-light rounded">
                            {{ $testimonial->comment }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">تغيير حالة الرأي</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="client_name" value="{{ $testimonial->client_name }}">
                    <input type="hidden" name="comment" value="{{ $testimonial->comment }}">
                    <input type="hidden" name="rating" value="{{ $testimonial->rating }}">
                    <input type="hidden" name="display_location" value="{{ $testimonial->display_location }}">
                    <input type="hidden" name="course_id" value="{{ $testimonial->course_id }}">
                    
                    <div class="d-flex align-items-center">
                        <div class="form-check form-switch me-3">
                            <input class="form-check-input" type="checkbox" 
                                id="is_active" name="is_active" value="1" 
                                {{ $testimonial->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">تفعيل الرأي</label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="mt-4">
            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" 
                onsubmit="return confirm('هل أنت متأكد من حذف هذا الرأي؟');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-1"></i> حذف الرأي
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

@push('styles')
<style>
    .rating-display {
        direction: ltr;
        display: inline-block;
    }
</style>
@endpush
