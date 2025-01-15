<x-app-layout>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">إدارة جولات الدورات المباشرة</h5>
                <a href="{{ route('admin.live-course-rounds.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة جولة جديدة
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>اسم الجولة</th>
                                <th>الدورة</th>
                                <th>المحاضر</th>
                                <th>التاريخ</th>
                                <th>عدد الساعات</th>
                                <th>السعر</th>
                                <th>عدد الطلاب</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rounds as $round)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $round->round_name }}</td>
                                    <td>{{ $round->livecourse->name }}</td>
                                    <td>{{ $round->instructor->name }}</td>
                                    <td>
                                        <div class="small">
                                            <div class="mb-1">
                                                <i class="fas fa-calendar-alt text-primary me-1"></i>
                                                من: {{ $round->start_date->format('Y-m-d') }}
                                            </div>
                                            <div>
                                                <i class="fas fa-calendar-check text-success me-1"></i>
                                                إلى: {{ $round->end_date->format('Y-m-d') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $round->hours_count }} ساعة</td>
                                    <td>{{ $round->price }} جنيه</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $round->students_count ?? 0 }} طالب
                                        </span>
                                    </td>
                                    <td>
                                        @switch($round->status)
                                            @case('upcoming')
                                                <span class="badge bg-primary">قادم</span>
                                                @break
                                            @case('ongoing')
                                                <span class="badge bg-success">جاري</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-secondary">مكتمل</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.live-course-rounds.students.index', $round->id) }}" 
                                               class="btn btn-sm btn-info"
                                               title="إدارة الطلاب">
                                                <i class="fas fa-users"></i>
                                            </a>
                                            
                                            <a href="{{ route('admin.live-course-rounds.edit', $round->id) }}" 
                                               class="btn btn-sm btn-primary"
                                               title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $round->id }}"
                                                    title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $round->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">تأكيد الحذف</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>هل أنت متأكد من حذف جولة <strong>{{ $round->round_name }}</strong>؟</p>
                                                        <p class="text-danger mb-0">
                                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                                            سيتم حذف جميع بيانات الطلاب المسجلين في هذه الجولة.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                        <form action="{{ route('admin.live-course-rounds.destroy', $round->id) }}" 
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">تأكيد الحذف</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-calendar-times fa-2x mb-3"></i>
                                            <p class="mb-0">لا توجد جولات حالياً</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $rounds->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
