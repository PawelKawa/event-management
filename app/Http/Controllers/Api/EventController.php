<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		return Event::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

		$event = Event::create([
			...$request->validate([
				'name' => 'required|string|max:255',
				'description' => 'nullable|string',
				'start_time' => 'required|date',
				'end_time' => 'required|date|after:start_time',
				'location' => 'required|string|max:255',
			]),
			'user_id' => 1,
		]);
		return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
		return Event::findOrFail($id);
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
