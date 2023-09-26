@extends('layout.app')
@section('title','Create Blog')

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">

        <div class="col-md-5 border-right">
        <div class="col-md-12"><a href="{{route('postListByUser')}}" ><button class="btn btn-primary"> My Blog List</button></a></div> <br>

            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Create New Blog Post</h4>
                </div>
                <div id="show_error_msg"></div>
                <form id="blog_frm" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Blog Name:
                            </label>
                            <div class="invalid-feedback"></div>
                            <input type="text" name="blog_name" class="form-control" placeholder="Enter Blog Name">
                          
                        </div>
                        <div class="col-md-12"><label class="labels">Blog Title:
                            </label>
                            <div class="invalid-feedback"></div>
                            <input type="text" name="blog_title" class="form-control" placeholder="Enter Blog title">
                            
                        </div>
                        <div class="col-md-12"><label class="labels">Blog discription:
                            </label>
                            <div class="invalid-feedback"></div>
                            <textarea name="discription" id="editor"> </textarea>
                         
                        </div>
                        <label for="status">Status:</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                        </select>
                        <div class="col-md-12"><label class="labels">Blog Image</label>
                        <input type="file" class="form-control" name="blog_image" id="blog_image" placeholder="choose Image" />
                        <div class="invalid-feedback"></div>
                    </div>
                    </div>
                    <input type="submit" name="submit" id="submit" value="Create Post" class="btn btn-primary profile-button">
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
ClassicEditor
		.create( document.querySelector( '#editor' ) )
		.catch( error => {
			console.error( error );
		} );

    $(document).ready(function() {
        $("#blog_frm").submit(function(event) {
            event.preventDefault();
            var form = $("#blog_frm")[0];
            var data = new FormData(form);
            $.ajax({
                enctype: 'multipart/form-data',
                url: "{{route('savePost')}}",
                method: "post",
                data:data,
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.status==400){
                        showError('blog_name',response.message.blog_name);
                        showError('blog_title',response.message.blog_title);
                        showError('blog_image',response.message.blog_image);
                    }else{
                        $("#show_error_msg").html(showMessage('success',response.message));
                        $("#blog_frm")[0].reset();
                    }
                }
            });
        });
    });
</script>
@endsection