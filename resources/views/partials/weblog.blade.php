<section>
    <div class="weblog-info">
        <h1>وبلاگ راوی بیوتی</h1>
        <a href="{{route("weblog")}}">مشاهده همه</a>
    </div>

    @php
        use App\Models\WeblogPosts;
        $posts = WeblogPosts::take(4)->get()
    @endphp

    <div class="weblog-container">

        @foreach ($posts as $post)

            <div>
                <img src="{{asset("images/weblog/$post->image")}}" alt="">
                <h1>{{$post->title}}</h1>
                <p>{{ Str::limit($post->description, 200 , '...') }}</p>
                <a href="{{route("weblog-show" , ["post"=>$post])}}">ادامه مطلب</a>
            </div>

        @endforeach

    </div>
</section>
