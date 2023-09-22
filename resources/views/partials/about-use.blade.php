@php
    use App\Models\AboutUs;
    $about = AboutUs::all();
@endphp

<section class="about-us">

    @foreach ($about as $a)
        <div>
            <h1>{{$a->title}}</h1>
            <p>{{$a->description}}</p>
        </div>
        <img src="{{ asset("images/about-us/$a->image") }}" alt="">
    @endforeach

</section>
