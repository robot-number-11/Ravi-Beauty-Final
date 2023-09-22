@php
    use App\Models\Category;
    $categories = Category::all();
@endphp

<section>
    <div class="product-category">
            @foreach ($categories as $category)

                <div>
                    <img src="{{ asset("images/categories/$category->image") }}" alt="">
                    <div>
                        <p>{{ $category->title }}</p>
                        <button>مشاهده</button>
                    </div>
                </div>

            @endforeach
    </div>
</section>
