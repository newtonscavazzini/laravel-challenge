<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function index() {

        return view('events.index', [
            'events' => Event::getAllEventsPaginated(15),
        ]);

    }

    public function create()
    {
        return view('events.create');
    }

    public function show(int $id)
    {
        $event = Event::query()
            ->find($id);

        if (!is_a($event, Event::class)) {
            return redirect('/')
                ->withErrors('This event could not be found.');
        }

        return view('events.show', compact('event'));
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $description = $request->description;
        $startAt = Carbon::parse($request->start)->toDateTimeString();
        $endAt = Carbon::parse($request->end)->toDateTimeString();

        $event = Event::create([
            'title' => $title,
            'description' => $description,
            'start_at' => $startAt,
            'end_at' => $endAt,
            'user_id' => auth()->id(),
        ]);

        return redirect('/events/' . $event->id)
            ->with('success', 'Event created successfully.');

    }

    public function update(int $id, Request $request)
    {

        $title = $request->title;
        $description = $request->description;
        $startAt = Carbon::parse($request->start)->toDateTimeString();
        $endAt = Carbon::parse($request->end)->toDateTimeString();

        Event::where('id', $id)
            ->where('user_id', auth()->id())
            ->update([
                'title' => $title,
                'description' => $description,
                'start_at' => $startAt,
                'end_at' => $endAt,
            ]);

        return redirect()
            ->back()
            ->with('success', 'Event updated successfully.');

    }

    public function destroy(int $id, Request $request)
    {

        Event::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return redirect('/')
            ->with('success', 'Your event has been deleted.');

    }

}
