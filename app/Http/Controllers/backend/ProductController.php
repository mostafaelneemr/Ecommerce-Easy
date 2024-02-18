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

            $product_id = Product::create([
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

                MultiImg::Insert([
                    'product_id' => $product_id->id,
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
        $multiImg = MultiImg::where('product_id', $id)->get();

        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('categories', 'brands', 'subcategories', 'subsubcategories', 'products', 'multiImg'));
    }

    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
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
        ]);

        $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('manage.product')->with($notification);

    }

    public function MultiImgUpdate(Request $request)
    {
        $imgs = $request->multi_img;

        foreach($imgs as $id => $img){
            $imgDel = MultiImg::findOrFail($id);
            @unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $make_name);
            $updatePath = 'upload/products/multi-image/' . $make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' => $updatePath,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Product Image Updated Successfully',
                'alert-type' => 'info',
            );

            return redirect()->back()->with($notification);
        }

    }

    // product main thumbnail update
    public function ThumbnailImgUpdate(Request $request)
    {
        $pro_id = $request->id;
        $old_image = $request->old_image;
        unlink($old_image);

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        Product::findOrFail($pro_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product thumbnail Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    public function MultiImgDelete($id)
    {
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);

        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product thumbnail Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function InactiveProduct($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function ActiveProduct($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteProduct($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id);
        foreach ($images as $img){
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);


    }
    // end method
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
