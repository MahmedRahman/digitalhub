<x-app-layout>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">تسجيلات الطلاب في الجولات</h5>
                <a href="{{ route('admin.round-enrollments.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> تسجيل طالب جديد
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الطالب</th>
                                <th>الدورة</th>
                                <th>الجولة</th>
                                <th>السعر الكلي</th>
                                <th>المدفوع</th>
                                <th>المتبقي</th>
                                <th>حالة الدفع</th>
                                <th>حالة التسجيل</th>
                                <th>خيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($enrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->id }}</td>
                                    <td>{{ $enrollment->user->name }}</td>
                                    <td>{{ $enrollment->round->livecourse->name }}</td>
                                    <td>{{ $enrollment->round->round_name }}</td>
                                    <td>{{ round($enrollment->total_price) }}</td>
                                    <td>{{ round($enrollment->paid_amount) }}</td>
                                    <td>{{ round($enrollment->remaining_amount) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $enrollment->payment_status == 'completed' ? 'success' : ($enrollment->payment_status == 'partial' ? 'warning' : 'danger') }}">
                                            {{ $enrollment->payment_status == 'completed' ? 'مكتمل' : ($enrollment->payment_status == 'partial' ? 'جزئي' : 'معلق') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $enrollment->enrollment_status == 'approved' ? 'success' : ($enrollment->enrollment_status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ $enrollment->enrollment_status == 'approved' ? 'مقبول' : ($enrollment->enrollment_status == 'pending' ? 'معلق' : 'مرفوض') }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.round-enrollments.show', $enrollment->id) }}" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="/admin/round-enrollments/{{ $enrollment->id }}/invoice" 
                                           class="btn btn-sm btn-primary" target="_blank">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">لا توجد تسجيلات حتى الآن</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $enrollments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
