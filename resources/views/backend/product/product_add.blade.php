@extends('admin.admin_master')

@section('title')
    Easy Ecommerce Product
@endsection

@section('admin')

        <div class="container-full">

            <!-- Main content -->
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Add Product</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('store.product') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row"> <!-- start row 1 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Brand Select <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="brand_id" class="form-control" required >
                                                                <option value="" selected disabled>Select Brand</option>
                                                                @foreach($brands as $brand)
                                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('brand_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="category_id" class="form-control" required>
                                                                <option value="" selected disabled>Select Category</option>
                                                                @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="subcategory_id" class="form-control" required>
                                                                <option value="" selected disabled>Select SubCategory</option>

                                                            </select>
                                                            @error('subcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row 1 -->

                                            <div class="row"> <!-- start row 2 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Sub-SubCategory Select <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="subsubcategory_id" class="form-control" required>
                                                                <option value="" selected disabled>Select subsubcategory</option>

                                                            </select>
                                                            @error('subsubcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Name En <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_name_en" class="form-control" required>
                                                            @error('product_name_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Name Ar <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_name_ar" class="form-control" required>
                                                            @error('product_name_ar')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row 2 -->

                                            <div class="row"> <!-- start row 3 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Code <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_code" class="form-control" required>
                                                            @error('product_code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Quantity <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_qty" class="form-control" required>
                                                            @error('product_qty')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Tags En <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_tags_en" class="form-control" value="Lorem,Ipsum,Amet" data-role="tagsinput" required>
                                                            @error('product_tags_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row 3 -->

                                            <div class="row"> <!-- start row 4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Tags Ar <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_tags_ar" class="form-control" value="Lorem,Ipsum,Amet" data-role="tagsinput" required>
                                                            @error('product_tags_ar')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Size En <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_size_en" class="form-control" value="small,medium,large" data-role="tagsinput" required>
                                                            @error('product_size_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Size Ar <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_size_ar" class="form-control" value="small,medium,large" data-role="tagsinput" required>
                                                            @error('product_size_ar')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row 4 -->

                                            <div class="row"> <!-- start row 5 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Color En <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_color_en" class="form-control" value="red,black,Amet" data-role="tagsinput" required>
                                                            @error('product_color_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Color Ar <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_color_ar" class="form-control" value="red,black,large" data-role="tagsinput" required>
                                                            @error('product_color_ar')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="selling_price" class="form-control" required>
                                                            @error('selling_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row 5 -->

                                            <div class="row"> <!-- start row 6 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="discount_price" class="form-control" required>
                                                            @error('discount_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Main Thumbnail <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="product_thumbnail" class="form-control mb-2" onChange="mainThumUrl(this)" required>
                                                            @error('product_thumbnail')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            <img src="" id="mainThumb" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Multiple Image  <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="multi_img[]" class="form-control mb-2" multiple="" id="multiImg" required>
                                                            @error('multi_img')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            <div class="row" id="preview_img"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row 6 -->

                                            <div class="row"> <!-- start row 7 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Short Description English <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <textarea name="short_desc_en" id="textarea" class="form-control" required placeholder="Textarea text"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Short Description Arabic <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <textarea name="short_desc_ar" id="textarea" class="form-control" required placeholder="Textarea text"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row 7 -->



                                            <div class="row"> <!-- start row 8 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Long Description English <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <textarea id="editor1" name="long_desc_en" rows="10" cols="80" required>
                                                                This is my textarea to be replaced with CKEditor.
						                                    </textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Long Description Arabic <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <textarea id="editor2" name="long_desc_ar" rows="10" cols="80" required>
                                                                This is my textarea to be replaced with CKEditor.
						                                    </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row 8 -->

                                        </div>
                                    </div>

                                    <hr />

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
                                                        <label for="checkbox_2">Hot Deals</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_3" name="featured" value="1">
                                                        <label for="checkbox_3">Featured</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_4" name="special_offer" value="1">
                                                        <label for="checkbox_4">Special Offer</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="checkbox" id="checkbox_5" name="special_deals" value="1">
                                                        <label for="checkbox_5">Special Deals</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Product">
                                    </div>
                                </form>

                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </section><!-- /.content -->
        </div>
@endsection

@section('script')
    {{--  get sub category and sub sub category to add product--}}
    <script type="text/javascript">
        $(document).ready(function () {
            //add sub category after select category
            $('select[name="category_id"]').on('change', function () {
                var category_id = $(this).val();
                if(category_id) {
                    $.ajax({
                        url: "{{ url('/category/sub/sub/category') }}/"+category_id,
                        type: "GET",
                        dataType: "json",
                        success:function (data) {
                            $('select[name="subsubcategory_id"]').html('');
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

            // add sub sub category after select sub category
            $('select[name="subcategory_id"]').on('change', function () {
                var subcategory_id = $(this).val();
                if(subcategory_id) {
                    $.ajax({
                        url: "{{ url('/category/sub/sub/subcategory') }}/"+subcategory_id,
                        type: "GET",
                        dataType: "json",
                        success:function (data) {
                            var d = $('select[name="subsubcategory_id"]').empty();
                            $.each(data, function (key,value){
                                $('select[name="subsubcategory_id"]').append('<option value="'+ value.id + '">' + value.subsubcategory_name_en + '</option>');
                            });
                        },
                    });
                }else {
                    alert('danger');
                }
            });
        });
    </script>

    {{-- show image after select image from field main thumbnail --}}
    <script type="text/javascript">
        function mainThumUrl(input) {
            if(input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#mainThumb').attr('src',e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

{{-- show multi image after select image product --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('#multiImg').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file){ //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                                        .height(80); //create image element
                                    $('#preview_img').append(img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });

    </script>
@endsection
