@extends('layouts.admin')
@section('admin-content')
<x-user-profile :id="$user->id" />
@endsection