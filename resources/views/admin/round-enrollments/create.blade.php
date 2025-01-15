<x-app-layout>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">تسجيل طالب جديد</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.round-enrollments.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="user_id" class="form-label">الطالب</label>
                            <select class="form-select select2 @error('user_id') is-invalid @enderror" 
                                    id="user_id" name="user_id" required>
                                <option value="">اختر الطالب</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} - {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="live_course_round_id" class="form-label">الجولة</label>
                            <select class="form-select select2 @error('live_course_round_id') is-invalid @enderror" 
                                    id="live_course_round_id" name="live_course_round_id" required>
                                <option value="">اختر الجولة</option>
                                @foreach($rounds as $round)
                                    <option value="{{ $round->id }}" {{ old('live_course_round_id') == $round->id ? 'selected' : '' }}
                                            data-price="{{ $round->price }}">
                                        {{ $round->livecourse->name }} - {{ $round->round_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('live_course_round_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="total_price" class="form-label">السعر الكلي</label>
                            <input type="number" step="0.01" class="form-control @error('total_price') is-invalid @enderror" 
                                   id="total_price" name="total_price" value="{{ old('total_price') }}" required>
                            @error('total_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="paid_amount" class="form-label">المبلغ المدفوع</label>
                            <input type="number" step="0.01" class="form-control @error('paid_amount') is-invalid @enderror" 
                                   id="paid_amount" name="paid_amount" value="{{ old('paid_amount', 0) }}" required>
                            @error('paid_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="payment_method" class="form-label">طريقة الدفع</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" 
                                    id="payment_method" name="payment_method" required>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>نقداً</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>تحويل بنكي</option>
                                <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>أخرى</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="notes" class="form-label">ملاحظات</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="{{ route('admin.round-enrollments.index') }}" class="btn btn-secondary">رجوع</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // تهيئة Select2
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                dir: 'rtl',
                language: 'ar'
            });

            // تحديث السعر الكلي عند اختيار الجولة
            $('#live_course_round_id').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var price = selectedOption.data('price');
                if (price) {
                    $('#total_price').val(price);
                }
            });

            // التحقق من المبلغ المدفوع
            $('#paid_amount').on('input', function() {
                var totalPrice = parseFloat($('#total_price').val()) || 0;
                var paidAmount = parseFloat($(this).val()) || 0;
                
                if (paidAmount > totalPrice) {
                    $(this).val(totalPrice);
                }
            });

            // التحقق من السعر الكلي
            $('#total_price').on('input', function() {
                var totalPrice = parseFloat($(this).val()) || 0;
                var paidAmount = parseFloat($('#paid_amount').val()) || 0;
                
                if (paidAmount > totalPrice) {
                    $('#paid_amount').val(totalPrice);
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
