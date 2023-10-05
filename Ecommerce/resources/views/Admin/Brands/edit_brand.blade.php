@extends('Admin.layouts.layout')
@section('title','Brand Edit')
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
                <form id="brand_edit_frm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="brand_id" value="{{$brand->brand_id}}">
                    <div class="form-group">
                        <label for="inputName">Brand Name</label>
                        <input type="text" id="name" name="brand_name" class="form-control" value="{{$brand->brand_name}}" />
                    </div>

                    <div class="form-group">
                        <label for="inputSubject">Image</label>
                        <input type="file" id="cat_image" name="brand_image" class="form-control" value="{{$brand->brand_image}}" />
                        <img src="{{asset('storage/uploads/brandImage/'.$brand->brand_image)}}" alt="" height="50px" width="50px">
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Discription</label>
                        <textarea id="inputMessage" class="form-control" rows="4" name="brand_description">{{$brand->brand_description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Display During Product Add</label>
                      @if($brand->display_status==true)
                        <input type="checkbox" name="display_status" value="{{$brand->display_status}}" id="checkbox" checked>
                   @else
                   <input type="checkbox" name="display_status" value="{{$brand->display_status}}" id="checkbox">
                   @endif
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Update Brand">
                    </div>
                </form>
            </div>

        </div>
    </div>

</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#checkbox').val($(this).is(':checked'));
        $('#checkbox').click(function() {
            $('#checkbox').val($(this).is(':checked'));
        });
        $("#brand_edit_frm").submit(function(event) {
            event.preventDefault();
            var form = $("#brand_edit_frm")[0];
            var data = new FormData(form);
            $.ajax({
                url: "{{route('updateBrand')}}",
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