

@section('content')
<form method="POST" action="{{ route('comments.update', $comment) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="body">Comment</label>
        <textarea name="comment" id="comment" class="form-control">{{ $comment->comment }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update Comment</button>
</form>
@endsection
