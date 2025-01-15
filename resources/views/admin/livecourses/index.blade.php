<x-app-layout>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">إدارة الدورات المباشرة</h5>
                <a href="{{ route('admin.livecourses.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة دورة جديدة
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
                                <th>اسم الدورة</th>
                                <th>التفاصيل</th>
                                <th>الروابط</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($livecourses as $course)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#courseDetails{{ $course->id }}">
                                            <i class="fas fa-info-circle"></i> عرض التفاصيل
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="courseDetails{{ $course->id }}" tabindex="-1" aria-labelledby="courseDetailsLabel{{ $course->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="courseDetailsLabel{{ $course->id }}">تفاصيل الدورة: {{ $course->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6 class="fw-bold">وصف الدورة:</h6>
                                                        <p>{!! nl2br(e($course->description)) !!}</p>
                                                        
                                                        <h6 class="fw-bold mt-4">محاور الدورة:</h6>
                                                        <p>{!! nl2br(e($course->objectives)) !!}</p>
                                                        
                                                        @if($course->video_url)
                                                            <h6 class="fw-bold mt-4">الفيديو التعريفي:</h6>
                                                            <div class="ratio ratio-16x9 mt-2">
                                                                <iframe src="{{ $course->video_url }}" allowfullscreen></iframe>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            @if($course->material_url)
                                                <a href="{{ $course->material_url }}" target="_blank" class="btn btn-sm btn-info">
                                                    <i class="fas fa-external-link-alt"></i> المتريال
                                                </a>
                                            @endif
                                            
                                            @if($course->powerpoint_url)
                                                <a href="{{ $course->powerpoint_url }}" target="_blank" class="btn btn-sm btn-info">
                                                    <i class="fas fa-file-powerpoint"></i> البوربوينت
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.livecourses.edit', $course) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> تعديل
                                        </a>
                                        <form action="{{ route('admin.livecourses.destroy', $course) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">لا توجد دورات مباشرة</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $livecourses->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
