<x-app-layout>
    <style>
        .avatar {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
        }
        .avatar-sm {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }
        .table > :not(caption) > * > * {
            padding: 1rem;
        }
        .table tbody tr:hover {
            background-color: rgba(0,0,0,.02);
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 text-dark">طلبات الاشتراك في الدورات</h5>
                            <p class="text-muted mb-0 small">إدارة طلبات اشتراك المستخدمين في الدورات التدريبية</p>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-filter me-1"></i>تصفية حسب الحالة
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item {{ request('status') == 'all' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}">الكل</a></li>
                                    <li><a class="dropdown-item {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}">قيد الانتظار</a></li>
                                    <li><a class="dropdown-item {{ request('status') == 'approved' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['status' => 'approved']) }}">مقبول</a></li>
                                    <li><a class="dropdown-item {{ request('status') == 'rejected' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['status' => 'rejected']) }}">مرفوض</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        @if($enrollments->isEmpty())
                            <div class="text-center py-5">
                                <img src="{{ asset('images/general/no-results.svg') }}" alt="لا توجد طلبات" class="img-fluid mb-4" style="max-width: 200px;">
                                <h3 class="h4 mb-3">لا توجد طلبات اشتراك حالياً</h3>
                                <p class="text-muted">ستظهر هنا طلبات الاشتراك في الدورات عندما يقوم المستخدمون بالتسجيل</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0">#</th>
                                            <th class="border-0">المستخدم</th>
                                            <th class="border-0">الدورة</th>
                                            <th class="border-0">تاريخ الطلب</th>
                                            <th class="border-0">الحالة</th>
                                            <th class="border-0">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enrollments as $enrollment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="min-width: 250px;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar avatar-sm bg-primary text-white rounded-circle">
                                                                {{ strtoupper(substr($enrollment->user->name, 0, 2)) }}
                                                            </div>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h6 class="mb-1">{{ $enrollment->user->name }}</h6>
                                                            <div class="d-flex flex-column text-muted small">
                                                                <span><i class="fas fa-envelope me-1"></i>{{ $enrollment->user->email }}</span>
                                                                @if($enrollment->user->phone)
                                                                    <span><i class="fas fa-phone me-1"></i>{{ $enrollment->user->phone }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="min-width: 200px;">
                                                    <div class="d-flex flex-column">
                                                        <a href="{{ route('courses.show', $enrollment->course) }}" class="text-decoration-none fw-medium mb-1">
                                                            {{ $enrollment->course->title }}
                                                        </a>
                                                        <span class="text-muted small">
                                                            <i class="fas fa-tag me-1"></i>{{ $enrollment->course->price }} ج.م
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="small">
                                                        <i class="fas fa-calendar me-1"></i>
                                                        @if($enrollment->enrolled_at)
                                                            {{ \Carbon\Carbon::parse($enrollment->enrolled_at)->format('Y/m/d') }}
                                                            <br>
                                                            <span class="text-muted">
                                                                <i class="fas fa-clock me-1"></i>
                                                                {{ \Carbon\Carbon::parse($enrollment->enrolled_at)->format('H:i') }}
                                                            </span>
                                                        @else
                                                            {{ \Carbon\Carbon::parse($enrollment->created_at)->format('Y/m/d') }}
                                                            <br>
                                                            <span class="text-muted">
                                                                <i class="fas fa-clock me-1"></i>
                                                                {{ \Carbon\Carbon::parse($enrollment->created_at)->format('H:i') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($enrollment->status === 'pending')
                                                        <span class="badge bg-warning">قيد الانتظار</span>
                                                    @elseif($enrollment->status === 'approved')
                                                        <span class="badge bg-success">مقبول</span>
                                                    @else
                                                        <span class="badge bg-danger">مرفوض</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($enrollment->status === 'pending')
                                                        <form action="{{ route('admin.enrollments.approve', $enrollment) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-success">
                                                                <i class="fas fa-check me-1"></i>قبول
                                                            </button>
                                                        </form>

                                                        <button type="button" 
                                                                class="btn btn-sm btn-danger" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#rejectModal{{ $enrollment->id }}">
                                                            <i class="fas fa-times me-1"></i>رفض
                                                        </button>

                                                        <!-- Reject Modal -->
                                                        <div class="modal fade" id="rejectModal{{ $enrollment->id }}" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="{{ route('admin.enrollments.reject', $enrollment) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">رفض طلب الاشتراك</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">سبب الرفض</label>
                                                                                <textarea name="notes" class="form-control" rows="3" required></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                                            <button type="submit" class="btn btn-danger">تأكيد الرفض</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-secondary" disabled>تم الإجراء</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center border-top p-3">
                                {{ $enrollments->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
