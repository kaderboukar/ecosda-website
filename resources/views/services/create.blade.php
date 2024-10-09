@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ajouter un nouveau service</h2>
        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">Nom du service</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
            </div>

            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description">{{ old('description') }}"></textarea>
            </div>

            <div>
                <label for="category_id">Catégorie</label>
                <select name="category_id" id="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="price">Prix</label>
                <input type="text" name="price" id="price" value="{{ old('price') }}">
            </div>

            <div>
                <label for="duration">Durée estimée</label>
                <input type="text" name="duration" id="duration" value="{{ old('duration') }}">
            </div>

            <div>
                <label for="icon">Icône du service</label>
                <input type="file" name="icon" id="icon">
            </div>

            <div>
                <button type="submit" class="btn btn-success">Ajouter le service</button>
            </div>
        </form>
    </div>
@endsection
