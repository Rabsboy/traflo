<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use App\Models\TravelPackage;
use App\Mail\StoreContactMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreEmailRequest;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Team;



class PageController extends Controller
{
    public function home() : View
    {
        $categories = Category::with('travel_packages')->get();
        $posts = Post::get();
        $teams=team::all();

        return view('home', compact('categories','posts','teams'));
    }

    public function detail(TravelPackage $travelPackage): View
    {
        return view('detail', compact('travelPackage'));
    }

    public function package(){
        $travelPackages = TravelPackage::with('galleries')->get();

        return view('package', compact('travelPackages'));
    }

    public function posts(){
        $posts = Post::get();

        return view('posts', compact('posts'));
    }

    public function detailPost(Post $post){
        return view('posts-detail',compact('post'));
    }

    public function contact(){
        return view('contact');
    }

    public function getEmail(StoreEmailRequest $request){
        $detail = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        Mail::to('muhammadsadiq2299@gmail.com')->send(new StoreContactMail($detail));
        return back()->with('message', 'Terimakasih atas feedbacknya ! kami akan membacanya sesegera mungkin');
    }
    public function about()
    {
        $teams=team::all();
    return view('about-us', compact('teams'));
    }
public function ourTeam()
{
    $teams = Team::all();
    return view('our-team', compact('teams'));
}

}
