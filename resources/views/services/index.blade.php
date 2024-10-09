@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Liste des services</h2>
        <a href="{{ route('services.create') }}" class="btn btn-primary">Ajouter un nouveau service</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                    <th>Durée</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->category->name }}</td>
                        <td>{{ $service->price }}</td>
                        <td>{{ $service->duration }}</td>
                        <td>
                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
