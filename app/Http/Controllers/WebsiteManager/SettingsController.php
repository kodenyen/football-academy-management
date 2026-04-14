<?php

namespace App\Http\Controllers\WebsiteManager;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\HeroSlider;
use App\Models\AcademyProgram;
use App\Models\FormField;
use App\Models\Gallery;
use App\Models\FundingCampaign;
use App\Models\ShowcaseVideo;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = SiteSetting::create();
        }
        $sliders = HeroSlider::orderBy('order')->get();
        $programs = AcademyProgram::orderBy('order')->get();
        $trialFields = FormField::where('form_type', 'trial')->orderBy('order')->get();
        $coachFields = FormField::where('form_type', 'coach')->orderBy('order')->get();
        $facilities = \App\Models\Facility::orderBy('order')->get();
        $gallery = Gallery::latest()->get();
        $campaigns = FundingCampaign::latest()->get();
        $showcaseVideos = ShowcaseVideo::with('player.user')->orderBy('order')->get();
        $players = Player::with('user')->get();
        
        return view('website_manager.index', compact('settings', 'sliders', 'programs', 'trialFields', 'coachFields', 'facilities', 'gallery', 'campaigns', 'showcaseVideos', 'players'));
    }

    public function storeShowcase(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'youtube_url' => 'required|url',
            'player_id' => 'nullable|exists:players,id',
        ]);

        $videoId = $this->extractYoutubeId($request->youtube_url);
        if (!$videoId) {
            return back()->with('error', 'Invalid YouTube URL.');
        }

        ShowcaseVideo::create(array_merge($data, [
            'video_id' => $videoId,
            'order' => ShowcaseVideo::count() + 1
        ]));

        return back()->with('success', 'Showcase video added!');
    }

    public function updateShowcase(Request $request, ShowcaseVideo $showcase)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'youtube_url' => 'required|url',
            'player_id' => 'nullable|exists:players,id',
            'is_active' => 'boolean',
        ]);

        $videoId = $this->extractYoutubeId($request->youtube_url);
        if (!$videoId) {
            return back()->with('error', 'Invalid YouTube URL.');
        }

        $data['video_id'] = $videoId;
        $data['is_active'] = $request->has('is_active');

        $showcase->update($data);
        return back()->with('success', 'Showcase video updated!');
    }

    public function deleteShowcase(ShowcaseVideo $showcase)
    {
        $showcase->delete();
        return back()->with('success', 'Showcase video removed!');
    }

    private function extractYoutubeId($url)
    {
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
        return $matches[1] ?? null;
    }

    public function storeCampaign(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'show_progress' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        }

        $data['show_progress'] = $request->has('show_progress');

        FundingCampaign::create($data);
        return back()->with('success', 'Funding campaign created!');
    }

    public function updateCampaign(Request $request, FundingCampaign $campaign)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'show_progress' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            $data['image'] = $request->file('image')->store('campaigns', 'public');
        }

        $data['show_progress'] = $request->has('show_progress');
        $data['is_active'] = $request->has('is_active');

        $campaign->update($data);
        return back()->with('success', 'Funding campaign updated!');
    }

    public function deleteCampaign(FundingCampaign $campaign)
    {
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }
        $campaign->delete();
        return back()->with('success', 'Funding campaign removed!');
    }

    public function updateGeneral(Request $request)
    {
        $settings = SiteSetting::firstOrCreate([]);
        $data = $request->validate([
            'academy_name' => 'sometimes|required|string|max:255',
            'phone_number' => 'nullable|string',
            'whatsapp_number' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'footer_text' => 'nullable|string',
            'primary_color' => 'sometimes|required|string',
            'secondary_color' => 'sometimes|required|string',
            'background_color' => 'sometimes|required|string',
            'about_us_content' => 'nullable|string',
            'heading_font' => 'nullable|string',
            'body_font' => 'nullable|string',
            'hero_heading_size' => 'nullable|string',
            'hero_subheading_size' => 'nullable|string',
            'section_heading_size' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            if ($settings->academy_logo) {
                Storage::disk('public')->delete($settings->academy_logo);
            }
            $data['academy_logo'] = $request->file('logo')->store('site', 'public');
        }

        $settings->update($data);
        return back()->with('success', 'Site settings updated successfully!');
    }

    public function storeSlider(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:3072',
            'heading' => 'nullable|string',
            'sub_heading' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        HeroSlider::create([
            'image_path' => $path,
            'heading' => $request->heading,
            'sub_heading' => $request->sub_heading,
            'order' => HeroSlider::count() + 1,
        ]);

        return back()->with('success', 'Slider image added!');
    }

    public function updateSlider(Request $request, HeroSlider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|max:3072',
            'heading' => 'nullable|string',
            'sub_heading' => 'nullable|string',
        ]);

        $data = [
            'heading' => $request->heading,
            'sub_heading' => $request->sub_heading,
        ];

        if ($request->hasFile('image')) {
            if ($slider->image_path) {
                Storage::disk('public')->delete($slider->image_path);
            }
            $data['image_path'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($data);
        return back()->with('success', 'Slider image updated!');
    }

    public function deleteSlider(HeroSlider $slider)
    {
        if ($slider->image_path) {
            Storage::disk('public')->delete($slider->image_path);
        }
        $slider->delete();
        return back()->with('success', 'Slider image removed!');
    }

    public function storeProgram(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('programs', 'public');
        }

        AcademyProgram::create([
            'name' => $request->name,
            'image' => $path,
            'description' => $request->description,
            'order' => AcademyProgram::count() + 1,
        ]);

        return back()->with('success', 'Program added successfully!');
    }

    public function updateProgram(Request $request, AcademyProgram $program)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($program->image) {
                Storage::disk('public')->delete($program->image);
            }
            $data['image'] = $request->file('image')->store('programs', 'public');
        }

        $program->update($data);
        return back()->with('success', 'Program updated successfully!');
    }

    public function deleteProgram(AcademyProgram $program)
    {
        if ($program->image) {
            Storage::disk('public')->delete($program->image);
        }
        $program->delete();
        return back()->with('success', 'Program removed!');
    }

    public function updateMail(Request $request)
    {
        $settings = SiteSetting::firstOrCreate([]);
        $data = $request->validate([
            'mail_host' => 'nullable|string',
            'mail_port' => 'nullable|string',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_encryption' => 'nullable|string',
            'mail_from_address' => 'nullable|email',
            'mail_from_name' => 'nullable|string',
        ]);

        $settings->update($data);
        return back()->with('success', 'SMTP settings updated successfully!');
    }
}
