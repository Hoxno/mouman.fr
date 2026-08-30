<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Skill;
use App\Models\User;
use App\Models\Work;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        $skills = Skill::where('online', '1')->orderBy('order', 'asc')->get();
        $works = Work::where('online', '1')->orderBy('start_date', 'desc')->get();
        $schools = School::where('online', '1')->orderBy('start_date', 'desc')->get();

        return view('home.index', compact('users', 'skills', 'works', 'schools'));
    }
}
