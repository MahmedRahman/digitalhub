<x-app-layout>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <!-- معلومات التسجيل -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">معلومات التسجيل</h5>
                        <a href="/admin/round-enrollments/{{ $enrollment->id }}/invoice" 
                           class="btn btn-primary" target="_blank">
                            <i class="fas fa-print"></i> طباعة الفاتورة
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>اسم الطالب</th>
                                <td>{{ $enrollment->user->name ?? 'غير معروف' }}</td>
                            </tr>
                            <tr>
                                <th>الدورة</th>
                                <td>{{ $enrollment->round->livecourse->name ?? 'غير معروف' }}</td>
                            </tr>
                            <tr>
                                <th>الجولة</th>
                                <td>{{ $enrollment->round->round_name ?? 'غير معروف' }}</td>
                            </tr>
                            <tr>
                                <th>السعر الكلي</th>
                                <td>{{ number_format($enrollment->total_price ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <th>المبلغ المدفوع</th>
                                <td>{{ number_format($enrollment->paid_amount ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <th>المبلغ المتبقي</th>
                                <td>{{ number_format($enrollment->remaining_amount ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <th>حالة الدفع</th>
                                <td>
                                    @php
                                        $statusClass = [
                                            'completed' => 'success',
                                            'partial' => 'warning',
                                            'pending' => 'danger'
                                        ][$enrollment->payment_status ?? 'pending'];
                                        
                                        $statusText = [
                                            'completed' => 'مكتمل',
                                            'partial' => 'جزئي',
                                            'pending' => 'معلق'
                                        ][$enrollment->payment_status ?? 'pending'];
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>حالة التسجيل</th>
                                <td>
                                    <form action="{{ route('admin.round-enrollments.update-status', $enrollment) }}" 
                                          method="POST" class="d-flex gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="enrollment_status" class="form-select form-select-sm">
                                            <option value="pending" {{ $enrollment->enrollment_status == 'pending' ? 'selected' : '' }}>معلق</option>
                                            <option value="approved" {{ $enrollment->enrollment_status == 'approved' ? 'selected' : '' }}>مقبول</option>
                                            <option value="rejected" {{ $enrollment->enrollment_status == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">تحديث</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- إضافة دفعة جديدة -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">إضافة دفعة جديدة</h5>
                    </div>
                    <div class="card-body">
                        @if($enrollment->remaining_amount > 0)
                            <form action="{{ route('admin.round-enrollments.add-payment', $enrollment) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="amount" class="form-label">المبلغ</label>
                                    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                           id="amount" name="amount" required max="{{ $enrollment->remaining_amount }}">
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">طريقة الدفع</label>
                                    <select class="form-select @error('payment_method') is-invalid @enderror" 
                                            id="payment_method" name="payment_method" required>
                                        <option value="cash">نقداً</option>
                                        <option value="bank_transfer">تحويل بنكي</option>
                                        <option value="other">أخرى</option>
                                    </select>
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="notes" class="form-label">ملاحظات</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">تسجيل الدفعة</button>
                            </form>
                        @else
                            <div class="alert alert-success">
                                تم سداد كامل المبلغ
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- سجل المدفوعات -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">سجل المدفوعات</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>التاريخ</th>
                                        <th>المبلغ</th>
                                        <th>طريقة الدفع</th>
                                        <th>ملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($enrollment->payments as $payment)
                                        <tr>
                                            <td>{{ $payment->id }}</td>
                                            <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                                            <td>{{ number_format($payment->amount, 2) }}</td>
                                            <td>
                                                @switch($payment->payment_method)
                                                    @case('cash')
                                                        نقداً
                                                        @break
                                                    @case('bank_transfer')
                                                        تحويل بنكي
                                                        @break
                                                    @default
                                                        أخرى
                                                @endswitch
                                            </td>
                                            <td>{{ $payment->notes }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">لا توجد مدفوعات حتى الآن</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
