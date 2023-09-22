@php
    use App\Models\Brands;
    $brands = Brands::all();
@endphp

<section>
    <div class="brand-info">
        <p>برندها</p>
        <a href="">مشاهده همه برندها</a>
    </div>
    <div class="brands">
        @foreach ($brands as $brand)

            <div class="brand"><img src="{{ asset("images/brands/$brand->image") }}" alt=""></div>

        @endforeach
    </div>
</section>
