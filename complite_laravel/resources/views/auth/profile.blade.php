@extends('layout.app')
@section('title','User Profile')
@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">

        <div class="col-md-3 border-right">
            @if($userInfo->picture)
            <div class="d-flex flex-column align-items-center text-center p-3 py-4"><img id="image_preview" class="rounded-circle mt-5" width="150px" src="{{asset('storage/uploads/images/'.$userInfo->picture)}}"></div>
            @else
            <div class="d-flex flex-column align-items-center text-center p-3 py-4"><img id="image_preview" class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"></div>
            @endif
            <div class="col-md-12"><label class="labels">change Profile Picture</label><input type="file" class="form-control" name="picture" id="picture" placeholder="choose Image" value=""></div>
            <div class="mt-5 text-center">
                            <button class="btn btn-danger profile-button" type="button" style="text-decoration: none;"><a href="{{route('logout')}}">Logout</a></button>
                        </div>
        </div>
     
        <div class="col-md-5 border-right">
        <div id="show_error_msg"></div>
            <form id="profile_frm">
                <input type="hidden" name="id" id="id" value="{{$userInfo->id}}">
@csrf
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">User Profile</h4>
                       
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Name</label><input type="text" name="name" class="form-control" placeholder="name" value="{{$userInfo->name}}"></div>
                        <div class="col-md-6"><label class="labels">Email</label><input type="email" name="email" class="form-control" placeholder="Email" value="{{$userInfo->email}}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" name="phone" class="form-control" placeholder="enter phone number" value="{{$userInfo->phone}}"></div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="gender">Gender:</label>
                            <select name="gender" class="form-control">
                                <option value="" selected disabled>Please select one…</option>
                                <option value="female" {{$userInfo->gender=='female'?'selected':''}}>Female</option>
                                <option value="male" {{$userInfo->gender=='male'?'selected':''}}>Male</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="birthday">Birthday:</label>
                            <input type="date" id="dob" name="dob" value="{{$userInfo->dob}}" class="form-control">
                        </div>
                    </div>

                    <div class="mt-5 text-center"><input class="btn btn-primary profile-button" id="profile_update" type="submit" value="Update Profile" name="submit">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Manage Blogs</span></div><br>
                <div class="col-md-12"><a href="" >My Blog List</a></div> <br>
                <div class="col-md-12"><a href="{{route('create_blog')}}" >Create New Blog</a></div> <br>
                <div class="col-md-12"><a href="" >Trash Blog List</a></div> <br>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("#picture").change(function(e) {
            const file = e.target.files[0];
            let url = window.URL.createObjectURL(file);
            $("#image_preview").attr('src', url);
            let fd = new FormData();
            fd.append('picture', file);
            fd.append('id', $("#id").val());
            fd.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: "{{route('update_profile')}}",
                method: "post",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if(response.status==200){
                        $("#show_error_msg").html(showMessage('success',response.message));
                         $("#picture").val('');
                    }
                }

            });
        });
        $("#profile_frm").submit(function(event) {
            event.preventDefault();
            $("#profile_update").val("Updating..");
            var id = $("#id").val();
            $.ajax({
                method: 'post',
                url:'{{route("update_profile_data")}}',
                data: $(this).serialize() + `&id=${id}`,
                dataType: 'json',
                success: function(response) {
                    if(response.status==200){
                        $("#show_error_msg").html(showMessage('success',response.message));
                        $("#profile_update").val("Update Profile");
                    }
                }

            });
        });
    });
</script>
@endsection