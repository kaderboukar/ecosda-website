@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Liste des projets</h2>

        <!-- Message de succès lors de la création, modification ou suppression -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bouton pour ajouter un nouveau projet -->
        <div class="mb-4">
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Ajouter un nouveau projet</a>
        </div>

        <!-- Tableau des projets -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Lieu</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Budget</th>
                    <th>Statut</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->location }}</td>
                        <td>{{ $project->start_date ? $project->start_date->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ $project->end_date ? $project->end_date->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ $project->budget ? number_format($project->budget, 2, ',', ' ') . ' FCFA' : 'N/A' }}</td>
                        <td>{{ ucfirst($project->status) }}</td>
                        <td>{{ $project->category->name }}</td>
                        <td>
                            <!-- Lien pour modifier le projet -->
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                            <!-- Formulaire de suppression -->
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $projects->links() }}
        </div>
    </div>
@endsection
