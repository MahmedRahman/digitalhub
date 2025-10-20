<x-app-layout>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('admin.live-course-rounds.index') }}" class="btn btn-outline-primary me-2">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <h5 class="d-inline-block mb-0">إدارة الطلاب - {{ $round->round_name }}</h5>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        <i class="fas fa-user-plus me-1"></i>إضافة طالب
                    </button>
                </div>
            </div>
            
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Course Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title text-primary">
                                    <i class="fas fa-info-circle me-2"></i>معلومات الجولة
                                </h6>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <p class="mb-1 text-muted">الدورة</p>
                                        <p class="mb-0 fw-bold">{{ $round->livecourse->name }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-1 text-muted">المحاضر</p>
                                        <p class="mb-0 fw-bold">{{ $round->instructor->name }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-1 text-muted">تاريخ البداية</p>
                                        <p class="mb-0 fw-bold">{{ $round->start_date->format('Y-m-d') }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-1 text-muted">تاريخ النهاية</p>
                                        <p class="mb-0 fw-bold">{{ $round->end_date->format('Y-m-d') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title text-primary">
                                    <i class="fas fa-users me-2"></i>إحصائيات الطلاب
                                </h6>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                                <i class="fas fa-users text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-muted">إجمالي الطلاب</p>
                                                <h4 class="mb-0">{{ $round->students_count ?? 0 }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                                                <i class="fas fa-money-bill text-success"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-muted">سعر الجولة</p>
                                                <h4 class="mb-0">{{ round($round->price) }} جنيه</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Students Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>الطالب</th>
                                <th>البريد الإلكتروني</th>
                                <th>رقم الهاتف</th>
                                <th>المبلغ الكلي</th>
                                <th>المدفوع</th>
                                <th>المتبقي</th>
                                <th>حالة الدفع</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                            {{ $student->name }}
                                        </div>
                                    </td>
                                    <td dir="ltr">{{ $student->email }}</td>
                                    <td dir="ltr">{{ $student->phone }}</td>
                                    <td>{{ round($student->pivot->total_amount) }} جنيه</td>
                                    <td>{{ round($student->pivot->paid_amount) }} جنيه</td>
                                    <td>{{ round($student->pivot->remaining_amount) }} جنيه</td>
                                    <td>
                                        @if($student->pivot->payment_status === 'paid')
                                            <span class="badge bg-success">تم الدفع</span>
                                        @else
                                            <span class="badge bg-warning">في الانتظار</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" style="position: static;">
                                            <button type="button" 
                                                    class="btn btn-sm btn-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#updatePaymentModal{{ $student->id }}"
                                                    title="تحديث المدفوعات">
                                                <i class="fas fa-money-bill"></i>
                                            </button>
                                            <button type="button" 
                                                    class="btn btn-sm btn-info" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#paymentsHistoryModal{{ $student->id }}"
                                                    title="سجل المدفوعات">
                                                <i class="fas fa-history"></i>
                                            </button>
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#removeStudentModal{{ $student->id }}"
                                                    title="إزالة الطالب">
                                                <i class="fas fa-user-minus"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-user-friends fa-2x mb-3"></i>
                                            <p class="mb-0">لا يوجد طلاب مسجلين في هذه الجولة</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modals Container -->
    <div class="payment-modals-container">
        @foreach($students as $student)
            <!-- Update Payment Modal -->
            <div class="modal fade payment-modal" 
                 id="updatePaymentModal{{ $student->id }}" 
                 tabindex="-1" 
                 aria-labelledby="updatePaymentModalLabel{{ $student->id }}"
                 aria-hidden="true"
                 style="position: fixed; top: 0; left: 0; z-index: 1055;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updatePaymentModalLabel{{ $student->id }}">تحديث مدفوعات الطالب</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.live-course-rounds.students.update-payment', [$round->id, $student->id]) }}" 
                              method="POST"
                              class="needs-validation"
                              novalidate>
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">الطالب</label>
                                    <input type="text" class="form-control" value="{{ $student->name }}" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="total_amount{{ $student->id }}" class="form-label">المبلغ الكلي</label>
                                        <div class="input-group">
                                            <input type="number" 
                                                   step="0.01" 
                                                   class="form-control" 
                                                   id="total_amount{{ $student->id }}" 
                                                   name="total_amount" 
                                                   value="{{ $student->pivot->total_amount }}"
                                                   min="0"
                                                   required>
                                            <span class="input-group-text">جنيه</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="paid_amount{{ $student->id }}" class="form-label">المبلغ المدفوع</label>
                                        <div class="input-group">
                                            <input type="number" 
                                                   step="0.01" 
                                                   class="form-control" 
                                                   id="paid_amount{{ $student->id }}" 
                                                   name="paid_amount" 
                                                   value="{{ $student->pivot->paid_amount }}"
                                                   min="0"
                                                   required>
                                            <span class="input-group-text">جنيه</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-info mb-3">
                                    <i class="fas fa-calculator me-2"></i>
                                    المبلغ المتبقي: <strong class="remaining-amount">{{ round($student->pivot->remaining_amount) }} جنيه</strong>
                                </div>
                                <div class="mb-3">
                                    <label for="payment_notes{{ $student->id }}" class="form-label">ملاحظات</label>
                                    <textarea class="form-control" 
                                              id="payment_notes{{ $student->id }}" 
                                              name="payment_notes" 
                                              rows="3">{{ $student->pivot->payment_notes }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Payment History Modal -->
            <div class="modal fade" id="paymentsHistoryModal{{ $student->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">سجل مدفوعات {{ $student->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>رقم الفاتورة</th>
                                            <th>التاريخ</th>
                                            <th>المبلغ</th>
                                            <th>طريقة الدفع</th>
                                            <th>الرقم المرجعي</th>
                                            <th>ملاحظات</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($student->payments()->where('live_course_round_id', $round->id)->get() as $payment)
                                            <tr>
                                                <td>{{ $payment->receipt_number }}</td>
                                                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                                                <td>{{ round($payment->amount) }} جنيه</td>
                                                <td>{{ $payment->payment_method === 'cash' ? 'نقداً' : 'تحويل بنكي' }}</td>
                                                <td>{{ $payment->reference_number ?: '-' }}</td>
                                                <td>{{ $payment->notes ?: '-' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.live-course-rounds.students.payments.receipt', [$round->id, $student->id, $payment->id]) }}" 
                                                       class="btn btn-sm btn-secondary"
                                                       target="_blank"
                                                       title="طباعة الفاتورة">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-3">
                                                    <div class="text-muted">
                                                        <i class="fas fa-receipt fa-2x mb-2"></i>
                                                        <p class="mb-0">لا توجد مدفوعات مسجلة</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" 
                                    class="btn btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#addPaymentModal{{ $student->id }}"
                                    data-bs-dismiss="modal">
                                <i class="fas fa-plus me-1"></i>
                                إضافة دفعة جديدة
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Payment Modal -->
            <div class="modal fade" id="addPaymentModal{{ $student->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">إضافة دفعة جديدة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('admin.live-course-rounds.students.payments.store', [$round->id, $student->id]) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">الطالب</label>
                                    <input type="text" class="form-control" value="{{ $student->name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="amount{{ $student->id }}" class="form-label">المبلغ</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               step="0.01" 
                                               class="form-control" 
                                               id="amount{{ $student->id }}" 
                                               name="amount"
                                               required
                                               min="0">
                                        <span class="input-group-text">جنيه</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="payment_method{{ $student->id }}" class="form-label">طريقة الدفع</label>
                                    <select class="form-select" 
                                            id="payment_method{{ $student->id }}" 
                                            name="payment_method"
                                            required>
                                        <option value="cash">نقداً</option>
                                        <option value="bank_transfer">تحويل بنكي</option>
                                    </select>
                                </div>
                                <div class="mb-3 bank-transfer-fields" style="display: none;">
                                    <label for="reference_number{{ $student->id }}" class="form-label">الرقم المرجعي للتحويل</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="reference_number{{ $student->id }}" 
                                           name="reference_number">
                                </div>
                                <div class="mb-3">
                                    <label for="payment_notes{{ $student->id }}" class="form-label">ملاحظات</label>
                                    <textarea class="form-control" 
                                              id="payment_notes{{ $student->id }}" 
                                              name="notes" 
                                              rows="2"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                <button type="submit" class="btn btn-primary">حفظ الدفعة</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Remove Student Modal -->
            <div class="modal fade" 
                 id="removeStudentModal{{ $student->id }}" 
                 tabindex="-1"
                 style="position: fixed; top: 0; left: 0; z-index: 1055;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تأكيد إزالة الطالب</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>هل أنت متأكد من إزالة الطالب <strong>{{ $student->name }}</strong> من هذه الجولة؟</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <form action="{{ route('admin.live-course-rounds.students.remove', [$round->id, $student->id]) }}" 
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">تأكيد الإزالة</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة طالب للجولة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.live-course-rounds.students.store', $round->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="student_id" class="form-label">اختر الطالب</label>
                            <select name="student_id" id="student_id" class="form-select" required>
                                <option value="">اختر الطالب...</option>
                                @foreach($availableStudents as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->email }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="payment_status" class="form-label">حالة الدفع</label>
                            <select name="payment_status" id="payment_status" class="form-select" required>
                                <option value="pending">في انتظار الدفع</option>
                                <option value="paid">تم الدفع</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">إضافة الطالب</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
    .payment-modals-container {
        position: relative;
        z-index: 1055;
    }
    .payment-modal {
        position: fixed !important;
    }
    .modal-backdrop {
        z-index: 1054;
    }
    .btn-group {
        position: static !important;
    }
    </style>
    @endpush

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // تحديث المبلغ المتبقي تلقائياً
        function updateRemainingAmount(modalId) {
            const modal = document.getElementById(modalId);
            const totalInput = modal.querySelector('[name="total_amount"]');
            const paidInput = modal.querySelector('[name="paid_amount"]');
            const remainingDisplay = modal.querySelector('.remaining-amount');

            const calculateRemaining = () => {
                const total = parseFloat(totalInput.value) || 0;
                const paid = parseFloat(paidInput.value) || 0;
                const remaining = (total - paid).toFixed(2);
                remainingDisplay.textContent = `${remaining} جنيه`;
            };

            totalInput.addEventListener('input', calculateRemaining);
            paidInput.addEventListener('input', calculateRemaining);
        }

        // تهيئة كل النوافذ المنبثقة
        const paymentModals = document.querySelectorAll('.payment-modal');
        paymentModals.forEach(modal => {
            const modalInstance = new bootstrap.Modal(modal);
            
            modal.addEventListener('shown.bs.modal', function() {
                updateRemainingAmount(this.id);
            });
        });

        // إظهار/إخفاء حقل الرقم المرجعي حسب طريقة الدفع
        document.querySelectorAll('[id^="payment_method"]').forEach(select => {
            select.addEventListener('change', function() {
                const bankTransferFields = this.closest('.modal-body').querySelector('.bank-transfer-fields');
                bankTransferFields.style.display = this.value === 'bank_transfer' ? 'block' : 'none';
            });
        });
    });
    </script>
    @endpush
</x-app-layout>
