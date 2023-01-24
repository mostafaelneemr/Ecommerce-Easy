<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Brand;
use App\Models\Backend\Category;
use App\Models\Backend\MultiImg;
use App\Models\Backend\Product;
use App\Models\Backend\SubCategory;
use App\Models\Backend\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands'));
    }

    public function StoreProduct(Request $request)
    {
        try {
            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
            $save_url = 'upload/products/thumbnail/' . $name_gen;

            $product_id = Product::insert([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_id' => $request->subsubcategory_id,
                'product_name_en' => $request->product_name_en,
                'product_name_ar' => $request->product_name_ar,
                'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
                'product_slug_ar' => str_replace(' ', '-', $request->product_name_ar),
                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'product_tags_en' => $request->product_tags_en,
                'product_tags_ar' => $request->product_tags_ar,
                'product_size_en' => $request->product_size_en,
                'product_size_ar' => $request->product_size_ar,
                'product_color_en' => $request->product_color_en,
                'product_color_ar' => $request->product_color_ar,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'short_desc_en' => $request->short_desc_en,
                'short_desc_ar' => $request->short_desc_ar,
                'long_desc_en' => $request->long_desc_en,
                'long_desc_ar' => $request->long_desc_ar,
                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,
                'status' => 1,
                'created_at' => Carbon::now(),
                'product_thumbnail' => $save_url,
            ]);

            // multi image upload
            $images = $request->file('multi_img');
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
                $uploadPath = 'upload/products/multi-image/'.$make_name;

                MultiImg::insert([
                    'product_id' => $product_id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }

            $notification = array(
                'message' => 'Product Added Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            return redirect()->route('manage.product')->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function ManageProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }

    public function EditProduct($id)
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('categories', 'brands', 'subcategories', 'subsubcategories', 'products'));
    }

    public function UpdateProduct(Request $request)
    {
        return $request->id;
    }

//<div class="form-group">
//<h5>Main Thumbnail <span class="text-danger">*</span></h5>
//<div class="controls">
//<input type="file" name="product_thumbnail" class="form-control mb-2" onChange="mainThumUrl(this)" required>
//@error('product_thumbnail')
//<span class="text-danger">{{ $message }}</span>
//@enderror
//                                                        <img src="" id="mainThumb" >
//                                                    </div>
//                                                </div>
//
//                                                <div class="form-group">
//                                                    <h5>Multiple Image  <span class="text-danger">*</span></h5>
//                                                    <div class="controls">
//                                                        <input type="file" name="multi_img[]" class="form-control mb-2" multiple="" id="multiImg" required>
//@error('multi_img')
//                                                        <span class="text-danger">{{ $message }}</span>
//@enderror
//                                                        <div class="row" id="preview_img"></div>
//                                                    </div>
//                                                </div>


}
