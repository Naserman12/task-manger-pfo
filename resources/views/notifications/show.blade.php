@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto my-8 px-4 " x-data="notificationHandler()">
<!-- راس الصفحة -->
 <div class="flex justify-between items-center mb-8 ">
<h1 class="text-2xl font-bold text-gray-800">تفاصيل الاشعار</h1>
<a href="{{ route('notifications.index') }}" class="text-blue-600 hover:text-blue-800">الذهاب لصفحة الإشعارات</a>
 </div>

 <!-- بطاقة العرض -->
  <div class="bg-white rounded-lg shadow-md overflow-hidden border-b border-gray-200">
    <!-- Title -->
     <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ $notification->data['group_name'] ?? 'إشعار المجموعة' }}
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            {{ $notification->created_at->translatedFormat('l j F Y - h:i A') }}
        </p>
        <!-- الإشعار -->
         <div class="p-6">
            <p class="text-gray-700 mb-6">
                {{ $notification->data['message'] }}
            </p>
            <!-- more info -->
             <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class=" font-medium text-gray-800 mb-2 ">تفاصيل المجموعة:</h3>
                <ul class="space-y-1 text-gray-600">
                    <li><span class="font-medium">الدور: </span>{{ $notification->data['role'] ?? 'عضو' }}</li>
                    <li><span class="font-medium">حالة الدعوة</span>
                <span class="{{ $notification->data['status'] === 'pending' ? 'text-yellow-600' : ' text-green-600'}}">
                    {{ $notification->data['status'] === 'pending' ? 'مقبولة' : 'قيد الإنتظار'}}
                </span></li>
                </ul>
             </div>
             <!-- action btns -->
              <div class="flex space-x-3 space-x-reverse" x-show="showActions">
                @if (($notification->data['status'] ?? null) === 'pending')
                <button @click="acceptInvite"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition"
                :disabled="loading">
                <span x-show="!loading">قبول الدعوة</span>
                <span x-show="loading">
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
                 </button>
                <button @click="rejectInvite"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition"
                :disabled="loading">
                <span x-show="!loading">رفض الدعوة</span>
                <span x-show="loading">
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
                 </button>   
                @endif
              </div>
         </div>
     </div>
  </div>
</div>

<script>
    function notificationHandler(){
        return {
            loading : false,
            showActions: {{ ( $notification->data['status'] ?? null ) === 'pending' ? 'true' : 'false'}},

            acceptInvite() {
                this.handleAction('{{ route("groups.invite.accept", $notification->id) }}', 'تم قبول الدعوة')
            },

            rejectInvite() {
                if (confirm('هل تريد رفض الدعوة')) {
                    this.handleAction('{{ route("groups.invite.reject", $notification->id) }}', 'تم رفض الدعوة')
                }
            },
            handleAction(url, successMessage){
                this.loading = true;
                
                fetch( url,{
                    method: 'POST',
                    header: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
            }
        }
    }
</script>
@endsection