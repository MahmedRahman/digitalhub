@props(['instructor'])

<div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">الدورات التي يقدمها المدرب</h5>
    </div>
    <div class="card-body">
        @if($instructor->courses->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الدورة</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($instructor->courses as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $course->title }}</td>
                                <td>
                                    @if($course->status === 'published')
                                        <span class="badge bg-success">منشور</span>
                                    @elseif($course->status === 'draft')
                                        <span class="badge bg-warning">مسودة</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $course->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.courses.edit', $course) }}" 
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.courses.show', $course) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mb-0">
                لا يوجد دورات مسجلة لهذا المدرب حتى الآن.
            </div>
        @endif
    </div>
</div>
