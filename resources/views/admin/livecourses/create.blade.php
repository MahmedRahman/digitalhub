<x-app-layout>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">إضافة دورة مباشرة جديدة</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.livecourses.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم الدورة</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">تفاصيل الدورة</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="objectives" class="form-label">محاور الدورة</label>
                        <textarea class="form-control @error('objectives') is-invalid @enderror" 
                                  id="objectives" name="objectives" rows="4">{{ old('objectives') }}</textarea>
                        <small class="form-text text-muted">يمكنك كتابة كل محور في سطر جديد</small>
                        @error('objectives')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="video_url" class="form-label">رابط الفيديو التعريفي</label>
                        <input type="url" class="form-control @error('video_url') is-invalid @enderror" 
                               id="video_url" name="video_url" value="{{ old('video_url') }}">
                        <small class="form-text text-muted">يمكنك إضافة رابط يوتيوب أو فيميو</small>
                        @error('video_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="material_url" class="form-label">رابط المتريال</label>
                        <input type="url" class="form-control @error('material_url') is-invalid @enderror" 
                               id="material_url" name="material_url" value="{{ old('material_url') }}">
                        @error('material_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="powerpoint_url" class="form-label">رابط البوربوينت</label>
                        <input type="url" class="form-control @error('powerpoint_url') is-invalid @enderror" 
                               id="powerpoint_url" name="powerpoint_url" value="{{ old('powerpoint_url') }}">
                        @error('powerpoint_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="{{ route('admin.livecourses.index') }}" class="btn btn-secondary">رجوع</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
