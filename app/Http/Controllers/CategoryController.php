<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // to category index page
    public function index () {
        $categories = Category::orderBy('id', 'desc')->paginate(10);

        return view('dashboard.categories.index', compact('categories'));
    }

    // to create category page
    public function createPage () {
        return view('dashboard.categories.create');
    }

    // to create category
    public function create (Request $request) {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg,webp|dimensions:max_width=400,max_height=200',
        ]);

        if ($request->status == '1') {
            $status = 1;
        } else {
            $status = 0;
        }

        $imageName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/category_images', $imageName);
        Category::create([
            'name' => $request->name,
            'image' => $imageName,
            'status' => $status,
        ]);

        return response()->json([
            'status' => 'success',
            'msg' => 'Successfully stored!',
            // 'redirectUrl' => route('categories.createPage')
        ]);
    }

    // to edit category page
    public function edit ($id) {
        $category = Category::find($id);

        return view('dashboard.categories.edit', compact('category'));
    }

    // to update category
    public function update (Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'image' => 'image|mimes:png,jpg,jpeg,svg,webp|dimensions:max_width=400,max_height=200',
        ]);

        if ($request->status == '1') {
            $status = 1;
        } else {
            $status = 0;
        }

        $category = Category::find($id);
        if ($request->hasFile('image')) {
            Storage::delete('public/category_images/' . $category->image);
            $newImage = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/category_images', $newImage);
        } else {
           $newImage = $category->image;
        }

        $category->update([
            'name' => $request->name,
            'image' => $newImage,
            'status' => $status,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // to delete category
    public function delete ($id) {
        $category = Category::find($id);
        Storage::delete('public/category_images/' . $category->image);
        $category->delete();

        return back()->with('success', 'Category deleted successfully!');
    }

    // to change status in index with ajax
    public function changeStatus (Request $request) {
        if ($request->checked == 'true') {
            $checked = 1;
        } else {
            $checked = 0;
        }

        $category = Category::find($request->categoryId);

        $category->update([
            'status' => $checked,
        ]);
    }
}
