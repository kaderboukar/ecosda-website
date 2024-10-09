@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifier le témoignage de {{ $testimonial->client_name }}</h2>
        <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="client_name">Nom du client</label>
                <input type="text" name="client_name" id="client_name" value="{{ $testimonial->client_name }}">
            </div>

            <div>
                <label for="client_company">Société du client (optionnel)</label>
                <input type="text" name="client_company" id="client_company" value="{{ $testimonial->client_company }}">
            </div>

            <div>
                <label for="feedback">Témoignage</label>
                <textarea name="feedback" id="feedback">{{ $testimonial->feedback }}</textarea>
            </div>

            <div>
                <label for="rating">Note (1 à 5)</label>
                <select name="rating" id="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $testimonial->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label for="project_id">Associer à un projet (optionnel)</label>
                <select name="project_id" id="project_id">
                    <option value="">Aucun</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ $project->id == $testimonial->project_id ? 'selected' : '' }}>{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>
@endsection
