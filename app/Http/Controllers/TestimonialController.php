<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Project;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('testimonials.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        Testimonial::create($validatedData);

        return redirect()->route('testimonials.index')->with('success', 'Témoignage ajouté avec succès.');
    }

    public function edit(Testimonial $testimonial)
    {
        $projects = Project::all();
        return view('testimonials.edit', compact('testimonial', 'projects'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validatedData = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $testimonial->update($validatedData);

        return redirect()->route('testimonials.index')->with('success', 'Témoignage mis à jour avec succès.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success', 'Témoignage supprimé avec succès.');
    }
}

