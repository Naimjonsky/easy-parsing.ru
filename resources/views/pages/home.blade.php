@extends('layouts.default')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5">{{ config('app.name') }}</h1>
                <p>
                    This awesome tool to parsing RSS News from site "<code>https://rbc.ru</code>".
                    <br>Click the button "Парсинг" to parse now
                </p>
                <br>
                <a href="{{ route('parseNews') }}" class="btn btn-outline-primary">Парсинг</a>
            </div>
        </div>
    </div>
@stop
