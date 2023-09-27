@extends('layout.app')
@section('title','Create Blog')

@section('content')
<meta name="_token" content="{{ csrf_token() }}"/>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container pb50">
    <div class="row">
        <div class="col-md-7 mb40">
            <article>
                <img src="{{asset('storage/uploads/blogs/'.$data[0]->blog_image)}}" alt="" class="img-fluid mb30">
                <div class="post-content">
                    <h3>{{$data[0]->blog_title}}</h3>
                    <ul class="post-meta list-inline">
                        <li class="list-inline-item">
                            <i class="fa fa-user-circle-o"></i> <a href="#"> {{$data[0]->author_name}}</a>
                        </li>
                        <li class="list-inline-item">
                            <i class="fa fa-calendar-o"></i> <a href="#">{{$data[0]->created_at}}</a>
                        </li>
                        <li class="list-inline-item">
                            <i class="fa fa-tags"></i> <a href="#">{{$data[0]->blog_name}}</a>
                        </li>
                    </ul>
                    <p> {!!$data[0]->discription!!} </p>
                </div>
            </article>
            <!-- post article-->
            <hr class="mb40">
            <h4 class="mb40 text-uppercase font500">Comments</h4>
           
@foreach($data as $comments)
@if($comments->c_name =='')
<h6>NO Comment found Yet..</h6>
@else
            <div class="media mb100">
                <i class="d-flex mr-3 fa fa-user-circle-o fa-3x"></i>
                <div class="media-body">
                    <h6 class="mt-0 font400 clearfix">
                        <a href="#" class="float-right">
                        {{$comments->c_name}}
                        </a>
                    </h6> 
                    {!!$comments->comment!!}
                </div>
            </div>
            @endif
           
            @endforeach
            


        </div>
        <div class="col-md-5 mb40">

            <div>
                <hr class="mb40">
                <div id="show_error_msg"></div>
                <h4 class="mb40 text-uppercase font500">Post a comment</h4>
                <form id="comment_frm">
                    <input type="hidden" name="blog_id" value="{{$data[0]->id}}">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="your email">
                    </div>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea class="form-control" name="comment" rows="5" id="editor"></textarea>
                    </div><br />
                    <div class="clearfix float-right">
                        <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Add Comment">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
    $(document).ready(function() {
        $("#comment_frm").submit(function(event) {
            event.preventDefault();
            var form=$("#comment_frm")[0];
            var data=new FormData(form);
            // console.log(data);
            $.ajax({
                url: "{{url('addComment')}}",
                method: 'POST',
                data: data,
                dataType:'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#show_error_msg").html(showMessage('success',response.message));
                        $("#comment_frm")[0].reset();
                        location.reload();
                }
            });
        });
    });
</script>
@endsection