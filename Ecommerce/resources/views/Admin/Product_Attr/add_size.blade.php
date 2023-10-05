@extends('Admin.layouts.layout')
@section('title','Size')
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
                <form id="size_frm">
                    @csrf
                    <div class="form-group">
                        <label for="inputName">Sku</label>
                        <input type="text" id="sku" name="sku" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="inputName">Size</label>
                        <input type="text" id="Size" name="size" class="form-control" />
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Size">
                    </div>
                </form>
            </div>

        </div>
    </div>

</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#size_frm").submit(function(event) {
            event.preventDefault();
            var form = $(this)[0];
            var data = new FormData(form);
            $.ajax({
                url: "{{route('sizeAdd')}}",
                method: "post",
                data: data,
                contentType: false,
                processData: false,
                success: function(responce) {
                    $("#output").text(responce.message);
                  $("input[type='text']").val('');
                  $("input[type='text']").val('');
                },
                error: function(error) {

                }
            });

        });

    });
</script>
@endsection