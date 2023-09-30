@extends('Admin.layouts.layout')
@section('title','Category Edit')
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-body row">
            <div class="col-2 text-center d-flex align-items-center justify-content-center">
                <div class="">

                </div>
            </div>

            <div class="col-7">
                <div id="output" style="color:red;"></div>
                <form id="category_edit_frm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$cat->id}}">
                    <div class="form-group">
                        <label for="inputName">Catefory Name</label>
                        <input type="text" id="name" name="cat_name" class="form-control" value="{{$cat->cat_name}}" />
                    </div>

                    <div class="form-group">
                        <label for="inputSubject">Image</label>
                        <input type="file" id="cat_image" name="cat_image" class="form-control" value="{{$cat->cat_image}}" />
                        <img src="{{asset('storage/uploads/catImage/'.$cat->cat_image)}}" alt="" height="50px" width="50px">
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Discription</label>
                        <textarea id="inputMessage" class="form-control" rows="4" name="cat_discription">{{$cat->cat_discription}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                    </div>
                </form>
            </div>

        </div>
    </div>

</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#category_edit_frm").submit(function(event) {
            event.preventDefault();
            var form = $("#category_edit_frm")[0];
            var data = new FormData(form);
            $.ajax({
                url: "{{route('updateCat')}}",
                method: "post",
                data: data,
                contentType: false,
                processData: false,
                success: function(res) {
                    if(res.status==200){
                        $("#output").text(res.message);
                        window.location.reload();
                    }
                },
                error: function(err) {

                }
            });
        });
    });
</script>
@endsection