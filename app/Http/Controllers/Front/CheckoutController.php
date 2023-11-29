<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    //
    public function index($slug)
    {
        $item = Item::with(['brand', 'type'])->where('slug', $slug)->firstOrFail();
        return view('checkout', compact('item'));
    }
    public function store(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required'
        ]);

        // Format start_date and end_date from dd mm yyyy to timestamp
        $start_date = Carbon::createFromFormat('d m Y', $request->start_date);
        $end_date = Carbon::createFromFormat('d m Y', $request->end_date);

        //Count number of days between start_date and end_date
        $days = $start_date->diffInDays($end_date);

        //Get item data
        $item = Item::with(['brand', 'type'])->where('slug', $slug)->firstOrFail();

        //Add total_price
        $total_price = $days * $item->price;

        //Store data to database
        $item->bookings()->create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'total_price' => $total_price
        ]);

        return view('checkout', compact('item'));
    }
}
