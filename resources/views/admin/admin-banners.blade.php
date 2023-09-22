<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset("css/admin/banners.css") }}">
</head>
<body>
    <div class="new-banner">
        <a href="{{ route("admin-banner-create") }}">ایجاد بنر جدید</a>
    </div>
    @if ($banners)

        <div class="banner-contianer">
            @foreach ($banners as $banner)
                <div class="banner">
                    <h2>{{ $banner->title }}</h2>
                    <p>{{ Str::limit($banner->description, 200 , '...') }}</p>
                    <img src="{{ asset("images/banners/$banner->image") }}" alt="">
                    <a class="update" href="{{ route("admin-banner-edit" , ["banner" => $banner]) }}">ویرایش</a>
                    <a class="delete" href="{{ route("admin-banner-delete" , ["banner" => $banner]) }}">حذف</a>
                </div>
            @endforeach
        </div>

    @endif
</body>
</html>
