<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">تفاصيل رسالة الذكاء الاصطناعي</h2>
            <a href="{{ route('admin.ai-messages.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>العودة للقائمة
            </a>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-comment-dots me-2"></i>تفاصيل الرسالة
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">رقم الهاتف</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control" value="{{ $message->phone_number }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">تاريخ الرسالة</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="text" class="form-control" value="{{ $message->message_date->format('Y/m/d H:i:s') }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">سؤال العميل</label>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <p class="mb-0">{{ $message->client_question }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">رد الذكاء الاصطناعي</label>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <p class="mb-0">{{ $message->ai_response }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>معلومات إضافية
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-hashtag me-2"></i>معرف الرسالة</span>
                                <span class="badge bg-primary rounded-pill">{{ $message->id }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-clock me-2"></i>تاريخ الإنشاء</span>
                                <span>{{ $message->created_at->format('Y/m/d H:i') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-edit me-2"></i>آخر تحديث</span>
                                <span>{{ $message->updated_at->format('Y/m/d H:i') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <form action="{{ route('admin.ai-messages.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-2"></i>حذف الرسالة
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

@push('styles')
<style>
    .list-group-item {
        background-color: transparent;
    }
</style>
@endpush
