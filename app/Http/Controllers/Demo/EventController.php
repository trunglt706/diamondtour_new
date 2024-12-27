<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Events;

class EventController extends Controller
{
    /**
     * Trang chi tiết sự kiện
     */
    public function detail($slug)
    {
        $data = Events::ofStatus(Events::STATUS_ACTIVE)->ofSlug($slug)->firstOrFail();
        CheckViewSession("_event_$data->id", $data);
        return view('guest.event.detail.index', compact('data'));
    }
}
