@extends('layout.app')
@section('title','Create Blog')

@section('content')
<table class="table" id="post_list">
    <thead>
        <tr>
            <th scope="col">S.N</th>
            <th scope="col">Blog Name:</th>
            <th scope="col">Blog Title</th>
            <th scope="col">Discription</th>
            <th scope="col">Image</th>
            <th scope="col">Author Name</th>
            <th scope="col">View Details</th>
        </tr>
    </thead>
    @foreach($list as $post_list)
     <tr>
            <td scope="row">{{$post_list->id}}</td>
            <td>{{$post_list->blog_name}}</td>
            <td>{{$post_list->blog_title}}</td>
            <td>{!!$post_list->discription!!}</td>
            <td><img src="{{asset('/storage/uploads/blogs/'.$post_list->blog_image)}}" style="height: 50px; width:50px;"></td>
            <td>{{$post_list->author_name}}</td>
            <td><a href="{{url('viewDetails/'.$post_list->id)}}" > <button class="btn btn-primary">View Details</button></a> </td>
        </tr>
        @endforeach
</table>
@endsection

@section('script')

@endsection