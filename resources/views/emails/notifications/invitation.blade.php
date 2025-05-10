@component('mail::message')
#دعوة للإنضمام إلى المجموعة
لقد داعك {{ $inviter->name }} للإنضمام إلى مجموعة **{{ $group->name }}**

@component('mail::button', ['url' => $url])
قبول الدعوة
@endcomponent
<br>:او يمكنك نسخ الرابط التالي
{{ $url }}
<br>, شكرا لك على وقتك

{{ config('app.name') }}
@endcomponent