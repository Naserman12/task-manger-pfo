<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="p-6">
    <h2 class="text-xl mb-4">صفحة اختبار Livewire</h2>
    
    <p class="mb-4">العدد الحالي: {{ $count }}</p>

    <button wire:click="increment"
        class="bg-blue-500 text-white px-4 py-2 rounded">
        زيادة
    </button>
</div>

</div>
