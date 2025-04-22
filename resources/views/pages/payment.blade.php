<x-main-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white py-16 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('/img/pattern.svg')] opacity-10"></div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-500 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-indigo-600 rounded-full opacity-20 blur-3xl"></div>
        </div>
        
        <!-- Content -->
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <!-- Text Content -->
                <div class="w-full md:w-3/5 text-center md:text-right">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm text-white text-sm font-medium mb-6">
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                        <span>الدفع الآمن والسريع</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">مرحباً بك في صفحة الدفع</h1>
                    <p class="text-lg md:text-xl text-white/80 max-w-xl mx-auto md:mx-0 leading-relaxed mb-8">نوفر لك طرق دفع متنوعة وآمنة لتسهيل عملية الدفع بكل سهولة</p>
                </div>
                
                <!-- Image/Icon -->
                <div class="w-full md:w-2/5 flex justify-center">
                    <div class="relative">
                        <div class="absolute inset-0 bg-white/10 rounded-full blur-3xl"></div>
                        <div class="relative bg-white/10 backdrop-blur-md p-10 rounded-full border border-white/20 shadow-[0_0_40px_rgba(66,153,225,0.5)]">
                            <i class="fas fa-credit-card text-7xl text-white"></i>
                        </div>
                        <div class="absolute -top-6 -right-6 w-12 h-12 bg-blue-400 rounded-full opacity-70 animate-pulse"></div>
                        <div class="absolute -bottom-4 -left-4 w-8 h-8 bg-indigo-400 rounded-full opacity-70 animate-pulse delay-300"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Payment Methods Section -->
    <section class="container mx-auto py-16 px-4" dir="rtl">
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium mb-4">
                <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                <span>خيارات متعددة</span>
            </div>
            <h2 class="text-3xl font-bold mb-4 text-gray-800">طرق الدفع المتاحة</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">اختر طريقة الدفع المناسبة لك من الخيارات التالية</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Mobile Payment Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden group hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="relative overflow-hidden">
                    <div class="h-3 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                    <div class="p-5 flex items-center border-b border-gray-100">
                        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center ml-4">
                            <i class="fas fa-mobile-alt text-blue-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">الدفع عبر الهاتف</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <div class="flex items-center mb-3">
                            <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ml-3">
                                <i class="fas fa-wallet text-blue-600 text-xs"></i>
                            </div>
                            <span class="font-medium text-gray-700">فودافون كاش</span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200 group-hover:border-blue-200 transition-all duration-300">
                            <span class="font-mono font-medium text-lg select-all">01027007899</span>
                            <button class="w-8 h-8 rounded-full bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 flex items-center justify-center transition-colors duration-200" 
                                    onclick="navigator.clipboard.writeText('01027007899'); this.innerHTML = '<i class=\'fas fa-check text-green-500\'></i>'; setTimeout(() => this.innerHTML = '<i class=\'far fa-copy\'></i>', 1000)" 
                                    title="نسخ">
                                <i class="far fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-start text-sm text-gray-600 bg-blue-50 p-4 rounded-lg border-r-4 border-blue-500">
                        <i class="fas fa-info-circle text-blue-500 mt-1 ml-3"></i>
                        <span>بعد التحويل، أرسل صورة للإيصال على واتساب</span>
                    </div>
                </div>
            </div>

            <!-- Bank Transfer Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden group hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="relative overflow-hidden">
                    <div class="h-3 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                    <div class="p-5 flex items-center border-b border-gray-100">
                        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center ml-4">
                            <i class="fas fa-university text-blue-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">التحويل البنكي</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-500">اسم البنك</span>
                            <span class="font-medium">بنك الإسكندرية</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-500">رقم الحساب</span>
                            <div class="flex items-center">
                                <span class="font-mono font-medium select-all">202069901001</span>
                                <button class="w-6 h-6 rounded-full bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 flex items-center justify-center transition-colors duration-200 mr-2" 
                                        onclick="navigator.clipboard.writeText('202069901001'); this.innerHTML = '<i class=\'fas fa-check text-green-500\'></i>'; setTimeout(() => this.innerHTML = '<i class=\'far fa-copy\'></i>', 1000)" 
                                        title="نسخ">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-500">اسم الحساب</span>
                            <span class="font-medium">ديجيتال هب</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-500">رمز السويفت</span>
                            <div class="flex items-center">
                                <span class="font-mono font-medium select-all">ALEXEGCXXXX</span>
                                <button class="w-6 h-6 rounded-full bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 flex items-center justify-center transition-colors duration-200 mr-2" 
                                        onclick="navigator.clipboard.writeText('ALEXEGCXXXX'); this.innerHTML = '<i class=\'fas fa-check text-green-500\'></i>'; setTimeout(() => this.innerHTML = '<i class=\'far fa-copy\'></i>', 1000)" 
                                        title="نسخ">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start text-sm text-gray-600 bg-blue-50 p-4 rounded-lg border-r-4 border-blue-500">
                        <i class="fas fa-info-circle text-blue-500 mt-1 ml-3"></i>
                        <span>يرجى ذكر رقم الطلب في تفاصيل التحويل</span>
                    </div>
                </div>
            </div>

            <!-- Digital Wallet Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden group hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="relative overflow-hidden">
                    <div class="h-3 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                    <div class="p-5 flex items-center border-b border-gray-100">
                        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center ml-4">
                            <i class="fas fa-wallet text-blue-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">المحفظة الإلكترونية</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <div class="flex items-center mb-3">
                            <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ml-3">
                                <i class="fas fa-credit-card text-blue-600 text-xs"></i>
                            </div>
                            <span class="font-medium text-gray-700">انستا باي</span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200 group-hover:border-blue-200 transition-all duration-300">
                            <span class="font-mono font-medium text-lg select-all">digitalhub@instapay</span>
                            <button class="w-8 h-8 rounded-full bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 flex items-center justify-center transition-colors duration-200" 
                                    onclick="navigator.clipboard.writeText('digitalhub@instapay'); this.innerHTML = '<i class=\'fas fa-check text-green-500\'></i>'; setTimeout(() => this.innerHTML = '<i class=\'far fa-copy\'></i>', 1000)" 
                                    title="نسخ">
                                <i class="far fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="flex items-center mb-3">
                            <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ml-3">
                                <i class="fas fa-envelope text-blue-600 text-xs"></i>
                            </div>
                            <span class="font-medium text-gray-700">البريد الإلكتروني</span>
                        </div>
                        <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200 group-hover:border-blue-200 transition-all duration-300">
                            <span class="font-mono font-medium text-lg select-all">payments@digitalhub.com</span>
                            <button class="w-8 h-8 rounded-full bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 flex items-center justify-center transition-colors duration-200" 
                                    onclick="navigator.clipboard.writeText('payments@digitalhub.com'); this.innerHTML = '<i class=\'fas fa-check text-green-500\'></i>'; setTimeout(() => this.innerHTML = '<i class=\'far fa-copy\'></i>', 1000)" 
                                    title="نسخ">
                                <i class="far fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Invoice Form Section -->
<section class="container mx-auto py-16 px-4" dir="rtl">
    <div class="text-center mb-12">
        <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium mb-4">
            <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
            <span>إرسال فاتورة</span>
        </div>
        <h2 class="text-3xl font-bold mb-4 text-gray-800">إضافة فاتورة جديدة</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">قم بملئ النموذج التالي لإرسال فاتورتك</p>
    </div>
    
    <!-- Success Message Modal (hidden by default) -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-xl p-8 max-w-md mx-auto transform transition-all">
            <div class="text-center">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check-circle text-green-500 text-5xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">تم إرسال طلب الدفع بنجاح!</h3>
                <p class="text-gray-600 mb-6">تم استلام طلب الدفع الخاص بك وسيتم مراجعته قريباً. سنرسل لك إشعاراً عبر البريد الإلكتروني الذي أدخلته عند معالجة الطلب. لا حاجة للتسجيل في الموقع.</p>
                <button type="button" onclick="closeModal()" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-300 focus:outline-none">
                    <i class="fas fa-times-circle ml-2"></i>إغلاق
                </button>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-8 md:p-10 max-w-5xl mx-auto">
        <form id="paymentForm" action="{{ route('admin.invoices.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Name Field -->
                <div class="relative">
                    <label for="name" class="block text-gray-700 font-medium mb-2 flex items-center">
                        <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ml-2">
                            <i class="fas fa-user text-blue-600 text-xs"></i>
                        </div>
                        الاسم <span class="text-red-500 mr-1">*</span>
                    </label>
                    <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('name') border-red-500 @enderror" 
                        id="name" name="name" value="{{ old('name') }}" placeholder="الاسم الكامل" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Phone Field -->
                <div class="relative">
                    <label for="phone" class="block text-gray-700 font-medium mb-2 flex items-center">
                        <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ml-2">
                            <i class="fas fa-phone-alt text-blue-600 text-xs"></i>
                        </div>
                        رقم الهاتف <span class="text-red-500 mr-1">*</span>
                    </label>
                    <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('phone') border-red-500 @enderror" 
                        id="phone" name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX" required>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email Field -->
                <div class="relative">
                    <label for="email" class="block text-gray-700 font-medium mb-2 flex items-center">
                        <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ml-2">
                            <i class="fas fa-envelope text-blue-600 text-xs"></i>
                        </div>
                        البريد الإلكتروني <span class="text-red-500 mr-1">*</span>
                    </label>
                    <input type="email" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('email') border-red-500 @enderror" 
                        id="email" name="email" value="{{ old('email') }}" placeholder="example@domain.com" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Invoice Time Field -->
                <div class="relative">
                    <label for="invoicetime" class="block text-gray-700 font-medium mb-2 flex items-center">
                        <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ml-2">
                            <i class="fas fa-calendar-alt text-blue-600 text-xs"></i>
                        </div>
                        تاريخ ووقت الفاتورة <span class="text-red-500 mr-1">*</span>
                    </label>
                    <input type="datetime-local" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('invoicetime') border-red-500 @enderror" 
                        id="invoicetime" name="invoicetime" value="{{ old('invoicetime') ?? now()->format('Y-m-d\\TH:i') }}" required>
                    @error('invoicetime')
                        <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Invoice Value Field -->
                <div class="relative">
                    <label for="invoicevalue" class="block text-gray-700 font-medium mb-2 flex items-center">
                        <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ml-2">
                            <i class="fas fa-money-bill-wave text-blue-600 text-xs"></i>
                        </div>
                        قيمة الفاتورة <span class="text-red-500 mr-1">*</span>
                    </label>
                    <div class="flex">
                        <input type="number" class="flex-1 px-4 py-3 border border-gray-200 rounded-r-none rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('invoicevalue') border-red-500 @enderror" 
                            id="invoicevalue" name="invoicevalue" value="{{ old('invoicevalue') }}" step="0.01" min="0" placeholder="0.00" required>
                        <span class="inline-flex items-center px-4 py-3 text-gray-700 bg-gray-50 border border-r-0 border-gray-200 rounded-l-none rounded-r-lg font-medium">ج.م</span>
                    </div>
                    @error('invoicevalue')
                        <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Invoice Type Field -->
                <div class="relative">
                    <label for="invoicetype" class="block text-gray-700 font-medium mb-2 flex items-center">
                        <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ml-2">
                            <i class="fas fa-tag text-blue-600 text-xs"></i>
                        </div>
                        نوع الفاتورة <span class="text-red-500 mr-1">*</span>
                    </label>
                    <select class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('invoicetype') border-red-500 @enderror" 
                        id="invoicetype" name="invoicetype" required>
                        <option value="">اختر نوع الفاتورة</option>
                        <option value="course" {{ old('invoicetype') == 'course' ? 'selected' : '' }}>كورس</option>
                        <option value="subscription" {{ old('invoicetype') == 'subscription' ? 'selected' : '' }}>اشتراك</option>
                        <option value="service" {{ old('invoicetype') == 'service' ? 'selected' : '' }}>خدمة</option>
                        <option value="other" {{ old('invoicetype') == 'other' ? 'selected' : '' }}>أخرى</option>
                    </select>
                    @error('invoicetype')
                        <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Invoice Image Field -->
            <div class="relative bg-gray-50 p-6 rounded-lg border border-gray-200 mt-8">
                <label for="invoiceimage" class="block text-gray-700 font-medium mb-3 flex items-center">
                    <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ml-2">
                        <i class="fas fa-image text-blue-600 text-xs"></i>
                    </div>
                    صورة الفاتورة
                </label>
                <div class="flex items-center justify-center w-full">
                    <label for="invoiceimage" class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-white hover:bg-gray-50 hover:border-blue-300 transition-all duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-blue-50 mb-3">
                                <i class="fas fa-cloud-upload-alt text-3xl text-blue-500"></i>
                            </div>
                            <p class="text-sm text-gray-600 font-medium">اسحب وأفلت الملف هنا أو انقر للتحميل</p>
                            <p class="text-xs text-gray-500 mt-2">يمكنك رفع صورة بصيغة JPG, PNG, GIF بحجم أقصى 2 ميجابايت</p>
                        </div>
                        <input type="file" class="hidden" id="invoiceimage" name="invoiceimage" accept="image/*">
                    </label>
                </div>
                @error('invoiceimage')
                    <p class="text-red-500 text-sm mt-3 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
            </div>
            
            <!-- Invoice Notes Field -->
            <div class="relative mt-8">
                <label for="invoicenote" class="block text-gray-700 font-medium mb-2 flex items-center">
                    <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center ml-2">
                        <i class="fas fa-sticky-note text-blue-600 text-xs"></i>
                    </div>
                    ملاحظات
                </label>
                <textarea class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('invoicenote') border-red-500 @enderror" 
                    id="invoicenote" name="invoicenote" rows="4" placeholder="أي ملاحظات إضافية ترغب في إضافتها">{{ old('invoicenote') }}</textarea>
                @error('invoicenote')
                    <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
            </div>
            
            <!-- Submit Button -->
            <div class="flex justify-center mt-10">
                <button type="submit" id="submitBtn" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-lg hover:shadow-lg transition-all duration-300 flex items-center text-lg shadow-md">
                    <i class="fas fa-paper-plane ml-2"></i>إرسال الفاتورة
                </button>
            </div>
        </form>
    </div>
</section>
    
    <div class="max-w-7xl mx-auto px-4 pb-16" dir="rtl">

        <!-- Payment Methods Section -->
        <section class="mb-16" id="payment-methods">
            <header class="text-center mb-10">
                <h2 class="text-3xl font-bold mb-3 text-gray-800">طرق الدفع المتاحة</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">اختر طريقة الدفع المناسبة لك من الخيارات التالية</p>
                <div class="w-24 h-1 bg-primary mx-auto mt-4 rounded-full"></div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Mobile Payment Method -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md group">
                    <div class="bg-gradient-to-r from-primary-light to-primary p-5 text-white">
                        <div class="flex items-center">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-white bg-opacity-20 ml-3">
                                <i class="fas fa-mobile-alt text-white text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold">الدفع عبر الهاتف</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="mb-5">
                            <div class="flex items-center mb-3">
                                <i class="fas fa-wallet text-primary text-sm ml-2"></i>
                                <span class="font-medium text-gray-700">فودافون كاش</span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200 group-hover:border-primary transition-all duration-200">
                                <span class="font-mono font-medium text-lg select-all">01027007899</span>
                                <button class="text-gray-400 hover:text-primary transition-colors duration-200 p-2" 
                                        onclick="navigator.clipboard.writeText('01027007899'); this.innerHTML = '<i class=\'fas fa-check text-green-500\'></i>'; setTimeout(() => this.innerHTML = '<i class=\'far fa-copy\'></i>', 1000)" 
                                        title="نسخ">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-start text-sm text-gray-500 bg-gray-50 p-4 rounded-lg">
                            <i class="fas fa-info-circle text-primary mt-1 ml-2"></i>
                            <span>بعد التحويل، أرسل صورة للإيصال على واتساب</span>
                        </div>
                    </div>
                </div>

                <!-- Bank Transfer -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md group">
                    <div class="bg-gradient-to-r from-primary-light to-primary p-5 text-white">
                        <div class="flex items-center">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-white bg-opacity-20 ml-3">
                                <i class="fas fa-university text-white text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold">التحويل البنكي</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3 mb-5">
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-500">اسم البنك</span>
                                <span class="font-medium">بنك الإسكندرية</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-500">رقم الحساب</span>
                                <div class="flex items-center">
                                    <span class="font-mono font-medium select-all">202069901001</span>
                                    <button class="text-gray-400 hover:text-primary transition-colors duration-200 mr-2" 
                                            onclick="navigator.clipboard.writeText('202069901001'); this.innerHTML = '<i class=\'fas fa-check text-green-500\'></i>'; setTimeout(() => this.innerHTML = '<i class=\'far fa-copy\'></i>', 1000)" 
                                            title="نسخ">
                                        <i class="far fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-500">اسم الحساب</span>
                                <span class="font-medium">ديجيتال هب</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-500">رمز السويفت</span>
                                <div class="flex items-center">
                                    <span class="font-mono font-medium select-all">ALEXEGCXXXX</span>
                                    <button class="text-gray-400 hover:text-primary transition-colors duration-200 mr-2" 
                                            onclick="navigator.clipboard.writeText('ALEXEGCXXXX'); this.innerHTML = '<i class=\'fas fa-check text-green-500\'></i>'; setTimeout(() => this.innerHTML = '<i class=\'far fa-copy\'></i>', 1000)" 
                                            title="نسخ">
                                        <i class="far fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-start text-sm text-gray-500 bg-gray-50 p-4 rounded-lg">
                            <i class="fas fa-info-circle text-primary mt-1 ml-2"></i>
                            <span>يرجى ذكر رقم الطلب في تفاصيل التحويل</span>
                        </div>
                    </div>
                </div>

                <!-- Digital Wallet -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md group">
                    <div class="bg-gradient-to-r from-primary-light to-primary p-5 text-white">
                        <div class="flex items-center">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-white bg-opacity-20 ml-3">
                                <i class="fas fa-wallet text-white text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold">المحفظة الإلكترونية</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="mb-5">
                            <div class="flex items-center mb-3">
                                <i class="fas fa-credit-card text-primary text-sm ml-2"></i>
                                <span class="font-medium text-gray-700">انستا باي</span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200 group-hover:border-primary transition-all duration-200">
                                <span class="font-mono font-medium text-lg select-all">digitalhub@instapay</span>
                                <button class="text-gray-400 hover:text-primary transition-colors duration-200 p-2" 
                                        onclick="navigator.clipboard.writeText('digitalhub@instapay'); this.innerHTML = '<i class=\'fas fa-check text-green-500\'></i>'; setTimeout(() => this.innerHTML = '<i class=\'far fa-copy\'></i>', 1000)" 
                                        title="نسخ">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-5">
                            <div class="flex items-center mb-3">
                                <i class="fas fa-envelope text-primary text-sm ml-2"></i>
                                <span class="font-medium text-gray-700">البريد الإلكتروني</span>
                            </div>
                            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200 group-hover:border-primary transition-all duration-200">
                                <span class="font-mono font-medium text-lg select-all">payments@digitalhub.com</span>
                                <button class="text-gray-400 hover:text-primary transition-colors duration-200 p-2" 
                                        onclick="navigator.clipboard.writeText('payments@digitalhub.com'); this.innerHTML = '<i class=\'fas fa-check text-green-500\'></i>'; setTimeout(() => this.innerHTML = '<i class=\'far fa-copy\'></i>', 1000)" 
                                        title="نسخ">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Invoice Form Section -->
        <section class="mb-16">
            <header class="text-center mb-10">
                <h2 class="text-3xl font-bold mb-3 text-gray-800">إضافة فاتورة جديدة</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">قم بملئ النموذج التالي لإرسال فاتورتك</p>
                <div class="w-24 h-1 bg-primary mx-auto mt-4 rounded-full"></div>
            </header>
            
            <div class="bg-white rounded-xl shadow-sm overflow-hidden p-8">
            
            <form action="{{ route('admin.invoices.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="relative">
                        <label for="name" class="block text-gray-700 font-medium mb-2 flex items-center">
                            <i class="fas fa-user text-primary mr-2"></i>
                            الاسم <span class="text-red-500 mr-1">*</span>
                        </label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('name') border-red-500 @enderror" 
                            id="name" name="name" value="{{ old('name') }}" placeholder="الاسم الكامل" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label for="phone" class="block text-gray-700 font-medium mb-2 flex items-center">
                            <i class="fas fa-phone-alt text-primary mr-2"></i>
                            رقم الهاتف <span class="text-red-500 mr-1">*</span>
                        </label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('phone') border-red-500 @enderror" 
                            id="phone" name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX" required>
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label for="email" class="block text-gray-700 font-medium mb-2 flex items-center">
                            <i class="fas fa-envelope text-primary mr-2"></i>
                            البريد الإلكتروني <span class="text-red-500 mr-1">*</span>
                        </label>
                        <input type="email" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('email') border-red-500 @enderror" 
                            id="email" name="email" value="{{ old('email') }}" placeholder="example@domain.com" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label for="invoicetime" class="block text-gray-700 font-medium mb-2 flex items-center">
                            <i class="fas fa-calendar-alt text-primary mr-2"></i>
                            تاريخ ووقت الفاتورة <span class="text-red-500 mr-1">*</span>
                        </label>
                        <input type="datetime-local" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('invoicetime') border-red-500 @enderror" 
                            id="invoicetime" name="invoicetime" value="{{ old('invoicetime') ?? now()->format('Y-m-d\\TH:i') }}" required>
                        @error('invoicetime')
                            <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label for="invoicevalue" class="block text-gray-700 font-medium mb-2 flex items-center">
                            <i class="fas fa-money-bill-wave text-primary mr-2"></i>
                            قيمة الفاتورة <span class="text-red-500 mr-1">*</span>
                        </label>
                        <div class="flex">
                            <input type="number" class="flex-1 px-4 py-3 border border-gray-200 rounded-r-none rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('invoicevalue') border-red-500 @enderror" 
                                id="invoicevalue" name="invoicevalue" value="{{ old('invoicevalue') }}" step="0.01" min="0" placeholder="0.00" required>
                            <span class="inline-flex items-center px-4 py-3 text-gray-700 bg-gray-50 border border-r-0 border-gray-200 rounded-l-none rounded-r-lg font-medium">ج.م</span>
                        </div>
                        @error('invoicevalue')
                            <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label for="invoicetype" class="block text-gray-700 font-medium mb-2 flex items-center">
                            <i class="fas fa-tag text-primary mr-2"></i>
                            نوع الفاتورة <span class="text-red-500 mr-1">*</span>
                        </label>
                        <select class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('invoicetype') border-red-500 @enderror" 
                            id="invoicetype" name="invoicetype" required>
                            <option value="">اختر نوع الفاتورة</option>
                            <option value="course" {{ old('invoicetype') == 'course' ? 'selected' : '' }}>كورس</option>
                            <option value="subscription" {{ old('invoicetype') == 'subscription' ? 'selected' : '' }}>اشتراك</option>
                            <option value="service" {{ old('invoicetype') == 'service' ? 'selected' : '' }}>خدمة</option>
                            <option value="other" {{ old('invoicetype') == 'other' ? 'selected' : '' }}>أخرى</option>
                        </select>
                        @error('invoicetype')
                            <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="relative bg-gray-50 p-6 rounded-lg border border-gray-200 mt-6">
                    <label for="invoiceimage" class="block text-gray-700 font-medium mb-3 flex items-center">
                        <i class="fas fa-image text-primary mr-2"></i>
                        صورة الفاتورة
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="invoiceimage" class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-white hover:bg-gray-50 hover:border-primary transition-all duration-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-primary bg-opacity-10 mb-3">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-primary"></i>
                                </div>
                                <p class="text-sm text-gray-600 font-medium">اسحب وأفلت الملف هنا أو انقر للتحميل</p>
                                <p class="text-xs text-gray-500 mt-2">يمكنك رفع صورة بصيغة JPG, PNG, GIF بحجم أقصى 2 ميجابايت</p>
                            </div>
                            <input type="file" class="hidden" id="invoiceimage" name="invoiceimage" accept="image/*">
                        </label>
                    </div>
                    @error('invoiceimage')
                        <p class="text-red-500 text-sm mt-3 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div class="relative mt-6">
                    <label for="invoicenote" class="block text-gray-700 font-medium mb-2 flex items-center">
                        <i class="fas fa-sticky-note text-primary mr-2"></i>
                        ملاحظات
                    </label>
                    <textarea class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('invoicenote') border-red-500 @enderror" 
                        id="invoicenote" name="invoicenote" rows="4" placeholder="أي ملاحظات إضافية ترغب في إضافتها">{{ old('invoicenote') }}</textarea>
                    @error('invoicenote')
                        <p class="text-red-500 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center mt-10">
                    <button type="submit" class="px-8 py-4 bg-gradient-to-r from-primary to-primary-dark text-white font-bold rounded-lg hover:shadow-lg transition-all duration-300 flex items-center text-lg">
                        <i class="fas fa-paper-plane ml-2"></i>إرسال الفاتورة
                    </button>
                </div>
            </form>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-20 bg-gradient-to-b from-white to-blue-50" dir="rtl">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium mb-4">
                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                        <span>مميزات فريدة</span>
                    </div>
                    <h2 class="text-3xl font-bold mb-4 text-gray-800">لماذا تختار نظام الدفع لدينا؟</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">نقدم لك مجموعة من المميزات التي تجعل نظام الدفع لدينا الأفضل</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature Card 1 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <i class="fas fa-shield-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 text-center">آمن وموثوق</h3>
                        <p class="text-gray-600 text-center">نظام دفع آمن بالكامل مع تشفير لجميع البيانات والمعاملات</p>
                    </div>
                    
                    <!-- Feature Card 2 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <i class="fas fa-bolt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 text-center">سريع وفعال</h3>
                        <p class="text-gray-600 text-center">معالجة فورية للمدفوعات وتأكيد الطلبات في غضون دقائق من الدفع</p>
                    </div>
                    
                    <!-- Feature Card 3 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <i class="fas fa-hand-holding-usd text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 text-center">خيارات متعددة</h3>
                        <p class="text-gray-600 text-center">طرق دفع متنوعة تناسب جميع العملاء من التحويل البنكي إلى المحافظ الإلكترونية</p>
                    </div>
                    
                    <!-- Feature Card 4 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <i class="fas fa-headset text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 text-center">دعم متواصل</h3>
                        <p class="text-gray-600 text-center">فريق دعم متخصص للمساعدة في أي مشكلة متعلقة بالدفع على مدار الساعة</p>
                    </div>
                </div>
                
                <!-- Additional Features -->
                <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature Box 1 -->
                    <div class="bg-blue-50 rounded-xl p-6 border-r-4 border-blue-500 flex items-start">
                        <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center ml-4 shadow-sm">
                            <i class="fas fa-sync-alt text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-800">تحديثات فورية</h3>
                            <p class="text-gray-600">تلقي تحديثات فورية عن حالة الدفع والمعاملات عبر البريد الإلكتروني</p>
                        </div>
                    </div>
                    
                    <!-- Feature Box 2 -->
                    <div class="bg-blue-50 rounded-xl p-6 border-r-4 border-blue-500 flex items-start">
                        <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center ml-4 shadow-sm">
                            <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-800">تتبع المدفوعات</h3>
                            <p class="text-gray-600">لوحة تحكم متكاملة لمتابعة جميع المدفوعات والفواتير السابقة والحالية</p>
                        </div>
                    </div>
                    
                    <!-- Feature Box 3 -->
                    <div class="bg-blue-50 rounded-xl p-6 border-r-4 border-blue-500 flex items-start">
                        <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center ml-4 shadow-sm">
                            <i class="fas fa-file-invoice-dollar text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-800">تقارير مفصلة</h3>
                            <p class="text-gray-600">إمكانية تصدير تقارير مفصلة عن جميع المعاملات المالية بصيغ PDF أو Excel</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Important Information Section -->
        <section class="container mx-auto py-16 px-4" dir="rtl">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium mb-4">
                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                    <span>معلومات هامة</span>
                </div>
                <h2 class="text-3xl font-bold mb-4 text-gray-800">ما يجب أن تعرفه قبل الدفع</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">اقرأ هذه المعلومات الهامة قبل إتمام عملية الدفع</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-8 max-w-5xl mx-auto">
                <!-- Info Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Info Card 1 -->
                    <div class="bg-blue-50 p-5 rounded-xl border-r-4 border-blue-500 hover:shadow-md transition-all duration-300">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center ml-4 shadow-sm">
                                <i class="fas fa-info-circle text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2">معلومات الدفع</h3>
                                <p class="text-gray-600">يمكنك إرسال طلب الدفع مباشرة دون الحاجة للتسجيل مسبقاً. فقط قم بملء النموذج بالمعلومات المطلوبة.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info Card 2 -->
                    <div class="bg-blue-50 p-5 rounded-xl border-r-4 border-blue-500 hover:shadow-md transition-all duration-300">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center ml-4 shadow-sm">
                                <i class="fas fa-clock text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2">وقت التأكيد</h3>
                                <p class="text-gray-600">بعد إجراء الدفع، يرجى السماح بمدة تصل إلى 24 ساعة للتأكيد. ستتلقى إشعارًا بالبريد الإلكتروني بمجرد معالجة الدفع.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info Card 3 -->
                    <div class="bg-blue-50 p-5 rounded-xl border-r-4 border-blue-500 hover:shadow-md transition-all duration-300">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center ml-4 shadow-sm">
                                <i class="fas fa-globe text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2">المدفوعات الدولية</h3>
                                <p class="text-gray-600">بالنسبة للمدفوعات الدولية، قد تنطبق رسوم إضافية حسب البنك الذي تتعامل معه. يرجى التحقق من البنك قبل التحويل.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info Card 4 -->
                    <div class="bg-blue-50 p-5 rounded-xl border-r-4 border-blue-500 hover:shadow-md transition-all duration-300">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center ml-4 shadow-sm">
                                <i class="fas fa-money-bill-wave text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2">العملة</h3>
                                <p class="text-gray-600">جميع الأسعار بالجنيه المصري (EGP) ما لم يذكر خلاف ذلك. للعملات الأخرى، سيتم التحويل بسعر الصرف الحالي.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- FAQ Accordion -->
                <div class="mt-10">
                    <h3 class="text-xl font-bold mb-6 text-gray-800 flex items-center">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center ml-2">
                            <i class="fas fa-question text-blue-600 text-sm"></i>
                        </div>
                        الأسئلة الشائعة
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <button class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition-colors duration-200 focus:outline-none" 
                                    onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('i').classList.toggle('fa-plus'); this.querySelector('i').classList.toggle('fa-minus');">
                                <span class="font-medium text-gray-800">ما هي طرق الدفع المتاحة؟</span>
                                <i class="fas fa-plus text-blue-600"></i>
                            </button>
                            <div class="p-4 border-t border-gray-200 hidden">
                                <p class="text-gray-600">نقبل الدفع عبر التحويل البنكي، فودافون كاش، والمحافظ الإلكترونية مثل انستا باي.</p>
                            </div>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <button class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition-colors duration-200 focus:outline-none" 
                                    onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('i').classList.toggle('fa-plus'); this.querySelector('i').classList.toggle('fa-minus');">
                                <span class="font-medium text-gray-800">هل يمكنني الحصول على استرداد؟</span>
                                <i class="fas fa-plus text-blue-600"></i>
                            </button>
                            <div class="p-4 border-t border-gray-200 hidden">
                                <p class="text-gray-600">نعم، يمكنك الحصول على استرداد كامل في غضون 7 أيام من تاريخ الدفع. بعد ذلك، قد تطبق رسوم إدارية.</p>
                            </div>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <button class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition-colors duration-200 focus:outline-none" 
                                    onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('i').classList.toggle('fa-plus'); this.querySelector('i').classList.toggle('fa-minus');">
                                <span class="font-medium text-gray-800">ماذا لو واجهت مشكلة في الدفع؟</span>
                                <i class="fas fa-plus text-blue-600"></i>
                            </button>
                            <div class="p-4 border-t border-gray-200 hidden">
                                <p class="text-gray-600">يمكنك التواصل مع فريق الدعم على البريد الإلكتروني support@digitalhub.com أو الاتصال برقم 01027007899 خلال ساعات العمل.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </section>

        <!-- CTA Section -->
        <section class="container mx-auto py-16 px-4" dir="rtl">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl overflow-hidden shadow-lg">
                <div class="relative">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-white"></div>
                        <div class="absolute left-20 bottom-0 w-64 h-64 rounded-full bg-white"></div>
                        <div class="absolute right-1/3 top-1/4 w-24 h-24 rounded-full bg-white"></div>
                    </div>
                    
                    <div class="relative z-10 py-16 px-8 md:px-16 flex flex-col md:flex-row items-center justify-between">
                        <div class="text-white text-center md:text-right mb-8 md:mb-0 md:ml-8 max-w-2xl">
                            <h2 class="text-3xl md:text-4xl font-bold mb-4">بحاجة إلى مساعدة؟</h2>
                            <p class="text-lg opacity-90 mb-6">لأي استفسارات حول المدفوعات أو الفواتير، لا تتردد في التواصل مع فريق خدمة العملاء لدينا. نحن هنا لمساعدتك على مدار الساعة.</p>
                            
                            <div class="flex flex-wrap justify-center md:justify-start gap-4">
                                <a href="/contact" class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 transform inline-flex items-center text-lg">
                                    <i class="fas fa-headset ml-2"></i>الاتصال بنا
                                </a>
                                <a href="tel:01027007899" class="px-8 py-4 bg-blue-800 bg-opacity-50 text-white border border-white border-opacity-30 font-bold rounded-lg hover:bg-opacity-70 transition-all duration-300 hover:-translate-y-1 transform inline-flex items-center text-lg">
                                    <i class="fas fa-phone-alt ml-2"></i>01027007899
                                </a>
                            </div>
                        </div>
                        
                        <div class="hidden md:block">
                            <div class="w-60 h-60 bg-white bg-opacity-10 rounded-full flex items-center justify-center">
                                <div class="w-48 h-48 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                    <div class="w-36 h-36 bg-white rounded-full flex items-center justify-center shadow-lg">
                                        <i class="fas fa-comments text-blue-600 text-6xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    </div>
</x-main-layout>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* Animation for modal */
    .modal-enter {
        opacity: 0;
        transform: scale(0.9);
    }
    .modal-enter-active {
        opacity: 1;
        transform: scale(1);
        transition: opacity 300ms, transform 300ms;
    }
    .modal-exit {
        opacity: 1;
    }
    .modal-exit-active {
        opacity: 0;
        transform: scale(0.9);
        transition: opacity 300ms, transform 300ms;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    $(document).ready(function() {
        // Initialize AOS animation library
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Initialize Select2
        $('#invoicetype').select2({
            dir: "rtl",
            placeholder: "اختر نوع الفاتورة",
            allowClear: true
        });
        
        // File upload preview
        $('#invoiceimage').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const filePreview = `
                        <div class="mt-3 p-3 bg-blue-50 rounded-lg flex items-center">
                            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center ml-3 shadow-sm">
                                <i class="fas fa-file-image text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">${file.name}</p>
                                <p class="text-sm text-gray-500">${(file.size / 1024).toFixed(2)} KB</p>
                            </div>
                        </div>
                    `;
                    $(this).closest('.relative').append(filePreview);
                };
                reader.readAsDataURL(file);
            }
        });
        
        // Handle form submission
        $('#paymentForm').on('submit', function(e) {
            e.preventDefault();
            
            // Show loading state on button
            const submitBtn = $('#submitBtn');
            const originalText = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin ml-2"></i>جاري الإرسال...');
            submitBtn.prop('disabled', true);
            
            // Simulate form submission (for demo purposes)
            // In a real application, you would submit the form via AJAX
            setTimeout(function() {
                // Reset form
                $('#paymentForm')[0].reset();
                
                // Show success modal
                showModal();
                
                // Reset button state
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);
            }, 1500);
        });
    });
    
    // Function to show modal
    function showModal() {
        const modal = document.getElementById('successModal');
        modal.classList.remove('hidden');
        modal.classList.add('modal-enter');
        setTimeout(() => {
            modal.classList.remove('modal-enter');
            modal.classList.add('modal-enter-active');
        }, 10);
    }
    
    // Function to close modal
    function closeModal() {
        const modal = document.getElementById('successModal');
        modal.classList.remove('modal-enter-active');
        modal.classList.add('modal-exit');
        setTimeout(() => {
            modal.classList.remove('modal-exit');
            modal.classList.add('modal-exit-active');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('modal-exit-active');
            }, 300);
        }, 10);
    }
</script>
@endpush