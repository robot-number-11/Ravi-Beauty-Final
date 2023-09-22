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
        <a href="{{ route("admin-category-create") }}">ایجاد  دسته بندی جدید</a>
    </div>
    @if ($categories)

        <div class="banner-contianer">
            @foreach ($categories as $category)
                <div class="banner">
                    <h2>{{ $category->title }}</h2>
                    <img src="{{ asset("images/categories/$category->image") }}" alt="">
                    <a class="update" href="{{ route("admin-category-edit" , ["category" => $category]) }}">ویرایش</a>
                    <a class="delete" href="{{ route("admin-category-delete" , ["category" => $category]) }}">حذف</a>
                </div>
            @endforeach
        </div>

    @endif
</body>
</html>
