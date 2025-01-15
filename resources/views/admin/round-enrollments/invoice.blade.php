@php
    // التحقق من وجود البيانات المطلوبة
    if (!$enrollment->user || !$enrollment->round || !$enrollment->round->livecourse) {
        abort(404, 'بيانات غير مكتملة');
    }
@endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة تسجيل - {{ $enrollment->user->name ?? 'غير معروف' }}</title>
    
    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            .card {
                border: none !important;
            }
            body {
                margin: 0;
                padding: 0;
            }
        }
        
        .invoice-header {
            border-bottom: 2px solid #dee2e6;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
        }
        
        .company-logo {
            max-height: 100px;
        }
        
        .invoice-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }
        
        .invoice-number {
            font-size: 1.2rem;
            color: #666;
        }
        
        .table-details th {
            width: 200px;
            background-color: #f8f9fa;
        }
        
        .payment-table th {
            background-color: #f8f9fa;
        }
        
        .total-section {
            border-top: 2px solid #dee2e6;
            margin-top: 2rem;
            padding-top: 1rem;
        }
        
        .signature-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px dashed #dee2e6;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="card">
            <div class="card-body">
                <!-- زر الطباعة -->
                <div class="text-end mb-4 no-print">
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="fas fa-print"></i> طباعة
                    </button>
                </div>

                <!-- رأس الفاتورة -->
                <div class="invoice-header text-center">
                    <img src="{{ asset('images/logo.png') }}" alt="شعار الشركة" class="company-logo mb-3">
                    <h1 class="invoice-title">فاتورة تسجيل</h1>
                    <div class="invoice-number">#{{ str_pad($enrollment->id, 6, '0', STR_PAD_LEFT) }}</div>
                    <div class="text-muted">{{ now()->format('Y-m-d') }}</div>
                </div>

                <!-- معلومات الطالب والدورة -->
                <div class="row mb-4">
                    <div class="col-12">
                        <table class="table table-bordered table-details">
                            <tbody>
                                <tr>
                                    <th>اسم الطالب</th>
                                    <td>{{ $enrollment->user->name ?? 'غير معروف' }}</td>
                                </tr>
                                <tr>
                                    <th>البريد الإلكتروني</th>
                                    <td>{{ $enrollment->user->email ?? 'غير متوفر' }}</td>
                                </tr>
                                <tr>
                                    <th>اسم الدورة</th>
                                    <td>{{ $enrollment->round->livecourse->name ?? 'غير معروف' }}</td>
                                </tr>
                                <tr>
                                    <th>الجولة</th>
                                    <td>{{ $enrollment->round->round_name ?? 'غير معروف' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ البداية</th>
                                    <td>{{ optional($enrollment->round->start_date)->format('Y-m-d') ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ النهاية</th>
                                    <td>{{ optional($enrollment->round->end_date)->format('Y-m-d') ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th>عدد الساعات</th>
                                    <td>{{ $enrollment->round->hours_count }} ساعة</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- تفاصيل المدفوعات -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="mb-3">تفاصيل المدفوعات</h4>
                        <table class="table table-bordered payment-table">
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
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                                        <td>{{ number_format($payment->amount, 2) }} ج.م</td>
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
                                        <td colspan="5" class="text-center">لا توجد مدفوعات مسجلة</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ملخص المدفوعات -->
                <div class="total-section">
                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>إجمالي المبلغ</th>
                                        <td>{{ number_format($enrollment->total_price, 2) }} ج.م</td>
                                    </tr>
                                    <tr>
                                        <th>المبلغ المدفوع</th>
                                        <td>{{ number_format($enrollment->paid_amount, 2) }} ج.م</td>
                                    </tr>
                                    <tr>
                                        <th>المبلغ المتبقي</th>
                                        <td>{{ number_format($enrollment->remaining_amount, 2) }} ج.م</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- قسم التوقيعات -->
                <div class="signature-section">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <h5>توقيع المسؤول</h5>
                            <div style="border-top: 1px solid #dee2e6; margin-top: 2rem;">التاريخ: {{ now()->format('Y-m-d') }}</div>
                        </div>
                        <div class="col-md-6">
                            <h5>توقيع الطالب</h5>
                            <div style="border-top: 1px solid #dee2e6; margin-top: 2rem;">التاريخ: {{ now()->format('Y-m-d') }}</div>
                        </div>
                    </div>
                </div>

                <!-- الشروط والأحكام -->
                <div class="mt-4 small text-muted">
                    <p>شروط وأحكام:</p>
                    <ol>
                        <li>يجب الالتزام بمواعيد الدورة المحددة</li>
                        <li>لا يمكن استرداد المبلغ المدفوع بعد بدء الدورة</li>
                        <li>في حالة الغياب يجب إخطار الإدارة مسبقاً</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>
