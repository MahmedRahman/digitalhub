<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">إضافة فاتورة جديدة</h2>
            <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right me-2"></i>رجوع للقائمة
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.invoices.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    
                    <div class="col-md-6">
                        <label for="name" class="form-label">الاسم <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">رقم الهاتف <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="invoicetime" class="form-label">تاريخ ووقت الفاتورة <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control @error('invoicetime') is-invalid @enderror" id="invoicetime" name="invoicetime" value="{{ old('invoicetime') ?? now()->format('Y-m-d\\TH:i') }}" required>
                        @error('invoicetime')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="invoicevalue" class="form-label">قيمة الفاتورة <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('invoicevalue') is-invalid @enderror" id="invoicevalue" name="invoicevalue" value="{{ old('invoicevalue') }}" step="0.01" min="0" required>
                            <span class="input-group-text">ج.م</span>
                            @error('invoicevalue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="invoicetype" class="form-label">نوع الفاتورة <span class="text-danger">*</span></label>
                        <select class="form-select @error('invoicetype') is-invalid @enderror" id="invoicetype" name="invoicetype" required>
                            <option value="">اختر نوع الفاتورة</option>
                            @foreach($invoiceTypes as $type)
                                <option value="{{ $type }}" {{ old('invoicetype') == $type ? 'selected' : '' }}>
                                    @if($type == 'course') كورس
                                    @elseif($type == 'subscription') اشتراك
                                    @elseif($type == 'service') خدمة
                                    @else أخرى
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('invoicetype')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="invoiceimage" class="form-label">صورة الفاتورة</label>
                        <input type="file" class="form-control @error('invoiceimage') is-invalid @enderror" id="invoiceimage" name="invoiceimage" accept="image/*">
                        <div class="form-text">يمكنك رفع صورة بصيغة JPG, PNG, GIF بحجم أقصى 2 ميجابايت</div>
                        @error('invoiceimage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="invoicenote" class="form-label">ملاحظات</label>
                        <textarea class="form-control @error('invoicenote') is-invalid @enderror" id="invoicenote" name="invoicenote" rows="3">{{ old('invoicenote') }}</textarea>
                        @error('invoicenote')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>إلغاء
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>حفظ الفاتورة
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    });
</script>
@endpush
