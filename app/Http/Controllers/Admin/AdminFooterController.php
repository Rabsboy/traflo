<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminFooterController extends Controller
{
    public function index()
    {
        $setting = Setting::firstOrCreate(
            ['key' => 'footer_data'],
            ['value' => json_encode([
                'tagline' => 'EASY TRAVEL TO FLORES',
                'facebook' => '',
                'instagram' => '',
                'youtube' => '',
                'email' => '',
                'address' => '',
            ])]
        );

        $data = json_decode($setting->value, true);

        return view('admin.footer.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'tagline' => 'required|string|max:255',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:500',
        ]);

        $setting = Setting::where('key', 'footer_data')->first();

        $setting->value = json_encode([
            'tagline' => $request->tagline,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'email' => $request->email,
            'address' => $request->address,
        ]);
        $setting->save();

        return redirect()->back()->with('success', 'Footer berhasil diupdate!');
    }
}
