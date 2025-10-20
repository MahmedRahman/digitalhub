<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">قائمة الفواتير</h2>
            <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>إضافة فاتورة جديدة
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">الاسم</th>
                                <th scope="col">الهاتف</th>
                                <th scope="col">البريد الإلكتروني</th>
                                <th scope="col">تاريخ الفاتورة</th>
                                <th scope="col">القيمة</th>
                                <th scope="col">النوع</th>
                                <th scope="col">الحالة</th>
                                <th scope="col">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->name }}</td>
                                    <td>{{ $invoice->phone }}</td>
                                    <td>{{ $invoice->email }}</td>
                                    <td>{{ $invoice->invoicetime->format('Y-m-d H:i') }}</td>
                                    <td>{{ round($invoice->invoicevalue) }} ج.م</td>
                                    <td>{{ $invoice->invoicetype }}</td>
                                    <td>
                                        <span class="badge rounded-pill 
                                            @if($invoice->status == 'approved') bg-success
                                            @elseif($invoice->status == 'rejected') bg-danger
                                            @else bg-warning @endif">
                                            @if($invoice->status == 'approved') تم الموافقة
                                            @elseif($invoice->status == 'rejected') مرفوض
                                            @else قيد الانتظار @endif
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه الفاتورة؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">لا توجد فواتير حتى الآن</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $invoices->links() }}
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
