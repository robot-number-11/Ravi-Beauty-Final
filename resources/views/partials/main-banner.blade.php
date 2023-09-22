@php
    use App\Models\MainBanner;
    $banners = MainBanner::all();
@endphp

<section class="banner">
    <div class="imgBx">
        @foreach ($banners as $banner)
            <img src="{{ asset("images/banners/$banner->image") }}" alt="">
        @endforeach
    </div>
    <div class="contentBx">
        @foreach ($banners as $banner)

            <div>
                <h2>{{ $banner->title }}</h2>
                <p>{{ $banner->description }}</p>
                <a href="">ادامه مطلب</a>
            </div>

        @endforeach
    </div>

    <script src="{{ asset("js/amin-banner-slider.js")}}"></script>

</section>
