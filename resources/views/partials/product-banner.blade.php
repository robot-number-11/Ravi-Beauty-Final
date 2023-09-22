@php
    use App\Models\Products;
    $products = Products::all();
@endphp

<section>
    <div class="popular">
        <p>پر فروش ترین محصولات</p>
        <div class="pop-container">

            @foreach ($products as $product)

                <div class="pop">
                    <img src="{{ asset("images/products/$product->image") }}" alt="">
                    <p class="price">تومن {{ $product->price }}</p>
                    <p>{{ $product->title }}</p>
                </div>

            @endforeach


            <ul class="pop-control">
                <li onclick="nextPopular()"></li>
                <li onclick="prevPopular()"></li>
            </ul>
        </div>
    </div>
    <script src="{{ asset("js/product-slider.js") }}"></script>
</section>


