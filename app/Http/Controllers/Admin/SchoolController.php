<?php

namespace App\Http\Controllers\Admin;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormSchoolRequest;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.school.index', [
            'schools' => School::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.school.form', [
            'school' => new School()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormSchoolRequest $request)
    {
        $school = School::create($request->validated());
        return to_route('dashboard.school.index')->with('success', 'La formation ajoutée avec succès !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $education = School::findOrFail($id);
        return view('dashboard.school.form', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormSchoolRequest $request, School $school)
    {
        $school->update($request->validated());
        return to_route('dashboard.school.index')->with('success', 'La formation mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $school = School::findOrFail($id);
        $school->delete();
        return redirect()->route('dashboard.school.index')->with('success', 'La formation supprimée avec succès !');
    }
}
