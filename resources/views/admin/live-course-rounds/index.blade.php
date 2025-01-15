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
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الجولة</th>
                                <th>الدورة</th>
                                <th>المحاضر</th>
                                <th>التاريخ</th>
                                <th>عدد الساعات</th>
                                <th>السعر</th>
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
                                        من: {{ $round->start_date->format('Y-m-d') }}<br>
                                        إلى: {{ $round->end_date->format('Y-m-d') }}
                                    </td>
                                    <td>{{ $round->hours_count }} ساعة</td>
                                    <td>{{ $round->price }} جنيه</td>
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
                                        <a href="{{ route('admin.live-course-rounds.edit', $round) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> تعديل
                                        </a>
                                        <form action="{{ route('admin.live-course-rounds.destroy', $round) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">لا توجد جولات</td>
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
