<?php

namespace App\Livewire\Admin\Tasks;

use Livewire\Component;
use App\Models\TaskRequest;
use App\Models\Task;

class TaskRequestsManager extends Component
{
    public $taskRequests; // جميع طلبات تنفيذ المهام المعلقة

    public function mount()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        // جلب الطلبات المعلقة
        $this->taskRequests = TaskRequest::where('status', 'pending')
            ->with(['task', 'user'])
            ->get();
    }

    // قبول الطلب
    public function approve($requestId)
    {
        $request = TaskRequest::findOrFail($requestId);

        // تحديث المهمة المكلفة والمرحلة
        $task = $request->task;
        $task->assigned_to = $request->user_id;
        $task->status = 'in_progress'; // قيد التنفيذ
        $task->save();

        // تحديث حالة الطلب
        $request->status = 'approved';
        $request->save();

        $this->loadRequests();

        session()->flash('message', "تم قبول طلب تنفيذ المهمة بنجاح.");
    }

    // رفض الطلب مع ملاحظة اختيارية
    public $rejectionNote = '';
    public $rejectingRequestId = null;

    public function confirmReject($requestId)
    {
        $this->rejectingRequestId = $requestId;
        $this->rejectionNote = '';
    }

    public function reject()
    {
        $request = TaskRequest::findOrFail($this->rejectingRequestId);

        $request->status = 'rejected';
        $request->note = $this->rejectionNote;
        $request->save();

        $this->rejectingRequestId = null;
        $this->rejectionNote = '';

        $this->loadRequests();

        session()->flash('message', "تم رفض طلب تنفيذ المهمة.");
    }

    public function render()
    {
        return view('livewire.admin.tasks.task-requests-manager');
    }
}
