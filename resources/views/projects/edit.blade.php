@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Modifier le projet : {{ $project->title }}</h2>

        <!-- Affichage des erreurs de validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire pour modifier un projet -->
        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Titre du projet -->
            <div class="form-group">
                <label for="title">Titre du projet</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $project->title) }}" required>
            </div>

            <!-- Description du projet -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <!-- Localisation du projet -->
            <div class="form-group">
                <label for="location">Localisation</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $project->location) }}" required>
            </div>

            <!-- Date de début -->
            <div class="form-group">
                <label for="start_date">Date de début</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $project->start_date ? $project->start_date->format('Y-m-d') : '') }}">
            </div>

            <!-- Date de fin -->
            <div class="form-group">
                <label for="end_date">Date de fin</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $project->end_date ? $project->end_date->format('Y-m-d') : '') }}">
            </div>

            <!-- Budget -->
            <div class="form-group">
                <label for="budget">Budget (FCFA)</label>
                <input type="number" step="0.01" name="budget" id="budget" class="form-control" value="{{ old('budget', $project->budget) }}">
            </div>

            <!-- Statut du projet -->
            <div class="form-group">
                <label for="status">Statut</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="en cours" {{ old('status', $project->status) == 'en cours' ? 'selected' : '' }}>En cours</option>
                    <option value="terminé" {{ old('status', $project->status) == 'terminé' ? 'selected' : '' }}>Terminé</option>
                    <option value="annulé" {{ old('status', $project->status) == 'annulé' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>

            <!-- Catégorie -->
            <div class="form-group">
                <label for="category_id">Catégorie</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Upload de l'image du projet -->
            <div class="form-group">
                <label for="image">Changer l'image du projet (optionnel)</label>
                <input type="file" name="image" id="image" class="form-control-file">
                @if ($project->image_path)
                    <small>Image actuelle :</small>
                    <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="img-fluid mt-2" style="max-height: 150px;">
                @endif
            </div>

            <!-- Bouton de soumission -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Mettre à jour le projet</button>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
@endsection
