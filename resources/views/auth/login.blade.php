@extends('layouts.app')

@section('content')
    <login-component crf_token="{{ @csrf_token() }}"></login-component>
@endsection
