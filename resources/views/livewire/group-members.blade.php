<div> 


<div class="spaxe-y-6" x-data="{ openInviteModel: false}">
    <!-- زر إضافة الأعضاء -->
     <button @click="openInviteModel = true" class="btn btn-primary px-4 py-2 bg-blue-500 text-white">
        <i fas fa-user-plus mr-2 >دعوة اعضاء جدد</i>
     </button>
     <!-- قائمة الأعضاء الحالين -->
     <div class="bg-white rounded-lg shadow overflow-hidden">
         <!-- <div class="grip grip-cols-1 md:grip-cols-2 gap-3"> -->
             <div class="divide-y divide-gray-400">
                <h3 class="text-ms font-medium text-gray-600 mb-3">اعضاء المجموعة الحالين</h3>
                @forelse($currentMembers as $member) 
                <!-- <div class="flex items-center justify-between bg-white p-3 rounded-lg shadow"> -->
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center"><span class="text-blue-600">{{ substr($member->name, 0, 1 )}}</span>  </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-900">{{$member->name}}</h3>
                        <p class="text-sm text-gray-500">
                            {{ $member->pivot->role === 'sub_leader' ? 'مشرف' : 'عضو' }}
                            @if ($member->pivot->status === 'pending')
                            <span class=" ml-2 px-2 py-0 text-ms rounded-full bg-yellow-200 " >
                                قيد الإنتظار
                            </span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex">
                    @if ($member->pivot->status === 'pending')
                    <button wire:click="#"
                    class="btn btn-sm btn-outline-secondary" title="إعادة إرسال الدعوة">
                    <i class="fas fa-paper-plane"></i>
                </button>  
                    @endif
                    <button wire:click="removeMember({{ $member->id }})" 
                    class="text-red-500 hover:text-red-700">
                    <i class="fas fa-user-minus"></i>حذف</button>  
                </div>
            </div>
            @empty
            <p class="text-gray-500" >لا يوجد اعضاءفي المجموعة</p>
            @endforelse
        </div>
    </div>
     <!-- الرسائل -->
     @if(session('message'))
    <div class="alert alert-success bg-blue-500">
        {{ session('message') }}
    </div>    
    @endif
     @if(session('error'))
    <div class="alert alert-success bg-red-500">
        {{ session('error') }}
    </div>    
    @endif
        <!-- دعوة الأعضاء Model -->
         <div  x-show="openInviteModel" x-transition class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen  pt-4 px-4 pd-20 text-center sm:p-0 ">
                <div @click="openInviteModel = false"   class=" fixed inset-0 transition-opacity">
                    <div class=" absolute inset-0 bg-gray-500 opacity-75 "></div>
                </div>
                <div class=" inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class=" bg-white px-4 pt-5 bd-4 ms:p-6 sm:pd-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">دعوة أعضاء جدد</h3>
                        <div class="space-y-4">
                            <div class="">
                                <label class="block text-sm font-medium text-gray-700">أختر الأعضاء</label>
                                <select 
                                wire:model="selectedUsers" multiple
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" id="">
                                @foreach ($availableUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            </div>
                            <div>
                                <label for="" class=" block text-sm font-medium text-gray-700  ">الدور</label>
                                <select 
                                wire:model="selectedRole"
                                class=" mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="member">عضو</option>
                                <option value="sub_leader">مشرف</option>

                            </select>
                            </div>
                        </div>
                    </div>

                    <div class=" bg-gray-50 px-4 py-3 ms:px-6 ms:flex-row-reverse ">
                        <button
                        wire:click="inviteMembers" @click="openInviteModel = false"  wire:loading.attr="disabled"
                        type="button" class=" w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                   <span  wire:loading.remove> ارسل الدعوات  </span>
                                <span wire:loading>جاري التحميل...</span>
                        </button>
                        <button 
                        @click="openInviteModel = false"
                        type="button"
                        class="w-full inline-flex justify-center rounded-md border border-gray-300  shadow-sm px-4 py-2 bg-white- text-base font-medium  text-gray-700  hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                        الغاء
                        </button>
                    </div>
                </div>
            </div>
         </div>
 </div>