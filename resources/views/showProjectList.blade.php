<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @vite(['resources/css/app.css'])
        @vite(['resources/js/app.js']) 
    </head>
    <body class="antialiased">
        <p class="subject">Строка поиска: {{ $subject }}</p>
        <div class="contaner_card">   
            @foreach ($projects as $project)
                <a href="{{$project['svn_url']}}" class="card" style="width: 18rem;">
                    <div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $project['name_project'] }}</h5>
                            <h6 class="card-title"></h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Имя автора: {{ $project['author'] }}</li>
                                <li class="list-group-item">Количество звезд: {{ $project['stargazers_count'] }}</li>
                                <li class="list-group-item">Количество просмотров: {{ $project['watchers_count'] }}</li>
                            </ul>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </body>
</html>
