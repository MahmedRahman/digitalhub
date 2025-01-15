<x-app-layout>
    <div class="container py-4">
        <div class="card receipt-card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mb-3" style="max-width: 150px;">
                    <h2 class="mb-0">إيصال دفع</h2>
                    <div class="text-muted mt-2">رقم الفاتورة: {{ $payment->receipt_number }}</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="text-muted mb-3">معلومات الدفع</h5>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 40%">التاريخ</th>
                                    <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <th>المبلغ</th>
                                    <td>{{ number_format($payment->amount, 2) }} جنيه</td>
                                </tr>
                                <tr>
                                    <th>طريقة الدفع</th>
                                    <td>{{ $payment->payment_method === 'cash' ? 'نقداً' : 'تحويل بنكي' }}</td>
                                </tr>
                                @if($payment->reference_number)
                                <tr>
                                    <th>رقم التحويل</th>
                                    <td>{{ $payment->reference_number }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-muted mb-3">معلومات الطالب والدورة</h5>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 40%">اسم الطالب</th>
                                    <td>{{ $student->name }}</td>
                                </tr>
                                <tr>
                                    <th>الدورة</th>
                                    <td>{{ $round->livecourse->name }}</td>
                                </tr>
                                <tr>
                                    <th>الجولة</th>
                                    <td>{{ $round->round_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($payment->notes)
                <div class="mb-4">
                    <div class="alert alert-light">
                        <h5 class="alert-heading text-muted mb-2">ملاحظات</h5>
                        <p class="mb-0">{{ $payment->notes }}</p>
                    </div>
                </div>
                @endif

                <hr class="my-4">

                <div class="text-center">
                    <div class="mb-3">
                        <div class="qr-code d-inline-block">
                            {!! QrCode::size(100)->generate(route('admin.live-course-rounds.students.payments.verify', $payment->receipt_number)) !!}
                        </div>
                    </div>
                    <p class="text-muted mb-4">
                        هذه الفاتورة صدرت إلكترونياً وتعتبر صالحة بدون توقيع أو ختم
                    </p>
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="fas fa-print me-2"></i>
                        طباعة الفاتورة
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body {
                background-color: white;
            }
            .btn, 
            .navbar, 
            .footer,
            .alert-dismissible,
            .sidebar {
                display: none !important;
            }
            .receipt-card {
                border: none !important;
                box-shadow: none !important;
            }
            .container {
                width: 100% !important;
                max-width: none !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .card {
                break-inside: avoid;
            }
            .table {
                width: 100% !important;
            }
            .table td,
            .table th {
                padding: 8px !important;
            }
        }

        .receipt-card {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            vertical-align: middle;
        }

        .qr-code {
            padding: 10px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .alert-light {
            background-color: #f8f9fa;
            border-color: #ddd;
        }
    </style>
</x-app-layout>
