<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    //Direct Category Page
    public function categoryPage()
    {
        $category = Category::when(request('searchKey'), function ($query) {
            $query->where('category_name', 'LIKE', '%' . request('searchKey') . '%');
        })->get();
        return view('admin.category', compact('category'));
    }

    //Create categroy
    public function categoryCreate(Request $request)
    {
        $this->categoryValidationCheck($request);
        $category = Category::get();
        $name = $request->categoryName;
        Category::create([
            'category_name' => $name,
        ]);
        return back()->with(['createSuccess' => "Category successfully added."]);
    }

    //Delete category
    public function categoryDelete($id)
    {
        Category::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => "Category successfully deleted."]);
    }

    //Direct category edit page
    public function categoryEdit($id)
    {
        $data = Category::where('id', $id)->first();
        return view('admin.categoryEdit', compact('data'));
    }

    //Update category
    public function categoryUpdate(Request $request)
    {
        Category::where('id', $request->id)->update([
            'category_name' => $request->categoryName,
        ]);
        return redirect()->route('admin#categoryPage')->with(['updateSuccess' => 'Category update success.']);
    }





    //Check category validation
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required'
        ])->validate();
    }
}