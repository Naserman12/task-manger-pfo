<?php
namespace App\Livewire\Group;

use Livewire\Component;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\GroupInvitationNotification;

class InviteMembers extends Component
{
    public Group $group;
    public array $selectedUsers = [];
    public string $selectedRole = 'member';

    public function mount(Group $group)
    {
        $this->group = $group;
    }

    public function inviteMembers()
    {
        $this->validate([
            'selectedUsers' => 'required|array',
            'selectedUsers.*' => 'exists:users,id'
        ]);

        foreach ($this->selectedUsers as $userId) {
            $user = User::find($userId);
            if ($user && !$this->group->members->contains($userId)) {
                $this->group->members()->attach($userId, [
                    'role' => $this->selectedRole,
                    'status' => 'pending',
                    'invited_by' => Auth::id(),
                    'invited_at' => now()->format('Y-m-d')
                ]);

                $user->notify(new GroupInvitationNotification(
                    $this->group->id,
                    $this->group->name,
                    Auth::user()->name
                ));
            }
        }

        session()->flash('message', 'تم إرسال الدعوات بنجاح');
        $this->selectedUsers = [];
    }

    public function render()
    {
        $availableUsers = User::whereNotIn('id', $this->group->members->pluck('id'))->get();

        return view('livewire.group.invite-members', compact('availableUsers'));
    }
}
