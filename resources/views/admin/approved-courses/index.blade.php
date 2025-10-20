<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-0">الكورسات المعتمدة</h5>
                                <p class="text-muted mb-0 small">عرض جميع الكورسات التي تم قبول طلبات الاشتراك فيها</p>
                            </div>
                            <div class="col-auto">
                                <div class="badge bg-success p-2">
                                    <div class="text-center">
                                        <div class="h6 mb-0">إجمالي الإيرادات</div>
                                        <div class="h4 mb-0">{{ round($totalRevenue) }} ج.م</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        @if($approvedCourses->isEmpty())
                            <div class="text-center py-5">
                                <img src="{{ asset('images/general/no-results.svg') }}" alt="لا توجد كورسات" class="img-fluid mb-4" style="max-width: 200px;">
                                <h3 class="h4 mb-3">لا توجد كورسات معتمدة حالياً</h3>
                                <p class="text-muted">ستظهر هنا الكورسات التي تم قبول طلبات الاشتراك فيها</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0">#</th>
                                            <th class="border-0">الكورس</th>
                                            <th class="border-0">المدرب</th>
                                            <th class="border-0">السعر</th>
                                            <th class="border-0">عدد المشتركين</th>
                                            <th class="border-0">إجمالي الإيرادات</th>
                                            <th class="border-0">تفاصيل</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($approvedCourses as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="min-width: 250px;">
                                                    <div class="d-flex align-items-center">
                                                        @if($item->course->image)
                                                            <img src="{{ asset('storage/' . $item->course->image) }}" 
                                                                 alt="{{ $item->course->title }}" 
                                                                 class="rounded me-3"
                                                                 style="width: 48px; height: 48px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                                                 style="width: 48px; height: 48px;">
                                                                <i class="fas fa-graduation-cap text-muted"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <h6 class="mb-1">{{ $item->course->title }}</h6>
                                                            <div class="small text-muted">
                                                                <i class="fas fa-layer-group me-1"></i>
                                                                {{ $item->course->category->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @foreach($item->course->instructors as $instructor)
                                                        <div class="mb-1 last:mb-0">{{ $instructor->name }}</div>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="badge bg-success">{{ round($item->course->price) }} ج.م</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $item->total_enrollments }}</span>
                                                </td>
                                                <td>
                                                    <div class="fw-bold text-success">
                                                        {{ round($item->total_revenue) }} ج.م
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.courses.show', $item->course) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye me-1"></i>
                                                        عرض التفاصيل
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="bg-light p-3 border-top">
                                <div class="row text-center">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <h6 class="mb-1">إجمالي المشتركين</h6>
                                        <div class="h4 mb-0 text-primary">{{ $totalEnrollments }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="mb-1">إجمالي الإيرادات</h6>
                                        <div class="h4 mb-0 text-success">{{ round($totalRevenue) }} ج.م</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
