<x-app-layout>
    <div class="container py-5">
        <div class="row">

            <!-- Main Content -->
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">طلبات الاشتراك في الدورات</h5>
                    </div>
                    <div class="card-body">
                        @if($enrollments->isEmpty())
                            <div class="text-center py-5">
                                <img src="{{ asset('images/general/no-results.svg') }}" 
                                     alt="لا توجد طلبات" 
                                     class="img-fluid mb-4" 
                                     style="max-width: 200px;">
                                <h3 class="h4 mb-3">لا توجد طلبات اشتراك</h3>
                                <p class="text-muted mb-4">لم تقم بتقديم أي طلبات اشتراك في الدورات بعد</p>
                                <a href="{{ route('courses.index') }}" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>استكشف الدورات
                                </a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>الدورة</th>
                                            <th>المدرب</th>
                                            <th>التصنيف</th>
                                            <th>السعر</th>
                                            <th>حالة الطلب</th>
                                            <th>تاريخ الطلب</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enrollments as $enrollment)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $enrollment->course->image_url }}" 
                                                             alt="{{ $enrollment->course->title }}"
                                                             class="rounded me-3"
                                                             width="48"
                                                             height="48"
                                                             style="object-fit: cover;">
                                                        <div>
                                                            <h6 class="mb-0">
                                                                <a href="{{ route('courses.show', $enrollment->course) }}" 
                                                                   class="text-decoration-none">
                                                                    {{ $enrollment->course->title }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $enrollment->course->instructor?->name ?? 'لم يتم تعيين مدرس' }}</td>
                                                <td>{{ $enrollment->course->category?->name ?? 'بدون تصنيف' }}</td>
                                                <td>{{ $enrollment->payment_amount }} جنيه</td>
                                                <td>
                                                    @if($enrollment->status === 'pending')
                                                        <span class="badge bg-warning">قيد المراجعة</span>
                                                    @elseif($enrollment->status === 'approved')
                                                        <span class="badge bg-success">تم القبول</span>
                                                    @else
                                                        <span class="badge bg-danger">تم الرفض</span>
                                                        @if($enrollment->notes)
                                                            <i class="fas fa-info-circle ms-1" 
                                                               data-bs-toggle="tooltip" 
                                                               title="{{ $enrollment->notes }}"></i>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{ $enrollment->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                {{ $enrollments->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // تفعيل tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    @endpush
</x-app-layout>
