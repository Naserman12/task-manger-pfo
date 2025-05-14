 <?php

 public function mount($userId){
        $this->userId = $userId;
        $$this->group = Group::findOrFail($this->userId);
        $this->groupName = $this->group ? $this->group->name : 'لم يتم التعرف على اسم المجموعة';
        $this->inviterName = Auth::user();


        $this->loadAvailableUsers();
    }
 public function inviteMembers(){
        $this->validate([
            'selectedUsers' => 'required|array',
            'selectedUsers.*' => 'exists:users,id'
        ]);
            // تحقق أن groupId و groupName موجودين
        if (!$this->groupId || !$this->groupName) {
            session()->flash('error', 'بيانات المجموعة غير مكتملة. لا يمكن إرسال الدعوات.');
            return;
        }
         foreach ($this->selectedUsers as $userId) {
            $user = User::find($userId); // هنا userId هو ID العضو المُدعو

            if ($user) {
                // يتم استخدام userId تلقائيًا من خلال $user->groups() في attach
                $user->groups()->attach($this->groupId, [
                    'role' => $this->selectedRole ?? 'member',
                    'status' => 'pending',
                     'invited_by' => Auth::id(), 
                     'invited_at' => now()->format('Y-m-d'), 
                ]);
                // إرسال إشعار
                $user->notify(new GroupInvitationNotification(
                    $this->groupId,
                    $this->groupName,
                    $this->inviterName->name // اسم من قام بالدعوة
                ));
                session()->flash('message', 'تم إرسال الدعوة بنجاح');
            }else{
                session()->flash('message', 'لم يتم إرسال الدعوة');
            }
        }
    }