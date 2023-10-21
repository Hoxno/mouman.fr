<?php

namespace App\Http\Controllers\Admin;

use App\Models\Work;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormWorkRequest;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.work.index', [
            'works' => Work::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.work.form', [
            'work' => new Work()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormWorkRequest $request)
    {
        $work = Work::create($request->validated());
        return to_route('dashboard.work.index')->with('success', 'L\'expérience ajoutée avec succès !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $work = Work::findOrFail($id);
        return view('dashboard.work.form', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormWorkRequest $request, Work $work)
    {
        $work->update($request->validated());
        return to_route('dashboard.work.index')->with('success', 'L\'expérience mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $work = Work::findOrFail($id);
        $work->delete();
        return redirect()->route('dashboard.work.index')->with('success', 'L\'expérience supprimée avec succès !');
    }
}
