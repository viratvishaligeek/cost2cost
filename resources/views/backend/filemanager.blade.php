@extends('backend.include.layout')
@section('content')
    <iframe src="{{ url('admin/laravel-filemanager?type=Files') }}" style="width:100%; height:80vh; border:none;">
    </iframe>
@endsection
