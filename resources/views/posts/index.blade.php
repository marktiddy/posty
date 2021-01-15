@extends('layouts.app')

@section('content')
<div class="flex justify-center">
  <div class="w-8/12 bg-white p-6 rounded-lg">
    <form action="{{ route('posts') }}" method="post" class="mb-4">
      @csrf
      <div class="mb-4">
        <label for="body" class="sr-only">Body</label>
        <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="What's on your mind?"></textarea>
      
        @error('body')
          <div class="text-red-500 mt-2 text-sm">
            {{ $message }}
          </div>
        @enderror
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium hover:bg-blue-400">Post</button>

    </form>

    <!-- Go over posts that we passed in -->
    @if($posts->count())
      @foreach($posts as $post)
        <div class="mb-4">
          <a href="" class="font-bold">{{ $post->user->name }}</a> 
          <span class="text-gray-600 text-sm">Post created {{ $post->created_at->diffForHumans() }}</span>
          <p class="mb-4">{{ $post->body }}</p>

          <div class="flex items-center">
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                  @csrf
                  <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                  @csrf
                  @method('DELETE') <!-- METHOD SPOOFING TO SEND DELETE REQUEST -->
                  <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif
              <span>{{ $post->likes->count()}} {{ Str::plural('like', $post->likes->count()) }}</span>
          </div>
        </div>
      @endforeach

      <!-- Paginate links -->
      {{ $posts->links() }}
    @else 
    <p>There are no posts yet...</p>
    @endif
</div>
@endsection