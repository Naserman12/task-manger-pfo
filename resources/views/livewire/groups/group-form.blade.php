<div>
    @if(session()->has('message'))
    <div class="alert alert-success bg-blue-500">
        {{ session('message') }}
    </div>    
    @endif
    <a href="{{ route('groups.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg transition duration-200">عرض المجموعات </a>
    <form wire:submit.prevent="saveGroup">
            <div class="form-group">
                <label for="GroupName">اسم المجموعة</label>
                <input name="name" id="GroupName" type="text" wire:model.defer="name" required>
                @error('name')<span class="error">{{ $message }}</span> @enderror
            </div>
        <div>
            <label for="LeaderGroutp">مشرف المجموعة</label>
            <select name="leader_id" wire:model.defer="leader_id" required>
                <option value="">اختر مشرف</option>
                @foreach ($users as  $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        @error('leader_id')
        <span class="error">{{ $message }}</span>
        @enderror
        <button type="submit" >
            {{$isEdit ?  'التعديل المجموعة' : ' إضافة مجموعة'  }}
        </button>
        @if ($isEdit)
            <button type="button" wire:click="resetForm">
                الغاء التعديل
            </button>
        @endif
    </form><br><br><hr>
   <hr>
   @foreach ($groups as $group)
   @if ($group)
   <tr>
    <td>{{   $group->name }}</td>
    <td>{{   $group->leader->name  }}</td>
    @if (!$isEdit)
    <td><a href="{{ route('groups.edit', $group->id) }}">تعديل </a></td> 
    @endif
   </tr><br>
   @endif
   @endforeach
</div>

