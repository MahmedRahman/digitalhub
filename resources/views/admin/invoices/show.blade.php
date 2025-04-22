<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-0">تفاصيل الفاتورة</h2>
                <p class="text-muted">عرض تفاصيل الفاتورة #{{ $invoice->id }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>تعديل
                </a>
                <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right me-2"></i>رجوع للقائمة
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">معلومات الفاتورة</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Invoice Details -->
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-medium">رقم الفاتورة:</span>
                                            <span>{{ $invoice->id }}</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-medium">تاريخ الفاتورة:</span>
                                            <span>{{ $invoice->invoicetime->format('Y-m-d H:i') }}</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-medium">قيمة الفاتورة:</span>
                                            <span>{{ number_format($invoice->invoicevalue, 2) }} ج.م</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-medium">نوع الفاتورة:</span>
                                            <span>
                                                @if($invoice->invoicetype == 'course') كورس
                                                @elseif($invoice->invoicetype == 'subscription') اشتراك
                                                @elseif($invoice->invoicetype == 'service') خدمة
                                                @else أخرى
                                                @endif
                                            </span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-medium">حالة الفاتورة:</span>
                                            <span class="badge rounded-pill 
                                                @if($invoice->status == 'approved') bg-success
                                                @elseif($invoice->status == 'rejected') bg-danger
                                                @else bg-warning @endif">
                                                @if($invoice->status == 'approved') تم الموافقة
                                                @elseif($invoice->status == 'rejected') مرفوض
                                                @else قيد الانتظار @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Details -->
                            <div class="col-md-6">
                                <h5 class="card-title mb-3">معلومات العميل</h5>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">الاسم:</span>
                                        <span>{{ $invoice->name }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">رقم الهاتف:</span>
                                        <span>{{ $invoice->phone }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">البريد الإلكتروني:</span>
                                        <span>{{ $invoice->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Update Form -->
                        <div class="mt-4 pt-3 border-top">
                            <h5 class="card-title mb-3">تحديث حالة الفاتورة</h5>
                            <form action="#" method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select">
                                    <option value="pending" {{ $invoice->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                    <option value="approved" {{ $invoice->status == 'approved' ? 'selected' : '' }}>تمت الموافقة</option>
                                    <option value="rejected" {{ $invoice->status == 'rejected' ? 'selected' : '' }}>مرفوضة</option>
                                </select>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>تحديث
                                </button>
                            </form>
                        </div>

                        <!-- Invoice Notes -->
                        @if($invoice->invoicenote)
                        <div class="mt-4 pt-3 border-top">
                            <h5 class="card-title mb-3">ملاحظات</h5>
                            <div class="bg-light p-3 rounded">
                                {{ $invoice->invoicenote }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Invoice Image -->
            <div class="col-md-4">
                @if($invoice->invoiceimage)
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">صورة الفاتورة</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $invoice->invoiceimage) }}" alt="صورة الفاتورة" class="img-fluid rounded">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
