@extends('layouts.default')

@section('content')

    <div class="container mt-5">

        <h1 class="d-flex justify-content-center text-info">
            {{ $title }}
        </h1>
        <br>
        <form action="" method="GET" role="search">
            <div class="input-group">
                <input type="search" name="q" value="{{ request()->input('q') }}" class="form-control"
                       placeholder="Поиск ...">
                <div class="input-group-append">
                    <button class="btn btn-secondary btn-search btn-info" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-5">
        @if(isset($logs[0]))
            <table class="table table-bordered mb-5">
                <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">Date & time</th>
                    <th scope="col">Request Method</th>
                    <th scope="col">Request URL</th>
                    <th scope="col">Response HTTP Code</th>
                    <th scope="col">Details</th>
                </tr>
                </thead>
                <tbody>

                @foreach($logs as $data)
                    <tr>
                        <th scope="row">{{ $data->id }}</th>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->request_method }}</td>
                        <td>{{ $data->request_url }}</td>
                        <td>{{ $data->response_http_code }}</td>
                        <td>
                            <a href="{{ route('logs') . '/' . $data->id }}">Перейти <i
                                    class="fa fa-angle-double-right"></i></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {!! $logs->links() !!}
            </div>
        @elseif(mb_strlen(request()->input('q')))
            <h2 class="text-center">
                К сожалению, логов с ключевым словом <i class="text-danger">"{{ request()->input('q') }}"</i> не
                найдены.
                <br>
                Попробуйте поискать еще раз.
            </h2>
        @else
            <h2 class="d-flex justify-content-center text-danger">
                К сожалению, пока нет логов :(
            </h2>
        @endif
    </div>
@stop
