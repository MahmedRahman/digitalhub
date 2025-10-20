<?php

namespace App\View\Components;

use App\Helpers\WhatsAppHelper;
use Illuminate\View\Component;

class WhatsAppButton extends Component
{
    public $courseTitle;
    public $price;
    public $buttonText;
    public $buttonClass;
    public $buttonSize;
    public $whatsappUrl;

    /**
     * Create a new component instance.
     *
     * @param string $courseTitle
     * @param float $price
     * @param string $buttonText
     * @param string $buttonClass
     * @param string $buttonSize
     */
    public function __construct($courseTitle, $price, $buttonText = null, $buttonClass = null, $buttonSize = 'md')
    {
        $this->courseTitle = $courseTitle;
        $this->price = $price;
        $this->buttonText = $buttonText ?: config('whatsapp.button_text', 'تسجيل عبر الواتساب');
        $this->buttonClass = $buttonClass ?: config('whatsapp.button_class', 'btn btn-success');
        $this->buttonSize = $buttonSize;
        
        // Generate the WhatsApp URL using the helper
        $this->whatsappUrl = WhatsAppHelper::generateCourseRegistrationUrl($courseTitle, $price);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.whatsapp-button');
    }
}
