<div>
    <h1>Posts</h1>
    @foreach ($posts as $post)
        <div>
            <h2>{{ $post->title }}</h2>
            <a href="{{ route('posts.show', $post->id) }}">Read more</a>
        </div>
    @endforeach
</div>
