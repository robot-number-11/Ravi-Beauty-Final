<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset("css/single-weblog-post.css")}}">
</head>
<body>
    <div class="container">
        <img src="{{asset("images/weblog/$post->image")}}" alt="">
        <h1>{{$post->title}}</h1>
        <p>{{$post->description}}</p>

        @php
            use Illuminate\Support\Facades\Gate;
        @endphp

        @if (Gate::allows("update-delete-post" , $post))
            <a class="edit" href="{{route("weblog-edit" , ["post" => $post])}}">ویرایش</a>
            <a class="delete" href="{{route("weblog-delete" , ["post" => $post])}}">حدف</a>
        @endif



    </div>
</body>
</html>
