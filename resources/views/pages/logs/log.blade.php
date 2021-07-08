@extends('layouts.default')

@section('content')
    <a href="{{ route('logs') }}" class="btn btn-sm btn-outline-primary">
        <i class="fa fa-long-arrow-left"></i> Назад
    </a>
    <div class="container mt-5">
        <h1 class="d-flex justify-content-center text-info">
            {{ $title }}
        </h1>

    </div>
    <div class="container mt-5">
        @isset($log)
            <table class="table table-bordered mb-5">
                <tr>
                    <th scope="col">#</th>
                    <td>{{ $log->id }}</td>
                </tr>
                <tr>
                    <th scope="col">Дата и время</th>
                    <td>{{ $log->created_at }}</td>
                </tr>
                <tr>
                    <th scope="col">Request Method</th>
                    <td>{{ $log->request_method }}</td>
                </tr>
                <tr>
                    <th scope="col">Request URL</th>
                    <td>{{ $log->request_url }}</td>
                </tr>
                <tr>
                    <th scope="col">Response HTTP Code</th>
                    <td>{{ $log->response_http_code }}</td>
                </tr>
                <tr>
                    <th scope="col">Response Body</th>
                    <td>
                        <pre>{{ $log->response_body }}</pre>
                    </td>
                </tr>
            </table>
        @endif
    </div>
@stop
