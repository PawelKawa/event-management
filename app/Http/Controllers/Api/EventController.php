<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		return EventResource::collection(Event::with('user')->paginate());
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
		return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
	public function show(Event $event)
    {
		try {
			//code...
			$event->load('user', 'attendees');
			return new EventResource($event);
		} catch (\Throwable $th) {
			Log::info($th);
		}
    }

    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, Event $event)
    {
		$event->update(
			$request->validate([
				'name' => 'sometimes|string|max:255',
				'description' => 'nullable|string',
				'start_time' => 'sometimes|date',
				'end_time' => 'sometimes|date|after:start_time',
				'location' => 'sometimes|string|max:255',
			])
		);
		return new EventResource($event);
	}

    /**
     * Remove the specified resource from storage.
     */
	public function destroy(Event $event)
    {
		$event->delete();
		return response()->json([
			'message' => 'Event deleted successfully',
		]);
    }
}
