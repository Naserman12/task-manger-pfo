<?php

namespace App\Livewire;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Component;

class DeleteGroup extends Component
{
    public $confirmingDelete = false ;
    public  $groupDelete;
    public function mount($groupId){
            if ($groupId) {
                $this->groupDelete = Group::find($groupId);
                if (!$this->groupDelete) {
                    $this->emit('showAlert','المجموعة غير موجودة ' );
                }
            }
    }
    public function confirmDelete(){
        $this->confirmingDelete = true;
    }
    public function deleteGroup(){
        try {
            $this->groupDelete->delete();
            session()->flash('success', 'تم حذف المجموعة');
            return redirect()->route('groups');
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ اثناء الحذف'. $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.groups.delete-group', ['group' => $this->groupDelete]);
    }
}
