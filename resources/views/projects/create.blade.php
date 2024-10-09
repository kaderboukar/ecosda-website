@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Ajouter un nouveau projet</h2>

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

        <!-- Formulaire pour ajouter un projet -->
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Titre du projet -->
            <div class="form-group">
                <label for="title">Titre du projet</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <!-- Description du projet -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
            </div>

            <!-- Localisation du projet -->
            <div class="form-group">
                <label for="location">Localisation</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
            </div>

            <!-- Date de début -->
            <div class="form-group">
                <label for="start_date">Date de début</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
            </div>

            <!-- Date de fin -->
            <div class="form-group">
                <label for="end_date">Date de fin</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
            </div>

            <!-- Budget -->
            <div class="form-group">
                <label for="budget">Budget (FCFA)</label>
                <input type="number" step="0.01" name="budget" id="budget" class="form-control" value="{{ old('budget') }}">
            </div>

            <!-- Statut du projet -->
            <div class="form-group">
                <label for="status">Statut</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="en cours" {{ old('status') == 'en cours' ? 'selected' : '' }}>En cours</option>
                    <option value="terminé" {{ old('status') == 'terminé' ? 'selected' : '' }}>Terminé</option>
                    <option value="annulé" {{ old('status') == 'annulé' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>

            <!-- Catégorie -->
            <div class="form-group">
                <label for="category_id">Catégorie</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Upload de l'image du projet -->
            <div class="form-group">
                <label for="image">Image du projet (optionnel)</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>

            <!-- Bouton de soumission -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-success">Ajouter le projet</button>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
@endsection
