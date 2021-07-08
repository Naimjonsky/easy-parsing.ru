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
        @if(isset($news[0]))
            <table class="table table-bordered mb-5">
                <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Краткое описание</th>
                    <th scope="col">Дата и время публикации</th>
                    <th scope="col">Автор(ы)</th>
                    <th scope="col">Изображение</th>
                </tr>
                </thead>
                <tbody>

                @foreach($news as $data)
                    <tr>
                        <th scope="row">{{ $data->id }}</th>
                        <td>
                            <a href="{{ $data->link }}" target="_blank">{{ $data->title }}</a>
                        </td>
                        <td>{{ $data->description }}</td>
                        <td>{{ \Carbon\Carbon::createFromTimeString($data->published_at)->setTimezone('Europe/Moscow') }}</td>
                        <td>{{ $data->author }}</td>
                        <td class="text-center">
                            @if($data->image)
                                <img src="{{ $data->image }}" width="100px">
                            @else
                                Нет фото
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {!! $news->links() !!}
            </div>
        @elseif(mb_strlen(request()->input('q')))
            <h2 class="text-center">
                К сожалению, новостей с ключевым словом <i class="text-danger">"{{ request()->input('q') }}"</i> не найдены.
                <br>
                Попробуйте поискать еще раз.
            </h2>
        @else
            <h2 class="d-flex justify-content-center text-danger">
                К сожалению, пока нет новостей :(
            </h2>
        @endif
    </div>
@stop
