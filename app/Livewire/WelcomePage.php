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
                'content' => 'نظام لإدارة المهام اليومية وتوزيعها على الفرق وتحديث حالتها بكل سهولة.'
            ],
            [
                'id' => 'about-dev',
                'title' => 'عن المطور',
                'content' => 'اسمي ناصر، مطور Laravel وLivewire. أطمح لبناء أنظمة فعالة وسهلة الاستخدام.'
            ],
            [
                'id' => 'tools',
                'title' => 'الأدوات المستخدمة',
                'content' => ['Laravel 11', 'Livewire', 'Tailwind CSS', 'Blade', 'MySQL', 'Git & GitHub']
            ],
            [
                'id' => 'skills',
                'title' => 'مهاراتي',
                'content' => ['OOP في PHP', 'Laravel APIs', 'Livewire', ' Tailwind Css', 'Git & GitHub', 'تحسين الأداء']
            ]
        ];
    }

    public function render()
    {
        return view('livewire.welcome-page');
    }
}
