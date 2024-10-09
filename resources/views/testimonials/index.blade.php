@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Liste des témoignages</h2>
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">Ajouter un nouveau témoignage</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Société</th>
                    <th>Feedback</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $testimonial)
                    <tr>
                        <td>{{ $testimonial->client_name }}</td>
                        <td>{{ $testimonial->client_company }}</td>
                        <td>{{ Str::limit($testimonial->feedback, 50) }}</td>
                        <td>{{ $testimonial->rating }}/5</td>
                        <td>
                            <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline;">
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
