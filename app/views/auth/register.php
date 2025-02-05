<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VeillePro - Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0F172A] text-white">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 backdrop-blur-lg bg-[#0F172A]/60 border-b border-gray-800/50">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between h-20 px-6">
                <div class="flex items-center space-x-8">
                    <a href="/" class="text-2xl font-bold relative">
                        <span class="bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-600 bg-clip-text text-transparent">
                            VeillePro
                        </span>
                        <div class="absolute -bottom-1 left-0 w-full h-[2px] bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-600"></div>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/login" class="relative group px-6 py-2 rounded-xl overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-blue-500 to-purple-600 opacity-20 group-hover:opacity-100 transition-opacity"></div>
                        <span class="relative">Connexion</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <div class="relative min-h-screen flex items-center justify-center py-20">
        <!-- Fond animé -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute w-[600px] h-[600px] bg-gradient-to-r from-cyan-500/20 to-blue-500/20 rounded-full blur-3xl -top-48 -left-24 animate-pulse"></div>
            <div class="absolute w-[500px] h-[500px] bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-full blur-3xl bottom-0 right-0 animate-pulse delay-700"></div>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="relative w-full max-w-md mx-auto px-6">
            <div class="bg-[#1E293B]/80 backdrop-blur-lg p-8 rounded-2xl border border-gray-800">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-600 bg-clip-text text-transparent">
                        Créer un compte
                    </h2>
                    <p class="text-gray-400 mt-2">Rejoignez la communauté VeillePro</p>
                </div>

                <form class="space-y-6">
                    <!-- Nom -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-300">Nom complet</label>
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-blue-500 to-purple-600 rounded-lg opacity-20 group-hover:opacity-100 transition-opacity -z-10"></div>
                            <input type="text" class="w-full px-4 py-3 bg-[#0F172A]/60 border border-gray-800 rounded-lg focus:outline-none focus:border-blue-500 transition-colors" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-300">Adresse email</label>
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-blue-500 to-purple-600 rounded-lg opacity-20 group-hover:opacity-100 transition-opacity -z-10"></div>
                            <input type="email" class="w-full px-4 py-3 bg-[#0F172A]/60 border border-gray-800 rounded-lg focus:outline-none focus:border-blue-500 transition-colors" required>
                        </div>
                    </div>

                    <!-- Rôle -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-300">Rôle</label>
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-blue-500 to-purple-600 rounded-lg opacity-20 group-hover:opacity-100 transition-opacity -z-10"></div>
                            <select class="w-full px-4 py-3 bg-[#0F172A]/60 border border-gray-800 rounded-lg focus:outline-none focus:border-blue-500 transition-colors" required>
                                <option value="">Sélectionnez un rôle</option>
                                <option value="student">Étudiant</option>
                                <option value="teacher">Enseignant</option>
                            </select>
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-300">Mot de passe</label>
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-blue-500 to-purple-600 rounded-lg opacity-20 group-hover:opacity-100 transition-opacity -z-10"></div>
                            <input type="password" class="w-full px-4 py-3 bg-[#0F172A]/60 border border-gray-800 rounded-lg focus:outline-none focus:border-blue-500 transition-colors" required>
                        </div>
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-300">Confirmer le mot de passe</label>
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-blue-500 to-purple-600 rounded-lg opacity-20 group-hover:opacity-100 transition-opacity -z-10"></div>
                            <input type="password" class="w-full px-4 py-3 bg-[#0F172A]/60 border border-gray-800 rounded-lg focus:outline-none focus:border-blue-500 transition-colors" required>
                        </div>
                    </div>

                    <!-- Bouton d'inscription -->
                    <button type="submit" class="w-full group relative px-6 py-3 bg-gradient-to-r from-cyan-500 via-blue-500 to-purple-600 rounded-xl overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-700 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                        <span class="relative">S'inscrire</span>
                    </button>

                    <!-- Lien de connexion -->
                    <p class="text-center text-gray-400">
                        Déjà membre ?
                        <a href="/login" class="text-blue-400 hover:text-blue-300 transition-colors">Se connecter</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-gray-800/50 backdrop-blur-lg">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-gray-400 text-sm">
                    © 2024 VeillePro. Tous droits réservés.
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors duration-300">Politique de confidentialité</a>
                    <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors duration-300">Conditions d'utilisation</a>
                </div>
            </div>
        </div>
    </footer>

    <style>
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .animate-gradient {
            background-size: 200% auto;
            animation: gradient 4s linear infinite;
        }
    </style>
</body>
</html>
