@extends("layout.main")
@section("content")
        <div class="alert alert-success" role="alert">
            下面是搜索"{{$query}}"出现的文章，共{{$posts->total()}}条
        </div>

        <div class="col-sm-8 blog-main">
            @foreach($posts as $post)
            <div class="blog-post">
                <h2 class="blog-post-title"><a href="/posts/{{$post->id}}" >{{$post->title}}</a></h2>
                {{--这里user的a标签和老师写的不一样，但应该是没问题的--}}
                <p class="blog-post-meta">{{$post->created_at}} by <a href="/user/{{$post->user_id}}">{{$post->user->name}}</a></p>
                <p>{!!str_limit($post->content,100,"...")!!}</p>
            </div>
            @endforeach
            {{$posts->links()}}
        </div><!-- /.blog-main -->
@endsection
