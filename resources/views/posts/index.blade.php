@extends('layouts.app')

@section('content')
    <h2>Blog Posts</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('posts.export') }}" class="btn btn-primary">Export Posts</a>
    <form action="{{ route('posts.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit" class="btn btn-success">Import Posts</button>
    </form>
    <table>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Author</th>
        </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>{{ $post->user->name }}</td>
            </tr>
        @endforeach
    </table>
@endsection
