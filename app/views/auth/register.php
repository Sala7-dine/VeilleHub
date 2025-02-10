<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://kit.fontawesome.com/c02c3c8e88.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>

<body class="bg-[url('https://megabit-mich.ru/wp-content/uploads/2023/07/what_we_do_banner-scaled-1.jpg')] bg-cover bg-no-repeat from-blue-50 to-cyan-100 min-h-screen">
    <div class="min-h-screen flex flex-col items-center justify-center p-4 bg-cyan-800 bg-opacity-60">
        <!-- Card Container -->
        <div class="max-w-2xl w-full space-y-6 bg-white rounded-3xl shadow-xl p-8 relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-cyan-600"></div>
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-100 rounded-full opacity-50"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-cyan-100 rounded-full opacity-50"></div>

            <!-- Logo and Title -->
            <div class="text-center relative">
                <a href="/" class="inline-block">
                    <img src="/images/veille_hub_logo.svg" alt="logo" class="w-32 mx-auto animate-float" />
                </a>
                <h2 class="mt-4 text-3xl font-bold text-gray-900">
                    Créer un compte
                </h2>
            </div>

            <!-- Form -->
            <form action="/register" method="post" class="rounded-xl bg-gray-50 mt-4 p-4 relative w-full">
                <!-- Username and Email in same line -->
                <div class="grid grid-cols-2 gap-4 bg-gray-50">
                    <!-- Username Input -->
                    <div class=" bg-gray-50 px-4 py-2 backdrop-blur-xl">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                            Nom d'utilisateur
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input 
                                id="username" 
                                name="username" 
                                type="text" 
                                required 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 ease-in-out text-gray-900 placeholder-gray-400 bg-white"
                                placeholder="Votre nom"
                            />
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div class=" bg-gray-50 px-4 py-2 backdrop-blur-xl">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Adresse email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                required 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 ease-in-out text-gray-900 placeholder-gray-400 bg-white"
                                placeholder="votre@email.com"
                            />
                        </div>
                    </div>
                </div>

                <!-- Account Type Select -->
                <div class=" bg-gray-50 px-4 py-2 backdrop-blur-xl">
                    <label for="account_type" class="block text-sm font-medium text-gray-700 mb-1">
                        Type de compte
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-users text-gray-400"></i>
                        </div>
                        <select 
                            id="account_type" 
                            name="account_type" 
                            required 
                            class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 ease-in-out text-gray-900 bg-white"
                        >
                            <option value="">Sélectionnez un type de compte</option>
                            <option value="Formateur">Formateur</option>
                            <option value="Apprenant">Apprenant</option>
                        </select>
                    </div>
                </div>

                <!-- Password and Confirm Password in same line -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Password Input -->
                    <div class=" bg-gray-50 px-4 py-2 backdrop-blur-xl">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Mot de passe
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 ease-in-out text-gray-900 placeholder-gray-400 bg-white"
                                placeholder="••••••••"
                            />
                        </div>
                    </div>

                    <!-- Confirm Password Input -->
                    <div class=" bg-gray-50 px-4 py-2 backdrop-blur-xl">
                        <label for="confirmpassword" class="block text-sm font-medium text-gray-700 mb-1">
                            Confirmer
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input 
                                id="confirmpassword" 
                                name="confirmpassword" 
                                type="password" 
                                required 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 ease-in-out text-gray-900 placeholder-gray-400 bg-white"
                                placeholder="••••••••"
                            />
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            name="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 ease-in-out font-medium text-sm">
                        <span class="text-center flex items-center mt-1 pr-3">
                            <i class="fas fa-user-plus text-blue-200 group-hover:text-blue-100 transition-colors"></i>
                        </span>
                        S'inscrire
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Déjà un compte ? 
                        <a href="/login" class="font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200">
                            Se connecter
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Success/Error Messages Container -->
    <div id="notification" class="fixed top-4 right-4 max-w-md"></div>

    <script>
        // Animation pour faire apparaître la carte
        document.querySelector('.max-w-md').classList.add('opacity-0');
        setTimeout(() => {
            document.querySelector('.max-w-md').classList.remove('opacity-0');
            document.querySelector('.max-w-md').classList.add('transition-opacity', 'duration-500', 'opacity-100');
        }, 100);
    </script>
</body>
</html>