<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">إدارة المدربين</h2>
            <a href="{{ route('admin.instructors.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>إضافة مدرب جديد
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.instructors.index') }}" method="GET" class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="ابحث عن طريق الاسم، البريد الإلكتروني، أو التخصص..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search me-1"></i>بحث
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>رقم الهاتف</th>
                                <th>المسمى الوظيفي</th>
                                <th>التخصص</th>
                                <th>الخبرة</th>
                                <th>الحالة</th>
                                <th>تاريخ الإضافة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($instructors as $instructor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $instructor->name }}</td>
                                    <td>{{ $instructor->email }}</td>
                                    <td>{{ $instructor->phone }}</td>
                                    <td>{{ $instructor->title }}</td>
                                    <td>
                                        @if($instructor->specialization)
                                            {{ $instructor->specialization->name }}
                                        @else
                                            <span class="text-muted">لم يتم تحديد التخصص</span>
                                        @endif
                                    </td>
                                    <td>{{ $instructor->experience }}</td>
                                    <td>
                                        @if($instructor->status == \App\Models\Instructor::STATUS_ACTIVE)
                                            <span class="badge bg-success">{{ $instructor->status_label }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $instructor->status_label }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $instructor->created_at->format('Y/m/d') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.instructors.edit', $instructor) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.instructors.destroy', $instructor) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المدرب؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <i class="fas fa-exclamation-circle text-muted mb-2 fs-2"></i>
                                        <p class="mb-0 text-muted">لا يوجد مدربين حالياً</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $instructors->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
<style>
    .pagination {
        --bs-pagination-padding-x: 0.75rem;
        --bs-pagination-padding-y: 0.375rem;
        --bs-pagination-font-size: 1rem;
        --bs-pagination-color: var(--bs-link-color);
        --bs-pagination-bg: var(--bs-body-bg);
        --bs-pagination-border-width: var(--bs-border-width);
        --bs-pagination-border-color: var(--bs-border-color);
        --bs-pagination-border-radius: var(--bs-border-radius);
        --bs-pagination-hover-color: var(--bs-link-hover-color);
        --bs-pagination-hover-bg: var(--bs-tertiary-bg);
        --bs-pagination-hover-border-color: var(--bs-border-color);
        --bs-pagination-focus-color: var(--bs-link-hover-color);
        --bs-pagination-focus-bg: var(--bs-secondary-bg);
        --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        --bs-pagination-active-color: #fff;
        --bs-pagination-active-bg: #0d6efd;
        --bs-pagination-active-border-color: #0d6efd;
        --bs-pagination-disabled-color: var(--bs-secondary-color);
        --bs-pagination-disabled-bg: var(--bs-secondary-bg);
        --bs-pagination-disabled-border-color: var(--bs-border-color);
        display: flex;
        padding-left: 0;
        list-style: none;
    }
    
    .page-link {
        position: relative;
        display: block;
        padding: var(--bs-pagination-padding-y) var(--bs-pagination-padding-x);
        font-size: var(--bs-pagination-font-size);
        color: var(--bs-pagination-color);
        text-decoration: none;
        background-color: var(--bs-pagination-bg);
        border: var(--bs-pagination-border-width) solid var(--bs-pagination-border-color);
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .page-link:hover {
        z-index: 2;
        color: var(--bs-pagination-hover-color);
        background-color: var(--bs-pagination-hover-bg);
        border-color: var(--bs-pagination-hover-border-color);
    }

    .page-link.active, .active > .page-link {
        z-index: 3;
        color: var(--bs-pagination-active-color);
        background-color: var(--bs-pagination-active-bg);
        border-color: var(--bs-pagination-active-border-color);
    }

    .page-item:not(:first-child) .page-link {
        margin-left: calc(var(--bs-border-width) * -1);
    }

    .page-item:first-child .page-link {
        border-top-left-radius: var(--bs-pagination-border-radius);
        border-bottom-left-radius: var(--bs-pagination-border-radius);
    }

    .page-item:last-child .page-link {
        border-top-right-radius: var(--bs-pagination-border-radius);
        border-bottom-right-radius: var(--bs-pagination-border-radius);
    }
</style>
@endpush
