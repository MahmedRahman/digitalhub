<x-main-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="display-4 mb-4">اتصل بنا</h1>
                
                <div class="row g-4">
                    <!-- معلومات الاتصال -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h2 class="h4 mb-4">معلومات الاتصال</h2>
                                
                                <div class="mb-4">
                                    <h3 class="h6 mb-2">العنوان</h3>
                                    <p class="mb-0">القاهرة، مصر</p>
                                </div>

                                <div class="mb-4">
                                    <h3 class="h6 mb-2">البريد الإلكتروني</h3>
                                    <p class="mb-0">
                                        <a href="mailto:info@digitalhub.eg" class="text-decoration-none">info@digitalhub.eg</a>
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <h3 class="h6 mb-2">الهاتف</h3>
                                    <p class="mb-0">
                                        <a href="tel:+201234567890" class="text-decoration-none" dir="ltr">+20 123 456 7890</a>
                                    </p>
                                </div>

                                <div>
                                    <h3 class="h6 mb-2">تابعنا على</h3>
                                    <div class="d-flex gap-2">
                                        <a href="#" class="btn btn-light">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="#" class="btn btn-light">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="#" class="btn btn-light">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <a href="#" class="btn btn-light">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- نموذج الاتصال -->
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h2 class="h4 mb-4">أرسل لنا رسالة</h2>
                                
                                <form action="{{ route('contact.send') }}" method="POST">
                                    @csrf
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">الاسم</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email" class="form-label">البريد الإلكتروني</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="subject" class="form-label">الموضوع</label>
                                            <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                                   id="subject" name="subject" value="{{ old('subject') }}" required>
                                            @error('subject')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="message" class="form-label">الرسالة</label>
                                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                                      id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-paper-plane me-2"></i>إرسال الرسالة
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
