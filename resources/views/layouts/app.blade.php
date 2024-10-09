<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Titre de la page dynamique -->
    <title>@yield('title', 'ECOSDA SARL')</title>
    
    <!-- Meta description dynamique pour le SEO -->
    <meta name="description" content="@yield('description', 'Bienvenue sur le site de ECOSDA SARL')">
    
    <!-- Open Graph Meta Tags pour le partage sur les réseaux sociaux -->
    <meta property="og:title" content="@yield('og:title', 'ECOSDA SARL - Bureau d\'études en génie civil')" />
    <meta property="og:description" content="@yield('og:description', 'Découvrez nos services en génie civil, électrification rurale et plus encore.')" />
    <meta property="og:image" content="@yield('og:image', asset('images/og-image.jpg'))" />
    <meta property="og:url" content="@yield('og:url', url('/'))" />
    <meta property="og:type" content="website" />
    
    <!-- Feuilles de style -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Barre de navigation (Header) -->
    <nav class="bg-blue-900 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('home') }}" class="text-2xl font-bold">ECOSDA SARL</a>
            <ul class="flex space-x-4">
                <li><a href="{{ route('home') }}" class="hover:text-gray-400">Accueil</a></li>
                <li><a href="{{ route('projects.index') }}" class="hover:text-gray-400">Projets</a></li>
                <li><a href="{{ route('services.index') }}" class="hover:text-gray-400">Services</a></li>
                <li><a href="{{ route('testimonials.index') }}" class="hover:text-gray-400">Témoignages</a></li>
                <li><a href="{{ route('contact.index') }}" class="hover:text-gray-400">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mx-auto py-8">
        @yield('content') <!-- C'est ici que le contenu spécifique à chaque page sera injecté -->
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 ECOSDA SARL. Tous droits réservés.</p>
            <p>Conçu avec ❤️ par l'équipe ECOSDA.</p>
        </div>
    </footer>

    <!-- Scripts JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts') <!-- Pour ajouter des scripts spécifiques à certaines pages -->
</body>
</html>
