@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-blue-500 text-white">
                        <h5 class="mb-0">قائمة الإشعارات</h5>
                    </div>
                    <div class="card-body">
                        @livewire('show-all-notifications')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
