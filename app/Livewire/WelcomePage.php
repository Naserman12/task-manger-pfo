<?php

namespace App\Livewire;

use Livewire\Component;

class WelcomePage extends Component
{
  
    public $cards = [];

    public function mount()
    {
      return  $this->cards = [
            [
                'id' => 'about-project',
                'title' => 'عن المشروع',
                'content' => '
                نظام إدارة المهام الجماعي – من تطويري

قمت بتطوير هذا النظام باستخدام إطار العمل Laravel وتقنية Livewire،
 بهدف تسهيل إدارة المهام داخل الفرق، من خلال إنشاء مجموعات،
 تعيين مشرفين، توزيع المهام، ومتابعة حالة التنفيذ بطريقة بسيطة واحترافية..'
            ],
            [
                'id' => 'about-dev',
                'title' => 'عن المطور',
                'content' => 'اسمي ناصر، مطور Laravel وLivewire. أطمح لبناء أنظمة فعالة وسهلة الاستخدام.'
            ],
            [
                'id' => 'tools',
                'title' => 'الأدوات المستخدمة',
                'content' => ['Laravel 11', 'Livewire', 'Tailwind CSS', 'Blade', 'MySQL', 'Git & GitHub', 'laravel Cloud']
            ],
            [
                'id' => 'skills',
                'title' => 'مهاراتي',
                'content' => ['OOP في PHP', 'Laravel APIs', 'Livewire', ' Tailwind Css', 'Git & GitHub']
            ]
        ];
    }

    public function render()
    {
        return view('livewire.welcome-page');
    }
}
