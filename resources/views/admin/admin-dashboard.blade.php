<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset("css/admin/dashboard.css") }}">
</head>
<body>
    <h1>داشبورد ادمین</h1>
    <div class="actions">
        <a href="{{ route("admin-banner") }}">بنرهای اصلی سایت</a>
        <a href="{{ route("admin-category") }}">بنرهای قسمت دسته بندی </a>
        <a href="{{ route("admin-product") }}">محصولات</a>
        <a href="{{ route("admin-brand") }}">برند ها</a>
        <a href="{{ route("admin-about") }}">درباره ما</a>
    </div>
</body>
</html>
