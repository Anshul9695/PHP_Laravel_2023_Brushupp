@extends('layout.app')
@section('title','User Profile')
@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-4"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"></div>
            <div class="col-md-12"><label class="labels">change Profile Picture</label><input type="file" class="form-control" name="image" id="image" placeholder="choose Image" value=""></div>
        </div>
      
        <div class="col-md-5 border-right">
        <form method="POST" id="profile_frm">
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
                        <input type="date" id="dob" name="dob"  value="{{$userInfo->dob}}" class="form-control">

                    </div>

                </div>

                <div class="mt-5 text-center"><input class="btn btn-primary profile-button" id="profile_update" type="submit" value="Update Profile" name="submit">
                    <button class="btn btn-danger profile-button" type="button" style="text-decoration: none;"><a href="{{route('logout')}}">Logout</a></button>

                </div>
              
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection