<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubSubCategoryFormRequest;
use App\Models\Backend\Category;
use App\Models\Backend\SubCategory;
use App\Models\Backend\SubSubCategory;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    public function SubSubCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view', compact('categories', 'subsubcategory'));
    }

    public function SubSubCategoryStore(SubSubCategoryFormRequest $request)
    {
        try {
        subsubcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_ar' => $request->subsubcategory_name_ar,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_ar' => str_replace(' ', '-',$request->subsubcategory_name_ar),
        ]);

        $notification = array(
            'message' => 'Sub-SubCategory Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function SubSubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);
        return view('backend.category.sub_subcategory_edit', compact('categories', 'subcategories', 'subsubcategories'));
    }

    public function SubSubCategoryUpdate(SubSubCategoryFormRequest $request)
    {
        $subsubcat_id = $request->id;

        SubSubCategory::findOrFail($subsubcat_id)->Update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_ar' => $request->subsubcategory_name_ar,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_ar' => str_replace(' ', '-',$request->subsubcategory_name_ar),
        ]);

        $notification = array(
            'message' => 'Sub-SubCategory Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.sub.subcategory')->with($notification);
    }

    public function SubSubCategoryDelete($id)
    {
        SubSubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Sub-SubCategory Deleted Successfully',
            'alert-type' => 'info',
        );
        return redirect()->back()->with($notification);
    }

    /*
     * @return all sub category from category model to selected.
     */
    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcat);
    }

    /*
    * @return all sub category from category model to selected.
    */
    public function GetSubSubCategory($subcategory_id)
    {
        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subsubcat);
    }
}
