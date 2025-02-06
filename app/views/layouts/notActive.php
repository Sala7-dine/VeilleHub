<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte en Attente | Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c4aa471706.js"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="max-w-xl w-full px-4">
        <div class="text-center">
            <!-- Icône d'attente -->
            <div class="mb-8">
                <svg class="mx-auto h-40 w-40 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <!-- Message principal -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-amber-500 mb-4">Compte en Attente</h1>
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Vérification en Cours</h2>
            </div>

            <!-- Délai estimé -->
            <div class="bg-sky-50 rounded-xl p-6 mb-8 max-w-md mx-auto">
                <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-clock text-sky-600 text-xl mr-2"></i>
                    <span class="text-sky-900 font-semibold">Délai de traitement estimé :</span>
                </div>
                <p class="text-sky-800 font-bold text-2xl">24-48 heures</p>
            </div>

            <!-- Boutons d'action -->
            <div class="space-y-4 sm:space-y-0 sm:flex sm:justify-center sm:space-x-4">
                <a href="/" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                    <i class="fas fa-home mr-2"></i>
                    Retour à l'accueil
                </a>
                <a href="/contact" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                    <i class="fas fa-envelope mr-2"></i>
                    Nous contacter
                </a>
            </div>

           
        </div>

        <!-- Animation de fond -->
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute left-[calc(50%-4rem)] top-10 -z-10 transform-gpu blur-3xl sm:left-[calc(50%-18rem)] lg:left-48 lg:top-[calc(50%-30rem)] xl:left-[calc(50%-24rem)]" aria-hidden="true">
                <div class="aspect-[1108/632] w-[69.25rem] bg-gradient-to-r from-sky-200 to-sky-400 opacity-20"></div>
            </div>
        </div>
    </div>

    <!-- Message de copyright -->
    <div class="absolute bottom-4 w-full text-center text-gray-500 text-sm">
        &copy; <?= date('Y') ?> Youdemy. Tous droits réservés.
    </div>
</body>
</html>
