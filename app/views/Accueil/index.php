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
<body class="bg-white overflow-hidden   ">
    <?php include __DIR__ . "/../layouts/header.php"; ?>

    <!-- Hero Section avec plus d'espace -->
    <section class="pt-8 min-h-screen bg-cyan-100 ">
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
                        <a href="/calendrier" class="inline-flex items-center justify-center px-4 py-2 bg-white text-cyan-500 border-2 border-cyan-500 rounded-xl text-lg font-semibold hover:bg-cyan-50 transition-all duration-300">
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
                        <img src="/images/bg11.svg" alt="Coding illustration" class="w-full max-w-2xl mx-auto">
                    </div>
                    <!-- Éléments décoratifs -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-cyan-100 rounded-full opacity-50 blur-3xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>


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