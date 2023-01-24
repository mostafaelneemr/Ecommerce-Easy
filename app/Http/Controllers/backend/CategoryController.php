<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function CategoryView()
    {
        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category'));
    }

    public function CategoryStore(Request $request)
    {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_ar' => 'required',
            'category_icon' => 'required',
            ]);

        try {
            Category::insert([
               'category_name_en' => $request->category_name_en,
               'category_name_ar' => $request->category_name_ar,
               'category_slug_en' => strtolower(str_replace(' ','-', $request->category_name_en)),
               'category_slug_ar' =>  str_replace(' ','-', $request->category_name_ar),//str::slug($request->category_name_ar),
               'category_icon' => $request->category_icon,
            ]);

            $notification = array(
                'message' => 'Category Added Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function CategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request)
    {
        $category_id = $request->id;
        $request->validate([
            'category_name_en' => 'required',
            'category_name_ar' => 'required',
            'category_icon' => 'required',
        ]);

        Category::findOrFail($category_id)->Update([
            'category_name_en' => $request->category_name_en,
            'category_name_ar' => $request->category_name_ar,
            'category_slug_en' => strtolower(str_replace(' ','-', $request->category_name_en)),
            'category_slug_ar' =>  str_replace(' ','-', $request->category_name_ar),//str::slug($request->category_name_ar),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'info',
        );
        return redirect()->route('all.category')->with($notification);
    }

    public function CategoryDelete($id)
    {
        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
