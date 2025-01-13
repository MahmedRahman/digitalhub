@props(['instructor'])

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <h5 class="card-title mb-3">عدد الدورات</h5>
                <p class="display-4 mb-0">{{ $instructor->courses_count }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h5 class="card-title mb-3">عدد التخصصات</h5>
                <p class="display-4 mb-0">{{ $instructor->specializations->count() }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <h5 class="card-title mb-3">حالة المدرب</h5>
                <p class="display-4 mb-0">{{ $instructor->status_label }}</p>
            </div>
        </div>
    </div>
</div>
