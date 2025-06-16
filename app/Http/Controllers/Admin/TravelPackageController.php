<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\TravelPackage;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTravelPackageRequest;
use App\Models\Category;

class TravelPackageController extends Controller
{
        public function show($id)
    {
        // Cari travel package berdasarkan ID
        $package = TravelPackage::findOrFail($id);

        // Kirim data ke view 'admin.travel-package.show'
        return view('admin.travel-package.show', compact('package'));
    }

    public function index() : View
    {
        $travelPackages = TravelPackage::get();

        return view('admin.travel-packages.index', compact('travelPackages'));
    }

    public function create(): View
    {
        $categories = Category::get();

        return view('admin.travel-packages.create', compact('categories'));
    }

    public function store(StoreTravelPackageRequest $request): RedirectResponse
    {
        $slug = Str::slug($request->name);        
        TravelPackage::create($request->validated() + ["slug" => $slug]);

        return redirect()->route('admin.travel-packages.index')->with('message', 'Added Successfully !');
    }

    public function edit(TravelPackage $travelPackage): View
    {
        $categories = Category::get();

        return view('admin.travel-packages.edit', compact('travelPackage', 'categories'));
    }

    public function update(StoreTravelPackageRequest $request, TravelPackage $travelPackage): RedirectResponse
    {
        $slug = Str::slug($request->name);
        $travelPackage->update($request->validated() + ["slug" => $slug]);

        return redirect()->route('admin.travel-packages.index')->with('message', 'Updated Successfully !');;
    }
public function destroy(TravelPackage $travelPackage): RedirectResponse
{
    // Hapus semua gallery terkait
    $travelPackage->galleries()->delete();

    // Hapus travel package
    $travelPackage->delete();

    return redirect()->route('admin.travel-packages.index')->with('message', 'Deleted Successfully');
}

}
