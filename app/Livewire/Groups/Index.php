<?php

namespace App\Livewire\Groups;

use Livewire\Component;
use App\Models\Group;

class Index extends Component
{
    public $groups;

    public function mount()
    {
        // تحميل البيانات عند بداية تحميل الكومبوننت
        $this->groups = Group::withCount('members')->get();
    }

    public function render()
    {
        return view('livewire.admin.groups.admin-index', [
            'groups' => $this->groups,
        ]);
    }
}
