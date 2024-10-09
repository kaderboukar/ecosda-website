<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les 3 derniers projets et services pour les afficher sur la page d'accueil
        $projects = Project::latest()->take(3)->get();
        $services = Service::all();
        $testimonials = Testimonial::all();

        return view('welcome', compact('projects', 'services',  'testimonials'));
    }
}
