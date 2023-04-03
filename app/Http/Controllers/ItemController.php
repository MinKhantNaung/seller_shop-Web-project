<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // to items index
    public function index()
    {
        $items = Item::orderBy('id', 'desc')->paginate(10);

        return view('dashboard.items.index', compact('items'));
    }

    // to create item page
    public function createPage()
    {
        $categories = Category::all();

        return view('dashboard.items.create', compact('categories'));
    }

    // to create item
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'category_id' => 'required',
            'description' => 'required|string|min:5',
            'price' => 'required|max:10',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg,webp|dimensions:max_width=400,max_height=200',
            'owner_name' => 'required|min:4',
            'phone' => 'required|min:9|max:11',
            'address' => 'required',
            'condition' => 'required',
            'type' => 'required',
        ]);

        if ($request->is_publish == '1') {
            $publish = 1;
        } else {
            $publish = 0;
        }
        // for store description from ckeditor without html codes
        $desc = preg_replace('/<\/?[^>]+>/i', '', $request->description);

        $image = uniqid() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/item_images', $image);

        Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $desc,
            'price' => $request->price,
            'image' => $image,
            'owner_name' => $request->owner_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'coordinates' => $request->coordinates,
            'is_publish' => $publish,
            'condition' => $request->condition,
            'type' => $request->type,
        ]);

        return redirect()->route('items.index')->with('success', 'Item created successfully!');
    }

    // to edit item page
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();

        return view('dashboard.items.edit', compact('item', 'categories'));
    }

    // to update item
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'category_id' => 'required',
            'description' => 'required|string|min:5',
            'price' => 'required|max:10',
            'image' => 'image|mimes:png,jpg,jpeg,svg,webp|dimensions:max_width=400,max_height=200',
            'owner_name' => 'required|min:4',
            'phone' => 'required|min:9|max:11',
            'address' => 'required',
            'condition' => 'required',
            'type' => 'required',
        ]);

        if ($request->is_publish == '1') {
            $publish = 1;
        } else {
            $publish = 0;
        }

        $item = Item::find($id);
        if ($request->hasFile('image')) {
            Storage::delete('public/item_images/' . $item->image);
            $newImage = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/item_images', $newImage);
        } else {
            $newImage = $item->image;
        }

        // for store description from ckeditor without html codes
        $desc = preg_replace('/<\/?[^>]+>/i', '', $request->description);

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $desc,
            'price' => $request->price,
            'image' => $newImage,
            'owner_name' => $request->owner_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'coordinates' => $request->coordinates,
            'is_publish' => $publish,
            'condition' => $request->condition,
            'type' => $request->type,
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }

    // to delete item
    public function delete($id)
    {
        $item = Item::find($id);
        Storage::delete('public/item_images/' . $item->image);
        $item->delete();

        return back()->with('success', 'Item deleted successfully!');
    }

    // to change publish status with ajax in index page
    public function changeStatus(Request $request)
    {
        if ($request->checked == 'true') {
            $checked = 1;
        } else {
            $checked = 0;
        }

        $item = Item::find($request->itemId);

        $item->update([
            'is_publish' => $checked,
        ]);
    }
}
