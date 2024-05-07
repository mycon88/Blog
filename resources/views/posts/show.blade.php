@extends('layouts.app')

@section('content')
   <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{$post->title}}</h2>
            <p class="card-subtitle text-muted">Author: {{$post->user->name}}</p>
            <p class="card-subtitle text-muted mb-3">Created at: {{$post->created_at}}</p>
            <p class="card-text">{{$post->content}}</p>
            @if(Auth::id() != $post->user_id)
                <form class="d-inline" method="POST" action="/posts/{{$post->id}}/like">
                    @method('PUT')
                    @csrf
                    @if($post->likes->contains("user_id", Auth::id()))
                        <button type="submit" class="btn btn-danger">Unlike</button>
                    @else
                        <button type="submit" class="btn btn-success">Like</button>
                    @endif
                </form>
            @endif
            <div class="mt-3">
                <a href="/posts" class="card-link">View all posts</a>
            </div>
             <p class="mt-3">Likes: {{$post->likes->count()}}, Comments: {{$post->comments->count()}}</p>
        </div>
    </div>

   <!-- Modal for adding comment -->
<div class="modal" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCommentModalLabel">Add a Comment</h5>
                <!-- Move the close button to the right side -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: auto;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/posts/{{$post->id}}/comment">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="commentContent">Comment Content</label>
                        <textarea class="form-control" id="commentContent" name="content" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCommentModal">
    Add Comment
</button>

<div class="mt-4">
    <h3>Comments</h3>
    @if($post->comments->count() > 0)
        <ul class="list-group">
            @foreach($post->comments as $comment)
                <li class="list-group-item">
                    <strong>{{$comment->user->name}}</strong>: {{$comment->content}}
                </li>
            @endforeach
        </ul>
    @else
        <p>No comments yet. Be the first to comment!</p>
    @endif
</div>

@endsection
