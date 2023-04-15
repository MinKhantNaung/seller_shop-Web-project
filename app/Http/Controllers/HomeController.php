<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $items = Item::orderBy('id', 'desc')->limit(8)->get();

        return view('home.index', compact('categories', 'items'));
    }

    // to search page with name and category
    public function search(Request $request)
    {
        $searchKey = $request->input('searchKey');
        $categoryId = $request->input('category_id');

        $items = Item::query();

        if ($categoryId == '') {
            $items->where('name', 'LIKE', '%' . $searchKey . '%');
        } else {
            $items->where('name', 'LIKE', '%' . $searchKey . '%')
                ->where('category_id', $categoryId);
        }

        $categories = Category::all();
        $items = $items->paginate(8);
        $items->appends(request()->all());

        return view('home.search', compact('categories', 'items'));
    }

    // to filter page when click category
    public function categorySearch($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        $items = Item::where('category_id', $id)->paginate(6);
        $items->appends(request()->all());

        return view('home.categorySearch', compact('category', 'categories', 'items'));
    }

    // to filter combinations
    public function filterSearch (Request $request)
    {
        // for filter
        $items = Item::query();

        if ($request->latestPopular == 'latest') {
            $items->orderBy('id', 'desc');
        }

        if ($request->latestPopular == 'popular') {
            $items->orderBy('views', 'desc');
        }

        if ($request->query('name')) {
            $items->where('name', 'like', '%' . $request->query('name') . '%');
        }

        if ($request->query('min')) {
            $items->where('price', '>=', $request->query('min'));
        }

        if ($request->query('max')) {
            $items->where('price', '<=', $request->query('max'));
        }

        if ($request->query('category_id')) {
            $items->where('category_id', $request->query('category_id'));
        }

        if ($request->condition != null) {
            if ($request->condition == 0) {
                $items->where('condition', 0);
            } elseif ($request->condition == 1) {
                $items->where('condition', 1);
            } else {
                $items->where('condition', 2);
            }
        }

        if ($request->type != null) {
            if ($request->type == 0) {
                $items->where('type', 0);
            } elseif ($request->type == 1) {
                $items->where('type', 1);
            } else {
                $items->where('type', 2);
            }
        }

        $categories = Category::all();
        $items = $items->paginate(6);
        $items->appends(request()->all());

        return view('home.categoryFilter', compact('categories', 'items'));
    }

    // to item details
    public function itemDetails ($id) {
        $item = Item::find($id);
        $item->update([
            'views' => $item->views + 1,
        ]);

        return view('home.details', compact('item'));
    }

    // to categories all page
    public function allCategories () {
        $categories = Category::all();

        return view('home.allCategories', compact('categories'));
    }

    // to items all page
    public function allItems () {
        $categories = Category::all();
        $items = Item::orderBy('id', 'desc')->paginate(8);

        return view('home.allItems', compact('categories', 'items'));
    }
}
