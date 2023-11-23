@extends('layouts.app')

@section('content')
    @include('form', ['task' => $task ?? null])
@endsection