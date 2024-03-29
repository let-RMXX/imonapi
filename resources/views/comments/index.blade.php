@extends('comments.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> I'M ONLINE API - CRUD APP </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('comments.create') }}"> Create New Comment</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th> Comment </th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($comments as $comment)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/images/{{ $comment->image }}" width="100px"></td>
            <td>{{ $comment->name }}</td>
            <td>{{ $comment->detail }}</td>
            <td>
                <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('comments.show',$comment->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('comments.edit',$comment->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $comments->links() !!}

@endsection
