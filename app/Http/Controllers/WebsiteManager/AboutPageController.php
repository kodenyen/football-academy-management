<?php

namespace App\Http\Controllers\WebsiteManager;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    public function updateAbout(Request $request)
    {
        $settings = SiteSetting::firstOrCreate([]);
        $data = $request->validate([
            'about_us_content' => 'nullable|string',
            'about_vision' => 'nullable|string',
            'about_mission' => 'nullable|string',
            'about_video_id' => 'nullable|string',
        ]);

        $settings->update($data);
        return back()->with('success', 'About page content updated!');
    }

    public function storeFacility(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('facilities', 'public');
        }

        Facility::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
            'order' => Facility::count() + 1,
        ]);

        return back()->with('success', 'Facility added successfully!');
    }

    public function updateFacility(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($facility->image) {
                Storage::disk('public')->delete($facility->image);
            }
            $data['image'] = $request->file('image')->store('facilities', 'public');
        }

        $facility->update($data);
        return back()->with('success', 'Facility updated successfully!');
    }

    public function deleteFacility(Facility $facility)
    {
        if ($facility->image) {
            Storage::disk('public')->delete($facility->image);
        }
        $facility->delete();
        return back()->with('success', 'Facility removed!');
    }
}
