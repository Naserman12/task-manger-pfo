@extends('layouts.app')
@section('content')
<livewire:groups.group-members :groupId="$group->id" />
@endsection