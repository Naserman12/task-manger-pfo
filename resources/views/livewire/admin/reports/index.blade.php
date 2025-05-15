
<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
<h2 class="text-2xl font-bold mb-4">تقارير النظام</h2>
<div class="grid grid-cols-3 gap-4">
    <div class="p-4 bg-white border rounded shadow">
        <h3 class="text-lg font-semibold">عدد المستخدمين</h3>
        <p class="text-3xl">{{ $usersCount }}</p>
    </div>
    <div class="p-4 bg-white border rounded shadow">
        <h3 class="text-lg font-semibold">عدد المجموعات</h3>
        <p class="text-3xl">{{ $groupsCount }}</p>
    </div>
    <div class="p-4 bg-white border rounded shadow">
        <h3 class="text-lg font-semibold">عدد المهام</h3>
        <p class="text-3xl">{{ $tasksCount }}</p>
    </div>
    <div class="p-4 bg-white border rounded shadow">
        <h3 class="text-lg font-semibold">عدد المشاريع</h3>
        <p class="text-3xl">{{ $projectCount }}</p>
    </div>
</div>
</div>


