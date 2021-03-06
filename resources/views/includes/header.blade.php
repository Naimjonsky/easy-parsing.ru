<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">{{ config('app.name') }}</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{ route('parseNews') }}">Парсинг</a>
        <a class="p-2 text-dark" href="{{ route('news') }}">Новости</a>
        <a class="p-2 text-dark" href="{{ route('logs') }}">Логи</a>
    </nav>
    <a class="btn btn-outline-primary" href="{{ route('home') }}">Домой</a>
</div>
