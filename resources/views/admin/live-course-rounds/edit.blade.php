<x-app-layout>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">تعديل الجولة</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.live-course-rounds.update', $livecoursesround) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="livecourse_id" class="form-label">الدورة المباشرة</label>
                            <select class="form-select select2 @error('livecourse_id') is-invalid @enderror" 
                                    id="livecourse_id" name="livecourse_id" required>
                                <option value="">اختر الدورة</option>
                                @foreach($livecourses as $course)
                                    <option value="{{ $course->id }}" 
                                        {{ old('livecourse_id', $livecoursesround->livecourse_id) == $course->id ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('livecourse_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="instructor_id" class="form-label">المحاضر</label>
                            <select class="form-select select2 @error('instructor_id') is-invalid @enderror" 
                                    id="instructor_id" name="instructor_id" required>
                                <option value="">اختر المحاضر</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}" 
                                        {{ old('instructor_id', $livecoursesround->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                        {{ $instructor->name }}
                                        @if($instructor->specialization)
                                            - {{ $instructor->specialization->name }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('instructor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="round_name" class="form-label">اسم الجولة</label>
                            <input type="text" class="form-control @error('round_name') is-invalid @enderror" 
                                   id="round_name" name="round_name" 
                                   value="{{ old('round_name', $livecoursesround->round_name) }}" required>
                            @error('round_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">الحالة</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="upcoming" {{ old('status', $livecoursesround->status) == 'upcoming' ? 'selected' : '' }}>قادم</option>
                                <option value="ongoing" {{ old('status', $livecoursesround->status) == 'ongoing' ? 'selected' : '' }}>جاري</option>
                                <option value="completed" {{ old('status', $livecoursesround->status) == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">تاريخ البداية</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                   id="start_date" name="start_date" 
                                   value="{{ old('start_date', $livecoursesround->start_date->format('Y-m-d')) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">تاريخ النهاية</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                   id="end_date" name="end_date" 
                                   value="{{ old('end_date', $livecoursesround->end_date->format('Y-m-d')) }}" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="hours_count" class="form-label">عدد الساعات</label>
                            <input type="number" class="form-control @error('hours_count') is-invalid @enderror" 
                                   id="hours_count" name="hours_count" 
                                   value="{{ old('hours_count', $livecoursesround->hours_count) }}" required min="1">
                            @error('hours_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">السعر</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" 
                                   value="{{ old('price', $livecoursesround->price) }}" required min="0">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="notes" class="form-label">ملاحظات</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes', $livecoursesround->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                        <a href="{{ route('admin.live-course-rounds.index') }}" class="btn btn-secondary">رجوع</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                dir: 'rtl',
                language: 'ar',
            });
        });
    </script>
    @endpush
</x-app-layout>
