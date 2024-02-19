<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryFormRequest;
use App\Models\Backend\Category;
use App\Models\Backend\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function SubCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subcategory','categories'));
    }

    public function SubCategoryStore(SubCategoryFormRequest $request)
    {
        try {
            SubCategory::Insert([
                'category_id' => $request->category_id,
                'subcategory_name_en' => $request->subcategory_name_en,
                'subcategory_name_ar' => $request->subcategory_name_ar,
                'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
                'subcategory_slug_ar' => str_replace(' ', '-', $request->subcategory_name_ar),
            ]);

            $notification = array(
                'message' => 'Sub-Category Added Successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }

    }

    public function SubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('categories', 'subcategory'));
    }

    public function SubCategoryUpdate(SubCategoryFormRequest $request)
    {
        $subcat_id = $request->id;

        try {
            SubCategory::findOrFail($subcat_id)->Update([
                'category_id' => $request->category_id,
                'subcategory_name_en' => $request->subcategory_name_en,
                'subcategory_name_ar' => $request->subcategory_name_ar,
                'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
                'subcategory_slug_ar' => str_replace(' ', '-', $request->subcategory_name_ar),
            ]);

            $notification = array(
                'message' => 'Sub-Category Updated Successfully',
                'alert-type' => 'info',
            );
            return redirect()->route('all.sub.category')->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function SubCategoryDelete($id)
    {
        SubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Sub-Category Deleted Successfully',
            'alert-type' => 'info',
        );
        return redirect()->back()->with($notification);
    }

}
