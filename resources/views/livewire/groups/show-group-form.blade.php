@extends('layouts.admin') {{-- هذا قالب لوحة التحكم --}}

@section('pageTitle', $isEdit ? 'تعديل المجموعة' : 'إضافة مجموعة')
@section('admin-content')
   @livewire('groups.group-form' )
@endsection
