<x-main-layout>
    <div class="course-container">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="course-sidebar">
                    <!-- Course Info -->
                    <div class="course-info">
                        <h4 class="course-title">{{ $course->title }}</h4>
                        <div class="course-stats">
                            <div class="stat-item">
                                <i class="fas fa-book-open"></i>
                                <span>{{ $course->lessons->count() }} دروس</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $course->lessons->sum('video_duration') }} دقيقة</span>
                            </div>
                            @if($course->instructors->isNotEmpty())
                                <div class="stat-item">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>{{ $course->instructors->first()->name }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Progress Bar -->
                        <div class="course-progress">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="progress-label">تقدمك في الدورة</span>
                                <span class="progress-percentage">{{ $enrollment->progress }}%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" 
                                     role="progressbar" 
                                     style="width: {{ $enrollment->progress }}%" 
                                     aria-valuenow="{{ $enrollment->progress }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lessons List -->
                    <div class="lessons-list">
                        @forelse($course->lessons as $lessonItem)
                            <a href="#lesson-{{ $lessonItem->id }}" 
                               class="lesson-item {{ $loop->first ? 'active' : '' }}"
                               data-lesson-id="{{ $lessonItem->id }}">
                                <div class="lesson-content">
                                    <div class="lesson-number">{{ $loop->iteration }}</div>
                                    <div class="lesson-details">
                                        <h6 class="lesson-title">{{ $lessonItem->title }}</h6>
                                        <div class="lesson-meta">
                                            <span class="duration">
                                                <i class="fas fa-clock"></i>
                                                {{ $lessonItem->video_duration }} دقيقة
                                            </span>
                                            @if($lessonItem->is_free)
                                                <span class="badge-free">مجاني</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="lesson-status">
                                        @if($enrollment->hasCompleted($lessonItem))
                                            <i class="fas fa-circle-check text-success"></i>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-5">
                                <p class="text-muted">لا توجد دروس متاحة</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="course-main">
                    @forelse($course->lessons as $lessonItem)
                        <div id="lesson-{{ $lessonItem->id }}" class="main-lesson {{ !$loop->first ? 'd-none' : '' }}">
                            <!-- Lesson Header -->
                            <div class="lesson-header">
                                <h3>{{ $lessonItem->title }}</h3>
                                <div class="lesson-badges">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $lessonItem->video_duration }} دقيقة
                                    </span>
                                    @if($lessonItem->is_free)
                                        <span class="badge bg-success">
                                            <i class="fas fa-gift me-1"></i>
                                            درس مجاني
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Video Section -->
                            @if($lessonItem->video_url)
                                <div class="video-container">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{ $lessonItem->video_url }}" 
                                                allowfullscreen></iframe>
                                    </div>
                                </div>
                            @endif

                            <!-- Lesson Content -->
                            <div class="lesson-sections">
                                @if($lessonItem->description)
                                    <div class="content-section">
                                        <h5>
                                            <i class="fas fa-info-circle me-2"></i>
                                            وصف الدرس
                                        </h5>
                                        <div class="section-content">
                                            {{ $lessonItem->description }}
                                        </div>
                                    </div>
                                @endif

                                @if($lessonItem->content)
                                    <div class="content-section">
                                        <h5>
                                            <i class="fas fa-book me-2"></i>
                                            محتوى الدرس
                                        </h5>
                                        <div class="section-content">
                                            {!! $lessonItem->content !!}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="lesson-navigation">
                                @if(!$loop->first)
                                    <button class="btn btn-outline-primary prev-lesson" 
                                            data-lesson-id="{{ $course->lessons[$loop->index - 1]->id }}">
                                        <i class="fas fa-arrow-right me-2"></i>
                                        الدرس السابق
                                    </button>
                                @else
                                    <div></div>
                                @endif

                                @if(!$loop->last)
                                    <button class="btn btn-outline-primary next-lesson"
                                            data-lesson-id="{{ $course->lessons[$loop->index + 1]->id }}">
                                        الدرس التالي
                                        <i class="fas fa-arrow-left ms-2"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" 
                                 alt="No Lessons" 
                                 class="empty-lessons-icon">
                            <h4 class="mt-3">لا توجد دروس متاحة</h4>
                            <p class="text-muted">سيتم إضافة دروس قريباً</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        .course-container {
            min-height: calc(100vh - 65px);
            background-color: #f8f9fa;
        }

        /* Sidebar Styles */
        .course-sidebar {
            height: calc(100vh - 65px);
            overflow-y: auto;
            background-color: white;
            border-start: 1px solid #dee2e6;
        }

        .course-info {
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .course-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .course-stats {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .stat-item i {
            color: #0d6efd;
            width: 20px;
        }

        .course-progress {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #dee2e6;
        }

        .progress-label {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .progress-percentage {
            font-size: 0.875rem;
            font-weight: 600;
            color: #198754;
        }

        .progress {
            height: 8px;
            border-radius: 4px;
        }

        /* Lessons List Styles */
        .lessons-list {
            padding: 1rem 0;
        }

        .lesson-item {
            display: block;
            padding: 1rem 1.5rem;
            color: inherit;
            text-decoration: none;
            transition: all 0.2s;
        }

        .lesson-item:hover {
            background-color: #f8f9fa;
            color: inherit;
        }

        .lesson-item.active {
            background-color: #e9ecef;
            border-start: 3px solid #0d6efd;
        }

        .lesson-content {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .lesson-number {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e9ecef;
            color: #495057;
            border-radius: 50%;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .lesson-item.active .lesson-number {
            background-color: #0d6efd;
            color: white;
        }

        .lesson-details {
            flex: 1;
        }

        .lesson-title {
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
            color: #2c3e50;
        }

        .lesson-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.8rem;
            color: #6c757d;
        }

        .badge-free {
            padding: 0.25rem 0.5rem;
            background-color: #19875420;
            color: #198754;
            border-radius: 4px;
            font-size: 0.75rem;
        }

        /* Main Content Styles */
        .course-main {
            padding: 2rem;
            background-color: #f8f9fa;
        }

        .main-lesson {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .lesson-header {
            padding: 1.5rem;
            border-bottom: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .lesson-header h3 {
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .lesson-badges {
            display: flex;
            gap: 0.5rem;
        }

        .video-container {
            background-color: #000;
            border-bottom: 1px solid #dee2e6;
        }

        .lesson-sections {
            padding: 1.5rem;
        }

        .content-section {
            margin-bottom: 2rem;
        }

        .content-section:last-child {
            margin-bottom: 0;
        }

        .content-section h5 {
            color: #2c3e50;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .section-content {
            color: #495057;
            line-height: 1.7;
        }

        .lesson-navigation {
            display: flex;
            justify-content: space-between;
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        .empty-lessons-icon {
            width: 120px;
            opacity: 0.5;
        }

        /* Scrollbar Styles */
        .course-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .course-sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .course-sidebar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .course-sidebar::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lessonLinks = document.querySelectorAll('.lesson-item');
            const navButtons = document.querySelectorAll('.next-lesson, .prev-lesson');

            function showLesson(lessonId) {
                // Hide all lessons
                document.querySelectorAll('.main-lesson').forEach(content => {
                    content.classList.add('d-none');
                });
                
                // Show selected lesson
                const selectedLesson = document.querySelector(`#lesson-${lessonId}`);
                if (selectedLesson) {
                    selectedLesson.classList.remove('d-none');
                }

                // Update active state in sidebar
                lessonLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.dataset.lessonId === lessonId) {
                        link.classList.add('active');
                        link.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                });

                // Update URL hash
                window.location.hash = `lesson-${lessonId}`;
            }

            // Handle lesson link clicks
            lessonLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    showLesson(this.dataset.lessonId);
                });
            });

            // Handle navigation button clicks
            navButtons.forEach(button => {
                button.addEventListener('click', function() {
                    showLesson(this.dataset.lessonId);
                });
            });

            // Show lesson from URL hash on page load
            const hash = window.location.hash;
            if (hash) {
                const lessonId = hash.replace('#lesson-', '');
                showLesson(lessonId);
            }
        });
    </script>
</x-main-layout>
