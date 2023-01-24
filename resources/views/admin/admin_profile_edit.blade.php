@extends('admin.admin_master')

@section('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection

@section('admin')
<div class="container-full">
    <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Admin Profile Edit</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{route('admin.profileStore')}}" method="get" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5> Admin User name <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" value="{{$editData->name}}" class="form-control"></div>
                                                </div>
                                            </div> <!-- end col md 6 -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Admin Email <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="email" name="email"  value="{{$editData->email}}" class="form-control"></div>
                                                </div>
                                            </div> <!-- end col md 6 -->
                                        </div> <!-- end row -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Profile Image <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" id="image" name="profile_photo_path" class="form-control" required></div>
                                                </div>
                                            </div><!-- end col md 6 -->

                                            <div class="col-md-6">
                                                <img src="{{(!empty($editData->profile_photo_path))?url('upload/admin_images/'.$editData->profile_photo_path):url('upload/no_image.jpg') }}"
                                                     alt="" id="showImage" style="width: 100px; height: 100px">
                                            </div><!-- end col md 6 -->
                                        </div> <!-- end row -->

                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-success mb-5" value="update" />
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
        <!-- /.box -->
    </section>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
