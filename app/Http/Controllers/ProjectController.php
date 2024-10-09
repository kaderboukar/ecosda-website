<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Afficher la liste des projets.
     */
    public function index()
    {
        // Récupérer tous les projets
        $projects = Project::paginate(5);
        return view('projects.index', compact('projects'));
    }

    /**
     * Afficher le formulaire de création d'un projet.
     */
    public function create()
    {
        // Récupérer toutes les catégories pour les associer aux projets
        $categories = Category::all();
        return view('projects.create', compact('categories'));
    }

    /**
     * Stocker un nouveau projet dans la base de données.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'budget' => 'nullable|numeric',
            'status' => 'required|string|in:en cours,terminé,annulé',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer l'upload de l'image si une image est fournie
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        // Créer le projet avec les données validées
        Project::create($validatedData);

        // Rediriger vers la page d'index des projets avec un message de succès
        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès.');
    }

    /**
     * Afficher le formulaire d'édition d'un projet spécifique.
     */
    public function edit(Project $project)
    {
        // Récupérer toutes les catégories pour afficher dans le formulaire d'édition
        $categories = Category::all();
        return view('projects.edit', compact('project', 'categories'));
    }

    /**
     * Mettre à jour un projet spécifique dans la base de données.
     */
    public function update(Request $request, Project $project)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'budget' => 'nullable|numeric',
            'status' => 'required|string|in:en cours,terminé,annulé',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer l'upload de l'image si une nouvelle image est fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($project->image_path) {
                Storage::disk('public')->delete($project->image_path);
            }

            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('projects', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        // Mettre à jour le projet avec les données validées
        $project->update($validatedData);

        // Rediriger vers la page d'index des projets avec un message de succès
        return redirect()->route('projects.index')->with('success', 'Projet mis à jour avec succès.');
    }

    /**
     * Supprimer un projet spécifique de la base de données.
     */
    public function destroy(Project $project)
    {
        // Supprimer l'image associée si elle existe
        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }

        // Supprimer le projet
        $project->delete();

        // Rediriger vers la page d'index des projets avec un message de succès
        return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès.');
    }
}
