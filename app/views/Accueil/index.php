<!DOCTYPE html>
<html lang="fr">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VeilleHub - veille pédagogique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

</head>
<body class="bg-white">
    <?php include __DIR__ . "/../layouts/header.php"; ?>

    <!-- Hero Section avec plus d'espace -->
    <section class="pt-10 pb-24 bg-cyan-100">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-16">
                <div class="lg:w-1/2">
                    <span class="px-4 py-2 bg-cyan-200 text-cyan-700 rounded-full text-sm font-semibold mb-6 inline-block">
                        La meilleure plateforme de veille pédagogique
                    </span>
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Partagez vos connaissances 
                        <span class="text-cyan-500">techniques</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Découvrez une nouvelle façon de partager et d'apprendre avec des présentations techniques entre pairs. Rejoignez notre communauté d'apprenants !
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/register" class="inline-flex items-center justify-center px-4 py-2 bg-cyan-500 text-white rounded-xl text-lg font-semibold hover:bg-cyan-600 transition-all duration-300 transform hover:scale-105">
                            <span>S'inscrire maintenant</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <a href="#calendar" class="inline-flex items-center justify-center px-4 py-2 bg-white text-cyan-500 border-2 border-cyan-500 rounded-xl text-lg font-semibold hover:bg-cyan-50 transition-all duration-300">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>Voir le calendrier</span>
                        </a>
                    </div>
                    <div class="mt-12 flex items-center gap-8">
                        <div class="flex -space-x-4">
                            <img src="https://randomuser.me/api/portraits/men/1.jpg" class="w-12 h-12 rounded-full border-4 border-white" alt="User">
                            <img src="https://randomuser.me/api/portraits/women/2.jpg" class="w-12 h-12 rounded-full border-4 border-white" alt="User">
                            <img src="https://randomuser.me/api/portraits/men/3.jpg" class="w-12 h-12 rounded-full border-4 border-white" alt="User">
                        </div>
                        <div class="text-gray-600">
                            <span class="font-bold text-cyan-500">50K+</span> apprenants satisfaits
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 relative">
                    <div class="relative z-10">
                        <img src="/images/educat.png" alt="Coding illustration" class="w-full max-w-2xl mx-auto">
                    </div>
                    <!-- Éléments décoratifs -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-cyan-100 rounded-full opacity-50 blur-3xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technologies Section -->
    <section class="bg-gray-50 p-8 min-h-[350px]">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-gray-800 text-3xl font-bold mb-16 text-center">Statistiques de la plateforme</h2>
            <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-6 max-lg:gap-12">
                <div class="text-center">
                    <h3 class="text-gray-800 text-4xl font-extrabold">500<span class="text-cyan-600">+</span></h3>
                    <p class="text-base font-bold mt-4">Présentations</p>
                    <p class="text-sm text-gray-500 mt-2">Présentations réalisées par nos étudiants</p>
                </div>
                <div class="text-center">
                    <h3 class="text-gray-800 text-4xl font-extrabold">200<span class="text-cyan-600">+</span></h3>
                    <p class="text-base font-bold mt-4">Étudiants actifs</p>
                    <p class="text-sm text-gray-500 mt-2">Participants réguliers aux présentations</p>
                </div>
                <div class="text-center">
                    <h3 class="text-gray-800 text-4xl font-extrabold">5.4<span class="text-cyan-600">M+</span></h3>
                    <p class="text-base font-bold mt-4">Total Users</p>
                    <p class="text-sm text-gray-500 mt-2">The total number of registered users on the platform.</p>
                </div>
                <div class="text-center">
                    <h3 class="text-gray-800 text-4xl font-extrabold">$80<span class="text-cyan-600">K</span></h3>
                    <p class="text-base font-bold mt-4">Revenue</p>
                    <p class="text-sm text-gray-500 mt-2">The total revenue generated by the application.</p>
                </div>
                <div class="text-center">
                    <h3 class="text-gray-800 text-4xl font-extrabold">100<span class="text-cyan-600">K</span></h3>
                    <p class="text-base font-bold mt-4">Engagement</p>
                    <p class="text-sm text-gray-500 mt-2">The level of user engagement with the application's content and features.</p>
                </div>
                <div class="text-center">
                    <h3 class="text-gray-800 text-4xl font-extrabold">99.9<span class="text-cyan-600">%</span></h3>
                    <p class="text-base font-bold mt-4">Server Uptime</p>
                    <p class="text-sm text-gray-500 mt-2">The percentage of time the server has been operational and available.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Parcours d'apprentissage</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Choisissez parmi nos parcours soigneusement conçus pour vous mener du débutant au professionnel
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Course Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="h-48 bg-cyan-500 relative overflow-hidden">
                        <img src="/images/html.jpg" alt="Web Development" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-cyan-500 opacity-10"></div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-code text-cyan-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Développement Web</h3>
                                <p class="text-cyan-500">Frontend & Backend</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">Maîtrisez HTML, CSS, JavaScript et les frameworks modernes</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span><i class="fas fa-book-open mr-2"></i>12 modules</span>
                                <span><i class="fas fa-clock mr-2"></i>20h</span>
                            </div>
                            <a href="#" class="text-cyan-500 hover:text-cyan-600 font-semibold">
                                En savoir plus <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Répéter pour d'autres cours -->
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center p-8 rounded-2xl bg-white shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-cyan-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-alt text-cyan-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Gestion du Calendrier</h3>
                    <p class="text-gray-600">
                        Planifiez et suivez facilement les présentations à venir
                    </p>
                </div>
                <!-- Répéter pour autres caractéristiques -->
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="py-20 bg-cyan-100">
        <div class="max-w-7xl mx-auto px-8">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-16">Ce que disent nos apprenants</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Student" class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900">Thomas Martin</h4>
                            <p class="text-cyan-500">Développeur Frontend</p>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "Youdemy a transformé ma vie. J'ai appris à coder en partant de zéro et maintenant je travaille comme développeur frontend dans une startup."
                    </p>
                </div>
                <!-- Répéter pour d'autres témoignages -->
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-8 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-8">Prêt à partager vos connaissances ?</h2>
            <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto">
                Rejoignez notre communauté d'apprenants et participez à l'échange de connaissances
            </p>
            <a href="/register" class="inline-flex items-center justify-center px-8 py-4 bg-cyan-500 text-white rounded-xl text-lg font-semibold hover:bg-cyan-600 transition-all duration-300 transform hover:scale-105">
                <span>Commencer maintenant</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </section>

  
    <?php include __DIR__ . "/../layouts/footer.php"; ?>



    <script>
        // Animation des compteurs
        const counters = document.querySelectorAll('[data-count]');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000; // 2 secondes
            const step = target / (duration / 16); // 60 FPS
            let current = 0;
            
            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current) + (target > 100 ? '+' : '%');
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target + (target > 100 ? '+' : '%');
                }
            };
            
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    updateCounter();
                    observer.disconnect();
                }
            });
            
            observer.observe(counter);
        });
    </script>
</body>
</html>