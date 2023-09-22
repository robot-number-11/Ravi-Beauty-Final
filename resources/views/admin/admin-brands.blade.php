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
        <a href="{{ route("admin-brand-create") }}">ایجاد برند جدید</a>
    </div>
    @if ($brands)

        <div class="banner-contianer">
            @foreach ($brands as $brand)
                <div class="banner">
                    <h2>{{ $brand->brand }}</h2>
                    <img src="{{ asset("images/brands/$brand->image") }}" alt="">
                    <a class="update" href="{{ route("admin-brand-edit" , ["brand" => $brand]) }}">ویرایش</a>
                    <a class="delete" href="{{ route("admin-brand-delete" , ["brand" => $brand]) }}">حذف</a>
                </div>
            @endforeach
        </div>

    @endif
</body>
</html>
