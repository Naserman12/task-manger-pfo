<?php

namespace App\Livewire\Admin\Project;

use Livewire\Component;
use App\Models\Project;

class DeleteProject extends Component
{
     public $confirmingDelete = false ;
    public  $projectDelete;
     public function mount($projectId){
            if ($projectId) {
                $this->projectDelete = Project::find($projectId);
                if (!$this->projectDelete) {
                    $this->emit('showAlert','المشروع غير موجود ' );
                }
            }
    }
     public function confirmDelete(){
        $this->confirmingDelete = true;
    }
    
    public function cancelDelete()
    {
        $this->confirmingDelete = false;
    }
     public function deleteProject(){
        try {
            $this->projectDelete->delete();
            session()->flash('success', 'تم حذف المشروع');
            return redirect()->to('/admin/projects');
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ اثناء الحذف'. $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.project.delete-project');
    }
}
