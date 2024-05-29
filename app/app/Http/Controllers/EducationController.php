<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use Carbon\Carbon;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::all();
        return view('educations.index', compact('educations'));
    }

    public function create()
    {
        return view('educations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution' => 'required',
            'degree' => 'required',
            'major' => 'required',
            'start_year' => 'required|date',
            'end_year' => 'nullable|date',
        ]);

        $startYear = Carbon::createFromFormat('Y-m-d', $request->start_year);
        $endYear = $request->end_year ? Carbon::createFromFormat('Y-m-d', $request->end_year) : null;


        Education::create([
            'user_id' => auth()->user()->id,
            'institution' => $request->institution,
            'degree' => $request->degree,
            'major' => $request->major,
            'start_year' => $startYear,
            'end_year' => $endYear,
        ]);

        return redirect()->route('educations.index')->with('success', 'Education created successfully');
    }

    public function edit(Education $education)
    {
        return view('educations.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $request->validate([
            'institution' => 'required',
            'degree' => 'required',
            'major' => 'required',
            'start_year' => 'required|date',
            'end_year' => 'nullable|date',
        ]);

        $startYear = Carbon::createFromFormat('Y-m-d', $request->start_year);
        $endYear = $request->end_year ? Carbon::createFromFormat('Y-m-d', $request->end_year) : null;

        $education->update([
            'institution' => $request->institution,
            'degree' => $request->degree,
            'major' => $request->major,
            'start_year' => $startYear,
            'end_year' => $endYear,
        ]);

        return redirect()->route('educations.index')->with('success', 'Education updated successfully');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('educations.index')->with('success', 'Education deleted successfully');
    }
}
