<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        $skills = Skill::all();
        return view('home.index', compact('skills'));
    }
}
