<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.hero-sections.create') }}" class="btn btn-primary me-3">
                        <i class="fas fa-plus me-2"></i>إضافة بانر جديد
                    </a>
                    <h2 class="fw-bold mb-0">إدارة البانر الرئيسي</h2>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        @if($heroSections->isEmpty())
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                                <h4 class="text-muted">لا يوجد بانرات حالياً</h4>
                                <p class="text-muted mb-0">قم بإضافة بانر جديد من خلال الزر أعلاه</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 60px">#</th>
                                            <th scope="col">الصورة</th>
                                            <th scope="col">العنوان</th>
                                            <th scope="col">الوصف</th>
                                            <th scope="col">نص الزر</th>
                                            <th scope="col">الترتيب</th>
                                            <th scope="col">الحالة</th>
                                            <th scope="col" style="width: 200px">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($heroSections as $heroSection)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ $heroSection->image_url }}" 
                                                         alt="Hero Image" 
                                                         class="rounded"
                                                         width="80">
                                                </td>
                                                <td>{{ $heroSection->title }}</td>
                                                <td>{{ Str::limit($heroSection->description, 50) }}</td>
                                                <td>{{ $heroSection->button_text }}</td>
                                                <td>{{ $heroSection->sort_order }}</td>
                                                <td>
                                                    @if($heroSection->is_active)
                                                        <span class="badge bg-success">نشط</span>
                                                    @else
                                                        <span class="badge bg-danger">غير نشط</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.hero-sections.edit', $heroSection) }}" 
                                                       class="btn btn-sm btn-primary me-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.hero-sections.destroy', $heroSection) }}" 
                                                          method="POST"
                                                          class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('هل أنت متأكد من حذف هذا البانر؟')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
