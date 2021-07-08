@extends('layouts.default')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5">{{ $title }}</h1>
                <p>
                    @isset($success)
                        <span class="text-success">{!! $success !!}</span>
                    @endisset
                    @isset($error)
                        <span class="text-danger">{!! $error !!}</span>
                    @endisset
                    {!! $message !!}
                </p>
            </div>
        </div>
    </div>
@stop
