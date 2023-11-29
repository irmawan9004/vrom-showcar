<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class DetailController extends Controller
{

    public function index($slug)
    {
        $item = Item::with(['brand', 'type'])->where('slug', $slug)->firstOrFail();
        $similiarItems = Item::with(['brand', 'type'])
            ->where('id', '!=', '$item->id')
            ->get();
        return view('detail', compact('item', 'similiarItems'));
    }
}
