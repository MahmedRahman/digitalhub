<x-app-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">إدارة المستخدمين</h2>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus me-2"></i>إضافة مستخدم جديد
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
                <form action="{{ route('admin.users.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="ابحث عن طريق الاسم، البريد الإلكتروني، أو رقم الهاتف..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="type" class="form-select">
                            <option value="">جميع أنواع المستخدمين</option>
                            <option value="student" {{ request('type') === 'student' ? 'selected' : '' }}>طالب</option>
                            <option value="instructor" {{ request('type') === 'instructor' ? 'selected' : '' }}>محاضر</option>
                            <option value="admin" {{ request('type') === 'admin' ? 'selected' : '' }}>مدير</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="fas fa-search me-1"></i>بحث
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>رقم الهاتف</th>
                                <th>نوع المستخدم</th>
                                <th>تاريخ الإنضمام</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td dir="ltr">{{ $user->email }}</td>
                                    <td dir="ltr">{{ $user->phone }}</td>
                                    <td>
                                        @switch($user->type)
                                            @case('admin')
                                                <span class="badge bg-danger">مدير</span>
                                                @break
                                            @case('instructor')
                                                <span class="badge bg-success">محاضر</span>
                                                @break
                                            @default
                                                <span class="badge bg-info">طالب</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" 
                                               class="btn btn-sm btn-primary"
                                               title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $user->id }}"
                                                    title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">تأكيد الحذف</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>هل أنت متأكد من حذف المستخدم <strong>{{ $user->name }}</strong>؟</p>
                                                        <p class="text-danger mb-0"><i class="fas fa-exclamation-triangle me-2"></i>هذا الإجراء لا يمكن التراجع عنه.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
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
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-search fa-2x mb-3"></i>
                                            <p class="mb-0">لم يتم العثور على أي مستخدمين</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
