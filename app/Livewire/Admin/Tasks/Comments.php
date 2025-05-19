<?php

namespace App\Livewire\Admin\Tasks;

use Livewire\Component;
use App\Models\Task;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{
    public Task $task;
    public $comment = '';
    public $rating = null;

    public function saveComment()
    {
        $this->validate([
            'comment' => 'required|string|max:1000',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $type = $this->task->status === 'completed' ? 'feedback' : 'normal';

        Comment::create([
            'task_id' => $this->task->id,
            'user_id' => Auth::id(),
            'comment' => $this->comment,
            'rating' => $this->rating,
            'type' => $type,
        ]);

        $this->reset(['comment', 'rating']);
        session()->flash('message', 'تمت إضافة تعليقك بنجاح.');
    }

    public function render()
    {
        $comments = $this->task->comments()->with('user')->latest()->get();

        return view('/dashboard', [
            'comments' => $comments,
        ]);
    }
}
