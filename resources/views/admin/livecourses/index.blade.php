<x-app-layout>
    <style>
        .modal {
            --bs-modal-zindex: 1055;
        }
        .modal-dialog {
            transition: none !important;
        }
        .modal-content {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .modal-body {
            word-wrap: break-word;
        }
        .modal-backdrop {
            z-index: 1050;
        }
        .btn {
            transition: all 0.2s ease-in-out;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
    </style>
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
                                        <button type="button" class="btn btn-sm btn-info" onclick="showCourseDetails({{ $course->id }}, '{{ addslashes($course->name) }}', '{{ addslashes($course->description) }}', '{{ addslashes($course->objectives) }}', '{{ $course->video_url }}')">
                                            <i class="fas fa-info-circle"></i> عرض التفاصيل
                                        </button>
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

    <!-- Single Modal for Course Details -->
    <div class="modal fade" id="courseDetailsModal" tabindex="-1" aria-labelledby="courseDetailsLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="courseDetailsLabel">تفاصيل الدورة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <h6 class="fw-bold">وصف الدورة:</h6>
                    <p id="courseDescription"></p>
                    
                    <h6 class="fw-bold mt-4">محاور الدورة:</h6>
                    <p id="courseObjectives"></p>
                    
                    <div id="courseVideo" style="display: none;">
                        <h6 class="fw-bold mt-4">الفيديو التعريفي:</h6>
                        <div class="ratio ratio-16x9 mt-2">
                            <iframe id="videoFrame" src="" allowfullscreen style="border: none;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentModal = null;
        
        function showCourseDetails(id, name, description, objectives, videoUrl) {
            // Hide any existing modal first
            if (currentModal) {
                currentModal.hide();
            }
            
            // Clear previous video to prevent conflicts
            const videoFrame = document.getElementById('videoFrame');
            videoFrame.src = '';
            
            // Update modal title
            document.getElementById('courseDetailsLabel').textContent = 'تفاصيل الدورة: ' + name;
            
            // Update description
            document.getElementById('courseDescription').innerHTML = description.replace(/\n/g, '<br>');
            
            // Update objectives
            document.getElementById('courseObjectives').innerHTML = objectives.replace(/\n/g, '<br>');
            
            // Handle video
            const videoDiv = document.getElementById('courseVideo');
            
            if (videoUrl && videoUrl.trim() !== '') {
                videoFrame.src = videoUrl;
                videoDiv.style.display = 'block';
            } else {
                videoDiv.style.display = 'none';
            }
            
            // Show modal with proper initialization
            const modalElement = document.getElementById('courseDetailsModal');
            currentModal = new bootstrap.Modal(modalElement, {
                backdrop: 'static',
                keyboard: true,
                focus: true
            });
            
            // Use setTimeout to ensure DOM is ready
            setTimeout(() => {
                currentModal.show();
            }, 10);
        }

        // Clean up video when modal is hidden
        document.getElementById('courseDetailsModal').addEventListener('hidden.bs.modal', function () {
            const videoFrame = document.getElementById('videoFrame');
            videoFrame.src = '';
            currentModal = null;
        });

        // Prevent modal from shaking on mouse move
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('courseDetailsModal');
            if (modal) {
                modal.addEventListener('show.bs.modal', function() {
                    document.body.style.overflow = 'hidden';
                });
                
                modal.addEventListener('hidden.bs.modal', function() {
                    document.body.style.overflow = 'auto';
                });
            }
        });
    </script>
</x-app-layout>
