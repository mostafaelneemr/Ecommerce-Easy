@extends('frontend.master')

@section('title')
    change password
@endsection

@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"><br>
                    <img class="card-img-top" style="border-radius: 50%;"
                         src="{{(!empty($user->profile_photo_path))?url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}"
                         width="100%" height="100%" > <br><br>

                    <ul class="list-group-flush">
                        <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile update</a>
                        <a href="{{route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change password</a>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a> <br>
                    </ul>
                </div> <!-- //end col md -->

                <div class="col-md-2"></div> <!-- //end col md -->

                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Change Password</span></h3>
                        <div class="card-body">
                            <form method="post" action="{{route('user.password.update')}}">
                                @csrf

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">Current Password </label>
                                    <input type="password" id="current_password" name="oldpassword" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">New Password </label>
                                    <input type="password" id="password" name="password" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">Confirm Password </label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" >
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div> <!-- //end col md -->
            </div>
        </div>
    </div>
@endsection
