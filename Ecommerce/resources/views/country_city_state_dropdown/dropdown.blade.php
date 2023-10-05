@extends('Admin.layouts.layout')
@section('title','Mulit DropDown')
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
                <form id="dropdown_select">
                    @csrf
                    <div class="form-group">
                        <label for="inputName">Country</label>
                        <select id="country" class="form-control">
                            <option value="">select the country</option>
                            @foreach($country as $countryData)
                            <option value="{{$countryData->country_id}}">{{$countryData->country_name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="inputSubject">City</label>
                        <select id="city" class="form-control">
                            <option value="">select the city</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputMessage">State</label>
                        <select id="state" class="form-control">
                            <option value="">select the state</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Village</label>
                        <select id="village" class="form-control">
                            <option value="">select the village</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="submit" value="Select Dropdown">
                    </div>
                </form>
            </div>

        </div>
    </div>

</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#country").change(function() {
            var country_id = $(this).val();

            $("#city").find('option:not(:first)').remove();
            $("#state").find('option:not(:first)').remove();
            $("#village").find('option:not(:first)').remove();
            $.ajax({
                url: "{{url('getCity')}}/" + country_id,
                type: 'post',
                dataType: 'json',
                success: function(responce) {
                    if (responce['cityData'].length > 0) {
                        $.each(responce['cityData'], function(key, val) {
                            $("#city").append("<option value='" + val['city_id'] + "'>" + val['city_name'] + "</option>")
                        });
                    }
                },
                error: function(error) {

                }
            })
        });

        $("#city").change(function() {
            $("#state").find('option:not(:first)').remove();
            $("#village").find('option:not(:first)').remove();
            var city_id = $(this).val();
            $.ajax({
                url: "{{url('getState')}}/" + city_id,
                method: 'post',
                dataType: 'json',
                success: function(res) {
                    if (res['state'].length > 0) {
                        $.each(res['state'], function(key, val) {
                            $("#state").append("<option value='" + val['state_id'] + "'>" + val['state_name'] + "</option>")
                        });
                    }

                },
                error: function(err) {

                }
            })
        })
        $("#state").change(function() {
            var state_id = $(this).val();
            $.ajax({
                url:"{{url('getVillage')}}/"+state_id,
                method:'post',
                dataType:'json',
                success:function(res){
if(res['village'].length>0){
    $.each(res['village'],function(key,val){
        $("#village").append("<option value='"+val['village_id']+"'>"+val['village_name']+"</option>")
    })
}
                },
                error:function(err){

                }
            })
        });

    });
</script>
@endsection