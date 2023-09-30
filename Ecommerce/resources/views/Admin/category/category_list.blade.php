@extends('Admin.layouts.layout')
@section('title','Category List')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Category List Table </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped" id="category_table">
            <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Category Name</th>
                    <th>Discription</th>
                    <th>Category Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{route('CateList')}}",
            method: "GET",
            success: function(data) {
                if (data.data.length > 0) {

                    for (let i = 0; i < data.data.length; i++) {
                        let img = data.data[i]['cat_image'];
                        $("#category_table").append(`<tr>
                        <td>` + (i + 1) + `</td>
                        <td>` + (data.data[i]['cat_name']) + `</td>
                        <td>` + (data.data[i]['cat_discription']) + `</td>
                        <td><img src="{{asset('storage/uploads/catImage/` + img + `')}}" height="50px;" width="50px;"></td>
                        <td><a href="editCat/` + (data.data[i]['id']) + `"><button class="btn btn-primary">Edit</button></a></td>
                        <td><a href="#" class="deleteData" data-id="` + (data.data[i]['id']) + `"><button class="btn btn-danger">Delete</button></a></td>
                        </tr>`);
                    }
                } else {
                    $("#category_table").text("No Data found Here");
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
        $("#category_table").on("click", ".deleteData", function() {
            var id = $(this).attr('data-id');
            var obj=$(this);
            $.ajax({
                url: "deleteData/" +id,
                method: "GET",
                success: function(res) {
                    $(obj).parent().parent().remove();
                    $("#output").text(res.message);
                },
                error: function(err) {
                    console.log(err);
                }
            })
        })

    });
</script>
@endsection