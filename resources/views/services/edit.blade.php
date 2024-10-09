@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifier le service : {{ $service->name }}</h2>
        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name">Nom du service</label>
                <input type="text" name="name" id="name" value="{{ $service->name }}">
            </div>

            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description">{{ $service->description }}</textarea>
            </div>

            <div>
                <label for="category_id">Catégorie</label>
                <select name="category_id" id="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $service->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="price">Prix</label>
                <input type="text" name="price" id="price" value="{{ $service->price }}">
            </div>

            <div>
                <label for="duration">Durée estimée</label>
                <input type="text" name="duration" id="duration" value="{{ $service->duration }}">
            </div>

            <div>
                <label for="icon">Changer l'icône du service (optionnel)</label>
                <input type="file" name="icon" id="icon">
                <small>Icône actuelle : <img src="{{ asset($service->icon_path) }}" alt="{{ $service->name }}" style="width:50px;"></small>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>
@endsection
