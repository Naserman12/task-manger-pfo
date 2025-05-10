@component('mail::message')
#{{ $subject ?? 'تحديث جديد في المجموعة' }}
{{-- المحتوى الرائيسي --}}
<div class="" style="direction: rtl; text-align: right; width: 100%; max-width: 100%;">
    <p style="font-size: 16px; margin-bottom: 20px; ">
        {{ $message }}
    </p>

    @if (isset($group))
    <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 2px;">
        <h3 style="margin-top:0;">تفاصيل المجموعة: </h3>
        <p><strong>اسم المجموعة</strong>{{ $group->name }}</p>
        @if (isset($group->description))
        <p><strong>تفاصيل المجموعة</strong>{{ $group->description }}</p>
        @endif
    </div>
    @endif

    @if (isset($triggeredBy))
    <p style="margin-bottom: 20px;">
        <strong>بواسطة</strong> {{ $triggeredBy->name }}
    </p>
    @endif
</div>
 {{-- زر الاجراء --}}
@component('mail::button',[ 'url' => 'url', 'color' => 'primary'])
عرض المجموعة
@endcomponent
  {{-- التذييل --}}
  <div style="direction: rtl; margin-top: 30; font-size: 14px; color: #6c757d;">
    <p>إذا كنت تعتقد ان  هذه الرسالة ولصلتك عن طريق الخطأ يمكنك تجاهلها</p>
    <p>شكرا لاستخدامك تطبيقنا</p>
  </div>
@endcomponent