<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="space-y-6">
        @if($task)
    <livewire:admin.tasks.comments :task="$task" />
    @else
        <p class="text-red-500">لا توجد مهمة لعرض التعليقات.</p>
    @endif

    <!-- التعليقات السابقة -->
    <div class="space-y-4">
        @foreach ($comments as $comment)
            <div class="bg-gray-100 p-4 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <h4 class="font-semibold">{{ $comment->user->name }}</h4>
                    @if ($comment->rating)
                        <span class="text-yellow-500">
                            ★ {{ $comment->rating }}/5
                        </span>
                    @endif
                </div>
                <p class="mt-2 text-sm text-gray-700">{{ $comment->comment }}</p>
                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
        @endforeach
    </div>

    <!-- نموذج إضافة تعليق -->
    <form wire:submit.prevent="saveComment" class="space-y-4">
        @if (session()->has('message'))
            <div class="text-green-600">{{ session('message') }}</div>
        @endif

        <textarea wire:model.defer="comment" class="w-full p-2 border rounded-xl" rows="3" placeholder="اكتب تعليقك..."></textarea>
        @error('comment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        @if ($task->status === 'completed')
            <div>
                <label class="block text-sm font-medium text-gray-700">التقييم</label>
                <select wire:model.defer="rating" class="mt-1 p-2 border rounded-xl w-full">
                    <option value="">بدون تقييم</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} نجوم</option>
                    @endfor
                </select>
                @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        @endif

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">
            إضافة تعليق
        </button>
    </form>
</div>

</div>
