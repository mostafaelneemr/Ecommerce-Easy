@extends('admin.admin_master')

@section('title')
    Easy Ecommerce Sub-SubCategory
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
                            <h3 class="box-title">Add Sub-SubCategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form action="{{route('sub.subcategory.update')}}" method="post" >
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $subsubcategories->id }}"   >

                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control" >
                                                <option value="" selected disabled>Select Your Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $subsubcategories->category_id ? 'selected':'' }}>
                                                        {{ $category->category_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" class="form-control" >
                                                <option value="" selected disabled>Your SubCategory</option>
                                                @foreach($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == $subsubcategories->subcategory_id ? 'selected':'' }}>
                                                        {{ $subcategory->subcategory_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('subcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-SubCategory English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_en" class="form-control" value="{{ $subsubcategories->subsubcategory_name_en }}">
                                            @error('subsubcategory_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-SubCategory Arabic<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_ar" class="form-control" value="{{ $subsubcategories->subsubcategory_name_ar }}"></div>
                                        @error('subsubcategory_name_ar')
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

@section('script')
      get sub category to insert sub sub category after inset category
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="category_id"]').on('change', function () {
                var category_id = $(this).val();
                if(category_id) {
                    $.ajax({
                        url: "{{ url('/category/sub/sub/subcategory') }}/"+category_id,
                        type: "GET",
                        dataType: "json",
                        success:function (data) {
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function (key,value){
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name_en + '</option>');
                            });
                        },
                    });
                }else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection
