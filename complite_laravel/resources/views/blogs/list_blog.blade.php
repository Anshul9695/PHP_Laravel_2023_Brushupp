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
            <th scope="col">Status</th>
            <th scope="col">Author Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>

        <!-- <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>@mdo</td>
        </tr> -->
 
</table>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{route('get_post_list')}}",
            method: "GET",
           success:function(data){
            console.log(data);
            if (data.blog_list.length > 0) {
                    for (let i = 0; i < data.blog_list.length; i++) {
                       
                        let img = data.blog_list[i]['blog_image'];
                        // let status=data.blog_list[i]['status'];
                        // alert(status);
                        $("#post_list").append(`<tr>
                        <td>` + (i + 1) + `</td>
                        <td>` + (data.blog_list[i]['blog_name']) + `</td>
                        <td>` + (data.blog_list[i]['blog_title']) + `</td>
                        <td>` + (data.blog_list[i]['discription']) + `</td>
                        <td><img src="{{asset('storage/uploads/blogs/` + img + `')}}" hieght="50px" width="50px"></td>
                        <td>` + (data.blog_list[i]['status']) + `</td>
                        <td>` + (data.blog_list[i]['name']) + `</td>
                        <td><a href="editUser/` + (data.blog_list[i]['id']) + `"><button class="btn btn-success">Edit</button></a>
                        <a href="#" class="deleteData" data-id="` + (data.blog_list[i]['id']) + `"><button class="btn btn-danger">Delete</button></a>
                        </td>
                        </tr>`);

                    }

                } else {
                    $("#post_list").append("<tr><td>No Record Found</td></tr>");
                }
           }
        });
    });
</script>
@endsection