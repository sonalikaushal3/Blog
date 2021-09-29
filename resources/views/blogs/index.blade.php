@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Blog Listing</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{route('blog.create')}}" title="Create a product"> <i class="fas fa-plus-circle"></i>
                    Create Blog</a>
            </div>
        </div>
    </div><br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>description</th>
            <th>Start date</th>
            <th>End Date</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        @php $i=1; @endphp
        @foreach ($blogs as $blog)
            <tr>
                <td>{{$i}}</td>
                <td>{{$blog->title}}</td>
                <td>{{$blog->description}}</td>
                <td>{{$blog->start_date}}</td>
                <td>{{$blog->end_date}}</td>
                <td><img src="../uploads/{{$blog->image}}" width="100px" height="100px"></td>
                <td>
                    <form action="{{route('blog.destroy',$blog->id)}}" method="POST">

                        <a href="" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{route('blog.edit',$blog->id)}}">
                            <i class="fas fa-edit  fa-lg"></i>Edit
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>Delete
                        </button>
                    </form>
                </td>
            </tr>
         @php $i++; @endphp    
        @endforeach
    </table>

    {!! $blogs->links() !!}

@endsection