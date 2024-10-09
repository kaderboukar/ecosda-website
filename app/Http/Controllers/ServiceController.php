<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Afficher la liste des services avec pagination.
     */
    public function index()
    {
        // Récupérer les services avec pagination (5 services par page)
        $services = Service::paginate(5); // Vous pouvez ajuster le nombre de services par page

        return view('services.index', compact('services'));
    }

    /**
     * Afficher le formulaire de création d'un nouveau service.
     */
    public function create()
    {
        // Récupérer toutes les catégories pour les associer aux services
        $categories = Category::all();
        return view('services.create', compact('categories'));
    }

    /**
     * Stocker un nouveau service dans la base de données.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer l'upload de l'icône si une icône est fournie
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('services', 'public');
            $validatedData['icon_path'] = $iconPath;
        }

        // Créer le service avec les données validées
        Service::create($validatedData);

        // Rediriger vers la page d'index des services avec un message de succès
        return redirect()->route('services.index')->with('success', 'Service créé avec succès.');
    }

    /**
     * Afficher le formulaire d'édition d'un service spécifique.
     */
    public function edit(Service $service)
    {
        // Récupérer toutes les catégories pour afficher dans le formulaire d'édition
        $categories = Category::all();
        return view('services.edit', compact('service', 'categories'));
    }

    /**
     * Mettre à jour un service spécifique dans la base de données.
     */
    public function update(Request $request, Service $service)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer l'upload de l'icône si une nouvelle icône est fournie
        if ($request->hasFile('icon')) {
            // Supprimer l'ancienne icône si elle existe
            if ($service->icon_path) {
                Storage::disk('public')->delete($service->icon_path);
            }

            // Stocker la nouvelle icône
            $iconPath = $request->file('icon')->store('services', 'public');
            $validatedData['icon_path'] = $iconPath;
        }

        // Mettre à jour le service avec les données validées
        $service->update($validatedData);

        // Rediriger vers la page d'index des services avec un message de succès
        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }

    /**
     * Supprimer un service spécifique de la base de données.
     */
    public function destroy(Service $service)
    {
        // Supprimer l'icône associée si elle existe
        if ($service->icon_path) {
            Storage::disk('public')->delete($service->icon_path);
        }

        // Supprimer le service
        $service->delete();

        // Rediriger vers la page d'index des services avec un message de succès
        return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
    }
}
