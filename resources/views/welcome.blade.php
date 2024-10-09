<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ECOSDA SARL - Votre partenaire en génie civil et électrification rurale</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="ECOSDA SARL est un bureau d'études spécialisé dans le génie civil, l’électrification rurale et l'évaluation de projets.">
    <meta name="keywords" content="génie civil, électrification rurale, conseil, ECOSDA, Cameroun, ONG, projets">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="ECOSDA SARL - Bureau d'études en génie civil et électrification rurale" />
    <meta property="og:description" content="Découvrez nos services dans le génie civil, l'électrification rurale, et la gestion de projets." />
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:type" content="website" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <a href="#" class="text-2xl font-bold">ECOSDA SARL</a>
            <ul class="flex space-x-4">
                <li><a href="#about" class="hover:text-gray-400">Qui sommes-nous</a></li>
                <li><a href="#services" class="hover:text-gray-400">Services</a></li>
                <li><a href="#projects" class="hover:text-gray-400">Projets</a></li>
                <li><a href="#testimonials" class="hover:text-gray-400">Témoignages</a></li>
                <li><a href="#contact" class="hover:text-gray-400">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero bg-gray-100 text-center py-20">
        <h1 class="text-5xl font-bold mb-4 text-orange-600">Bienvenue chez ECOSDA SARL</h1>
        <p class="text-xl text-gray-700 mb-6">Votre partenaire dans le génie civil, l’électrification rurale, et plus encore.</p>
        <a href="#contact" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-700">Contactez-nous</a>
    </section>

    <!-- Slider Section for Projects -->
    <section id="projects" class="py-12 bg-white">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-8">Nos projets récents</h2>
            <div class="carousel-container">
                <carousel :autoplay="true" :autoplayTimeout="5000">
                    @foreach ($projects as $project)
                        <slide>
                            <div class="text-center">
                                <img src="{{ asset($project->image_path) }}" alt="{{ $project->title }}" class="mx-auto w-full h-64 object-cover">
                                <h3 class="text-xl font-semibold mt-4">{{ $project->title }}</h3>
                                <p>{{ $project->description }}</p>
                            </div>
                        </slide>
                    @endforeach
                </carousel>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-12 bg-gray-200">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-8">Nos services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    <div class="service-card bg-white p-6 text-center shadow-lg">
                        <img src="{{ asset($service->icon_path) }}" alt="{{ $service->name }}" class="mx-auto mb-4 h-16">
                        <h3 class="text-xl font-semibold">{{ $service->name }}</h3>
                        <p class="text-gray-700 mt-2">{{ $service->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-12 bg-white">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-8">Ce que disent nos clients</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($testimonials as $testimonial)
                    <div class="testimonial-card bg-gray-100 p-6 text-center shadow-lg">
                        <p class="text-lg italic mb-4">"{{ $testimonial->feedback }}"</p>
                        <h4 class="font-semibold">{{ $testimonial->client_name }}</h4>
                        @if($testimonial->client_company)
                            <p class="text-gray-600">{{ $testimonial->client_company }}</p>
                        @endif
                        <p class="mt-2 text-yellow-500">Note : {{ $testimonial->rating }}/5</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-12 bg-blue-900 text-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Contactez-nous</h2>
            <p class="mb-8">Vous avez un projet en tête ? Contactez-nous dès aujourd'hui pour discuter de vos besoins.</p>
            <a href="mailto:contact@ecosda.com" class="bg-orange-500 text-white py-2 px-6 rounded-lg hover:bg-orange-700">Envoyez-nous un email</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 ECOSDA SARL. Tous droits réservés.</p>
            <p>Conçu avec ❤️ par l'équipe ECOSDA.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
