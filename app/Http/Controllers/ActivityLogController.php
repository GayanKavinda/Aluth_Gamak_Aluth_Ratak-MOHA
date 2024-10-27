<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->paginate(20);
        return view('activity_logs.index', compact('activities'));
    }

    public function show(Activity $activity)
    {
        // Extract subject from description if it contains 'Subject:'
        $description = $activity->description;
        $subject = 'N/A';

        if (strpos($description, 'Subject:') !== false) {
            $startPos = strpos($description, 'Subject:') + strlen('Subject:');
            $subject = trim(substr($description, $startPos));
        }

        // Decode properties
        $properties = json_decode($activity->properties, true);

        return view('activity_logs.show', compact('activity', 'subject', 'properties'));
    }
}
