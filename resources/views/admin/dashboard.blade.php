@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tableau de bord de l'administrateur</h1>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('projects.index') }}" class="btn btn-primary">Gérer les projets</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('services.index') }}" class="btn btn-primary">Gérer les services</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('testimonials.index') }}" class="btn btn-primary">Gérer les témoignages</a>
            </div>
        </div>
    </div>
@endsection
