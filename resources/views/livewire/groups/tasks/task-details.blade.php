<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="p-4 rounded-lg shadow bg-white max-w-5xl mx-auto w-full">   
         @if(session()->has('message'))
        <div class="alert alert-success bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('message') }}
        </div>
       @endif 
        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">العنوان: {{ $task->title }}</h2>
        @php
            $statusColors = [
                'pending' => 'bg-yellow-100 text-yellow-800',
                'in_progress' => 'bg-blue-100 text-blue-800',
                'under_review' => 'bg-purple-100 text-purple-800',
                'completed' => 'bg-green-100 text-green-800',
            ];
        @endphp

        <p class="mb-2">
            <span class="font-semibold text-gray-700">الحالة:</span>
            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$task->status] ?? 'bg-gray-100 text-gray-800' }}">
                {{ __('tasks.status.' . $task->status) }}
            </span>
        </p>
        <p class="text-gray-700 mb-2"><strong> 📅تاريخ التسليم:</strong> {{ $task->due_at }}</p>
        <p class="text-gray-700 mb-2"><strong> 👤المكلف:</strong> {{ $task->assignedUser->name ?? 'غير محدد' }}</p>
        <div class="my-4">
            <p>الوصف: {{ $task->description }}</p>
        </div>
    @if ($isAssignee && $task->status === 'pending')
        <button wire:click="acceptTask" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2 rounded-lg shadow transition duration-300">✅ قبول المهمة </button>
    @elseif ($isAssignee && $task->status === 'in_progress')
        <button wire:click="submitForReview" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-5 py-2 rounded-lg shadow transition duration-300"> 📤 إرسال للمراجعة</button>
    @elseif ($isCreator && $task->status === 'under_review')
        <button wire:click="markAsCompleted" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition duration-300"> ✅ وضع كمكتملة</button>
    @endif
    <hr class="my-4" />
 <h3 class="text-md font-senibold mt-4 mb-2"> 💬العليقات</h3>
              @if (count($comments) < 1)
                  <p>لا توجد تعليقات كن اول من يعلق</p>
                  @else
                      <ul class="space-y-2">
                          @foreach($comments as $comment )
                          <!-- animated تاثير الارنداد -->
                              <li class="p-2 bg-white rounded shadow transition-all duration-500 ease-in-out transform animate__animated 
                                {{ $latestCommentId === $comment->id ? 'animate__slideInRight' : '' }}">
                              @if ($editCommentId === $comment->id)
                              <div>
                                  <textarea wire:model="editCommentContent" class="mt--1 block w-full border-gray-300 rounded-md shadow-sm " rows="2" id=""></textarea>
                                  @error('editCmmentComntent')<span class="text-red-500 text-sm animate__animated animate__shakex">{{ $message }}</span>@enderror
                                  <div class="mt-2">
                                      <button wire:click="updateComment" class="bg-blue-500 text-white px-4 py-2 rounded hover::bg-blue-600  animate__animated animate__fadeInDown" >حفظ</button>
                                      <button wire:click="cancelEditComment" class="bg-gray-500 text-white px-4 py-2 rounded hover::bg-gray-600 ml-2" >الغاء</button>
                                  </div>
                              </div>
                              @else
                              <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                              <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                              @if ($comment->user_id === Auth::id())
                              <div class="mt-2">
                                  <button wire:click="editComment ({{ $comment->id }})" class="text-blue-500 hover:underline" >تعديل</button>
                                  <button wire:click="deleteComment ({{ $comment->id }})" wire:confirm="('هل تريد حذف المهمة؟')" class="text-red-500 hover:underline ml-2" >حذف</button>
                              </div>  
                              @endif
                              @endif
                            </li> 
                        @endforeach
                        </ul>
                   @endif
                  <div class="mt-4">
                      <label for="newComment" class=" ripple block text-sm font-medium text-gray-700">إضافة تعليق</label>
                      <textarea wire:model="newComment" id="newComment" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                      @error('newComment')
                      <span class="text-red-500 text-sm">{{ $message }}</span>
                      @enderror
                      <button wire:click="addComment" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 animate__animated animate__pulse" >إضافة تعليق</button>
                  </div>
                  </div>

</div>
