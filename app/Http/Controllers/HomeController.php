<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        $skills = Skill::orderBy('order', 'asc')->get();
        $works = Work::orderBy('start_date', 'desc')->get();
        return view('home.index', compact('skills', 'works'));
    }
}
