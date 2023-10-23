<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Work;
use App\Models\Skill;
use App\Models\School;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        $users = User::all();
        $skills = Skill::orderBy('order', 'asc')->get();
        $works = Work::orderBy('start_date', 'desc')->get();
        $schools = School::orderBy('start_date', 'desc')->get();
        return view('home.index', compact('users', 'skills', 'works', 'schools'));
    }
}
