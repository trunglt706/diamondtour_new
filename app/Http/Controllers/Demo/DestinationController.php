<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Tour;

class DestinationController extends Controller
{

    /**
     * Trang chi tiết
     */
    public function detail($slug)
    {
        $destination = Destination::ofStatus(Destination::STATUS_ACTIVE)->ofSlug($slug)->firstOrFail();
        CheckViewSession("_destination_$destination->id", $destination);
        $others = [];
        if ($destination->type == Destination::TYPE_NATIONAL) {
            $others = Destination::leftJoin('provinces', 'destinations.province_id', '=', 'provinces.id')->ofType(Destination::TYPE_LOCAL)->ofStatus(Destination::STATUS_ACTIVE)
                ->where('provinces.country_id', $destination->country_id)
                ->orderBy('destinations.created_at', 'desc')
                ->select('destinations.name', 'destinations.name_en', 'destinations.name_ch', 'destinations.slug', 'destinations.image', 'destinations.description', 'provinces.name as province_name')->paginate(6);
        }
        $tour_ids = $destination->tours ? json_decode($destination->tours) : [];
        $tours = Tour::whereIn('id', $tour_ids)->ofStatus(Tour::STATUS_ACTIVE)->orderBy('important', 'desc')->orderBy('created_at', 'desc')
            ->select('id', 'name', 'name_en', 'name_ch', 'slug', 'image')->get();
        $data = [
            'destination' => $destination,
            'others' => $others,
            'tours' => $tours
        ];
        return view('guest.destination.detail.index', compact('data'));
    }
}
