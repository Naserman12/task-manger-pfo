<?php

namespace App\Livewire\Groups\Tasks;

use App\Livewire\Admin\Tasks\Comments;
use Livewire\Component;
use App\Models\Task;
use App\Models\Comment;
use App\Livewire\Groups\Tasks\Log;
use Illuminate\Support\Facades\Auth;
class TaskDetails extends Component
{
    public  $task;
    public $newComment = '', $editCommentId = null, $editCommentContent = '', $latestCommentId;
    public $isAssignedUser;
    public $isCreator;
    public $comments ;
    public function mount(Task $task)
    {
        $this->task = $task;
        $this->comments = Comment::all();
        $this->isAssignedUser = $task->assignee_to === Auth::id();
        $this->isCreator = $task->created_by === Auth::id();
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'task_id' => $this->task->id,
            'user_id' => Auth::id(),
            'content' => $this->newComment,
        ]);
        $this->newComment = '';
        $this->latestCommentId = $comment->id;
        //  $this->comments->push($comment);
        session()->flash('message', 'تم نشر التعليق بنجاح');
    }
      public function editComment($commentId){
        $comment = Comment::findOrFail($commentId );
        if ($comment->user_id !== Auth::id()) {
            session()->flash('error', 'لا يمكنك التعديل على هذا التعليق!');
            return;
        }
        $this->editCommentId = $commentId;
        $this->editCommentContent =  $comment->content;
    } 
       // Update Comment Method 
       public function updateComment(){
        $this->validate([
            'editCommentContent' => 'required|string|max:500',
        ]);
        try {
            $comment = Comment::findOrFail($this->editCommentId);
            if ($comment->user_id !== Auth::id()) {
                session()->flash('error', 'لا يمكنك التعديل على هذا التعليق!');
                return;
            }
            $comment->update([
                'content' => $this->editCommentContent,
            ]);
            session()->flash('message', 'تم تحديث التعليق بنجاح');
        } catch (\Exception $e) {
            session()->flash('error', 'Error'.$e->getMessage());
        }
        $this->editCommentId = null;
        $this->editCommentContent = '';
       }
       // Update Comment Method End
         // Cancel Editing Comment Method 
       public function cancelEditComment(){
        $this->editCommentId = null;
        $this->editCommentContent = '';
       }
       // Cancel Editing Comment Method 
            // Delete Comment Method 
       public function deleteComment($commentId){
        try {
            $comment = Comment::findOrFail($commentId);
            if ($comment->user_id !== Auth::id()) {
                session()->flash('error', 'لا يمكنك  حذف هذا التعليق!');
                return;
            }
            $comment->delete();
            session()->flash('message', 'تم حذف التعليق');
        } catch (\Exception $e) {
            session()->flash('error', 'فشل حذف التعليق'.$e->getMessage());
            return;
        }
       }
       // Delete Comment Method End
    public function acceptTask()
    {
        if ($this->task->status === 'pending') {
            $this->task->status = 'in_progress';
            $this->task->save();
        }
    }

    public function submitForReview()
    {
        if ($this->task->status === 'in_progress') {
            $this->task->status = 'under_review';
            $this->task->save();
        }
    }

    public function markAsCompleted()
    {
        if ($this->task->status === 'under_review') {
            $this->task->status = 'completed';
            $this->task->save();
        }
    }
    public function render()
    {
        return view('livewire.groups.tasks.task-details', [
            'comments' => $this->task->comments()->latest()->get(),
            'isSupervisor' => Auth::user()->role === 'supervisor',
            'isAssignee' => $this->task->assigned_to === Auth::id(),
        ]);
    }
}
