<div>
    @isset($groupDelete)
    <button wire:click="$set('confirmingDelete', true)" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded" >
        حذف
    </button>
    
   @if ($confirmingDelete && $groupDelete)
    <div class="flext inset-0 bg-gray-500 bg-opacity-75">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
            <h3 class="text-gray-600 md-6">تأكيد الحذف</h3>
            <p class="text-gray-600">هل انت متأكد من رغبتك في حذف المجموعة؟</p>
            <div class="flex justify-end space-x-3">
                <button @click="confirmingDelete = false" wire:click="$set('confirmingDelete', false)" 
                    class="px-4 py-3 border border-gray-300 rounded-md text-gray-700">
                الغاء الحذف
                </button>
                <button wire:click="deleteGroup"
                    class="bg-red-500 px-4 py-3 border  text-yellow  rounded-md hover:bg-red-700 " >
                   حذف المجموعة؟
                </button>
            </div>
        </div>
    </div>
    @endif
    @endif 
</div>
