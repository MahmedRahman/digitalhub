<x-app-layout>
    <div class="container-fluid py-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 text-gray-800 mb-1">إدارة التصنيفات</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">لوحة التحكم</a></li>
                        <li class="breadcrumb-item active">التصنيفات</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.categories.create') }}" 
               class="btn btn-primary rounded-pill px-4 d-flex align-items-center hover-shadow">
                <i class="fas fa-plus-circle me-2"></i>
                <span>إضافة تصنيف جديد</span>
            </a>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>{{ session('success') }}</strong>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Filters Card -->
        <div class="card border-0 shadow-sm mb-4 overflow-hidden">
            <div class="card-body bg-light p-4">
                <form action="{{ route('admin.categories.index') }}" method="GET" class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" 
                                   name="search" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="ابحث عن طريق الاسم أو الوصف..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">جميع الحالات</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>نشط</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>غير نشط</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            تصفية
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4">#</th>
                                <th class="border-0">الأيقونة</th>
                                <th class="border-0">الاسم</th>
                                <th class="border-0">الوصف</th>
                                <th class="border-0">الترتيب</th>
                                <th class="border-0">الحالة</th>
                                <th class="border-0">تاريخ الإنشاء</th>
                                <th class="border-0 px-4">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr class="align-middle">
                                    <td class="px-4">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="icon-wrapper rounded-circle bg-light p-2 d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            @if($category->icon)
                                                <i class="fas fa-{{ $category->icon }} text-primary"></i>
                                            @else
                                                <i class="fas fa-folder text-muted"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="fw-medium">{{ $category->name }}</td>
                                    <td class="text-muted">{{ Str::limit($category->description, 50) }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $category->sort_order }}</span>
                                    </td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge bg-success-subtle text-success px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>نشط
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i>غير نشط
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $category->created_at->format('Y/m/d') }}</span>
                                    </td>
                                    <td class="px-4">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.categories.edit', $category) }}" 
                                               class="btn btn-sm btn-light rounded-pill px-3 hover-primary">
                                                <i class="fas fa-edit me-1"></i>
                                                تعديل
                                            </a>
                                            <form action="{{ route('admin.categories.destroy', $category) }}" 
                                                  method="POST" 
                                                  class="d-inline" 
                                                  onsubmit="return confirm('هل أنت متأكد من حذف هذا التصنيف؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-light rounded-pill px-3 hover-danger">
                                                    <i class="fas fa-trash-alt me-1"></i>
                                                    حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                            <h6 class="text-muted mb-1">لا يوجد تصنيفات</h6>
                                            <p class="text-muted small mb-3">قم بإضافة تصنيف جديد للبدء</p>
                                            <a href="{{ route('admin.categories.create') }}" 
                                               class="btn btn-primary rounded-pill px-4">
                                                <i class="fas fa-plus-circle me-2"></i>
                                                إضافة تصنيف جديد
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($categories->hasPages())
                    <div class="d-flex justify-content-center border-top p-4">
                        {{ $categories->links('vendor.pagination.bootstrap-5-rtl') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .hover-shadow {
            transition: all 0.2s ease;
        }
        .hover-shadow:hover {
            transform: translateY(-1px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        
        .hover-primary:hover {
            background-color: var(--bs-primary) !important;
            color: white !important;
        }
        
        .hover-danger:hover {
            background-color: var(--bs-danger) !important;
            color: white !important;
        }
        
        .empty-state {
            padding: 2rem;
            text-align: center;
        }
        
        .icon-wrapper {
            transition: all 0.2s ease;
        }
        
        tr:hover .icon-wrapper {
            background-color: var(--bs-primary-subtle) !important;
        }
        
        .badge {
            font-weight: 500;
        }
        
        /* Custom styles for pagination */
        .pagination {
            gap: 0.5rem;
        }
        
        .page-link {
            border-radius: 0.5rem;
            border: none;
            padding: 0.5rem 1rem;
            color: var(--bs-primary);
        }
        
        .page-item.active .page-link {
            background-color: var(--bs-primary);
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            float: right;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
    </style>
</x-app-layout>
