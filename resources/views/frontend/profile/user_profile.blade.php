@extends('frontend.master')

@section('title')
    user profile
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
                        <h3 class="text-center"><span class="text-danger">Hi.....</span><strong>{{ Auth::user()->name }}</strong> Update Your Profile</h3>
                        <div class="card-body">
                            <form method="post" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">Name </label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control" >
{{--                                    @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong> {{ $message }} </strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">Email </label>
                                    <input type="email" name="email" value="{{$user->email}}" class="form-control" >
{{--                                    @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong> {{ $message }} </strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">Phone </label>
                                    <input type="text" name="phone" value="{{$user->phone}}" class="form-control" >
{{--                                    @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong> {{ $message }} </strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">User Image </label>
                                    <input type="file" name="profile_photo_path" class="form-control" >
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
