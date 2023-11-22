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
        <div class="container">
            <div class="row g-3">
                <div class="col p-3"></div>
                    <div class="col p-3">
                        <form class="col-md-" method="POST" action="{{route('project_search')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="InputText" class="form-label">Введите текст для поиска</label>
                                <input type="text" name="subject" class="form-control" id="subject" value="">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" id="search_btn">Найти</button>
                            </div>
                        </form> 
                    </div>
                <div class="col p-3"></div> 
            </div>   
        </div>
        {{-- <script type="module">          как вариант можно использовать jquery, но по моему скромному мнению, он здесь лишний 
                $(document).ready(function() {
                    $("form").on("submit", function(event) {
                        event.preventDefault();
                        let subject = $("#subject").val();
                        $.ajax({
                        url: "/project/search",
                        type:"POST",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            subject:subject,
                        },
                        success:function(response){
                            //console.log(response);
                        },
                        });
                    });
                });
        </script> --}}
    </body>
</html>
