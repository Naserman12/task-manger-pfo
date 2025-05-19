<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class UserProfile extends Component
{
    /**
     * Create a new component instance.
     */
    public $user, $projects, $tasks;
    
    public function __construct($id)
    {
        $this->user = User::findOrFail($id);
       

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-profile');
    }
}
