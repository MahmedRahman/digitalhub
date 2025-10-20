@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">التحقق من صحة الفاتورة</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                هذه الفاتورة صحيحة وصادرة من نظامنا
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <h6 class="text-muted">معلومات الفاتورة</h6>
                    <dl class="row">
                        <dt class="col-sm-4">رقم الفاتورة</dt>
                        <dd class="col-sm-8">{{ $payment->receipt_number }}</dd>

                        <dt class="col-sm-4">التاريخ</dt>
                        <dd class="col-sm-8">{{ $payment->created_at->format('Y-m-d') }}</dd>

                        <dt class="col-sm-4">المبلغ</dt>
                        <dd class="col-sm-8">{{ round($payment->amount) }} جنيه</dd>

                        <dt class="col-sm-4">طريقة الدفع</dt>
                        <dd class="col-sm-8">{{ $payment->payment_method === 'cash' ? 'نقداً' : 'تحويل بنكي' }}</dd>

                        @if($payment->reference_number)
                            <dt class="col-sm-4">رقم التحويل</dt>
                            <dd class="col-sm-8">{{ $payment->reference_number }}</dd>
                        @endif
                    </dl>
                </div>

                <div class="col-md-6">
                    <h6 class="text-muted">معلومات الطالب والدورة</h6>
                    <dl class="row">
                        <dt class="col-sm-4">اسم الطالب</dt>
                        <dd class="col-sm-8">{{ $student->name }}</dd>

                        <dt class="col-sm-4">الدورة</dt>
                        <dd class="col-sm-8">{{ $round->livecourse->name }}</dd>

                        <dt class="col-sm-4">الجولة</dt>
                        <dd class="col-sm-8">{{ $round->round_name }}</dd>
                    </dl>
                </div>
            </div>

            @if($payment->notes)
                <div class="mt-4">
                    <h6 class="text-muted">ملاحظات</h6>
                    <p class="mb-0">{{ $payment->notes }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
