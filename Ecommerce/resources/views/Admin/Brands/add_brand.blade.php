@extends('Admin.layouts.layout')
@section('title','Brand')
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
                <form id="brand_frm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputName">Brand Name</label>
                        <input type="text" id="brand_name" name="brand_name" class="form-control" />
                        <span id="brand_div"></span>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Discription</label>
                        <textarea id="brand_desc" class="form-control" rows="4" name="brand_description"></textarea>
                        <span id="brand_desc_div"></span>
                    </div>
                    <div class="form-group">
                        <label for="inputSubject">Image</label>
                        <input type="file" id="cat_image" name="brand_image" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="inputMessage">Display During Product Add</label>
                        <input type="checkbox" name="display_status" value="true" id="checkbox">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Brand">
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

        $("#brand_frm").submit(function(event) {
            event.preventDefault();
            var form = $("#brand_frm")[0];
            var data = new FormData(form);
            $.ajax({
                url: "{{route('add_brand_post')}}",
                method: "post",
                data: data,
                contentType: false,
                processData: false,
                success: function(res) {
                  

                    if(res.status==400){
                        $("#brand_div").text(res.message.brand_name);
                        $("#brand_desc_div").text(res.message.brand_description);
                    }else{
                        $("#output").text(res.message);
                        $('input[type="text"]').val('');
                        $("#brand_desc").html('');
                    }
                      
                },
                error: function(err) {

                }

            });
        });
    });
</script>
@endsection