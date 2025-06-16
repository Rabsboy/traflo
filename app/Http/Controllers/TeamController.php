<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Team;

class TeamController extends Controller
{
    public function index(): View
    {
        $teams = Team::all();
        return view('our-team', compact('teams'));
    }
}
