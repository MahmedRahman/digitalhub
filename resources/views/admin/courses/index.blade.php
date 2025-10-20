<x-app-layout>
    <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">إدارة الدورات</h2>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة دورة جديدة
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <form action="{{ route('admin.courses.index') }}" method="GET" class="row g-3">
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="search" placeholder="ابحث عن دورة..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> بحث
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>العنوان</th>
                                <th>التصنيف</th>
                                <th>المدربين</th>
                                <th>المدة</th>
                                <th>السعر</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->category->name }}</td>
                                    <td>
                                        @foreach($course->instructors as $instructor)
                                            <div class="mb-1">
                                                <span class="badge bg-info">
                                                    <i class="fas fa-user-tie me-1"></i>
                                                    {{ $instructor->name }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>{{ $course->duration_in_weeks }} أسابيع</td>
                                    <td>{{ round($course->price) }} ج.م</td>
                                    <td>
                                        <span class="badge bg-{{ $course->status === 'published' ? 'success' : 'warning' }}">
                                            {{ $course->status === 'published' ? 'منشور' : 'مسودة' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.courses.edit', $course) }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.courses.destroy', $course) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه الدورة؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">لا توجد دورات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $courses->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
