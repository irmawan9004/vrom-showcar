<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\BookingRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    if (request()->ajax()) {
            $query = Booking::with('user','item.type','item.brand');

            return DataTables::of($query)
                ->addColumn('action', function ($booking) {
                    return '
                    <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                        href="' . route('admin.bookings.edit', $booking->id) . '">
                        Sunting
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.bookings.destroy', $booking->id) . '" method="POST">
                    <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Hapus
                    </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
