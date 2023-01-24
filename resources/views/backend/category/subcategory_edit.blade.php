@extends('admin.admin_master')

@section('title')
    Easy Ecommerce Sub-Category
@endsection

@section('admin')
    @include('backend.message')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-full">

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Sub-Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form action="{{route('subcategory.update')}}" method="post" >
                                    @csrf

                                    <input type="hidden" value="{{ $subcategory->id }}" name="id">

                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control" >
                                                <option value="" selected disabled>Select Your Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{$category->id == $subcategory->category_id ? 'selected' : ''}}>
                                                        {{ $category->category_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-Category English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_en" value="{{ $subcategory->subcategory_name_en }}" class="form-control">
                                            @error('subcategory_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-Category Arabic<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_ar" value="{{ $subcategory->subcategory_name_ar }}" class="form-control"></div>
                                        @error('subcategory_name_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update" />
                                    </div>

                                </form>

                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div>
@endsection
