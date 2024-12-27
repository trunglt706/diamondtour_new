<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Events;

class EventController extends Controller
{
    public function detail($slug)
    {
        $event = Events::ofStatus(Events::STATUS_ACTIVE)->ofSlug($slug)->firstOrFail();
        CheckViewSession("_event_$event->id", $event);
        $seo = [
            'image' => $event->image,
            'title' => $event->title,
            'description' => $event->description,
        ];
        $data = [
            'seo' => $seo,
            'event' => $event
        ];
        return view('pages.event.detail', compact('data'));
    }
}
