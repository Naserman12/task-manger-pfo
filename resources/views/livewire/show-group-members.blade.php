@extends('layouts.app')
@section('content')
<livewire:group-members :groupId="$group->id" />
@endsection