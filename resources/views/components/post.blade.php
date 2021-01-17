<!-- Define props we inherit -->
@props(['post' => $post])
<div class="mb-4">
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> 
    <span class="text-gray-600 text-sm">Post created {{ $post->created_at->diffForHumans() }}</span>
    <p class="mb-4">{{ $post->body }}</p>
   
    
    @can('delete', $post)
      <form action="{{ route('posts.destroy', $post )}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-white bg-red-500 rounded-lg p-2 text-sm mb-4">Delete</button>
      </form>
    @endcan
    

    <div class="flex items-center">
      @auth
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
      @endauth
        <span>{{ $post->likes->count()}} {{ Str::plural('like', $post->likes->count()) }}</span>
    </div>
  </div>