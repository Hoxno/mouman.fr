<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        $skills = Skill::orderBy('order', 'asc')->get();
        return view('home.index', compact('skills'));
    }
}
