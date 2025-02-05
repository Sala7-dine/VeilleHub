<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VeillePro - Innovation Pédagogique</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0F172A] text-white">

  <!-- Navigation Innovante -->
  <nav class="fixed w-full z-50 backdrop-blur-lg bg-[#0F172A]/80 border-b border-gray-800">
    <div class="max-w-7xl mx-auto">
      <div class="flex items-center justify-between h-20 px-6">
        <div class="flex items-center space-x-8">
          <div class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
            VeillePro
          </div>
          <div class="hidden md:flex space-x-1">
            <a href="#" class="relative group px-4 py-2">
              <span class="relative z-10">Accueil</span>
              <div class="absolute inset-0 h-full w-full bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg opacity-0 group-hover:opacity-10 transition-opacity"></div>
            </a>
            <a href="#" class="relative group px-4 py-2">
              <span class="relative z-10">Explorer</span>
              <div class="absolute inset-0 h-full w-full bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg opacity-0 group-hover:opacity-10 transition-opacity"></div>
            </a>
          </div>
        </div>
        <div class="flex items-center space-x-4">
          <button class="px-6 py-2 rounded-full bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 transition-all duration-300">
            Connexion
          </button>
        </div>
      </div>
    </div>
  </nav>

  <!-- Section Héro Innovante -->
  <div class="relative min-h-screen flex items-center">
    <!-- Fond animé -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute w-[500px] h-[500px] bg-cyan-500/30 rounded-full blur-3xl -top-48 -left-24 animate-pulse"></div>
      <div class="absolute w-[400px] h-[400px] bg-blue-500/20 rounded-full blur-3xl bottom-0 right-0 animate-pulse delay-700"></div>
    </div>

    <!-- Contenu -->
    <div class="relative max-w-7xl mx-auto px-6 py-32 grid md:grid-cols-2 gap-12 items-center">
      <div class="space-y-8">
        <div class="space-y-4">
          <h1 class="text-5xl font-bold leading-tight">
            <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
              Révolutionnez
            </span>
            <br/>
            votre veille pédagogique
          </h1>
          <p class="text-gray-400 text-lg">
            Une nouvelle approche de la collaboration éducative, où l'innovation rencontre l'apprentissage.
          </p>
        </div>
        <div class="flex flex-wrap gap-4">
          <button class="group relative px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl overflow-hidden">
            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform"></div>
            <span class="relative">Démarrer</span>
          </button>
          <button class="px-8 py-3 border border-gray-700 rounded-xl hover:border-cyan-500 transition-colors">
            Découvrir
          </button>
        </div>
      </div>

      <!-- Card Grid Innovante -->
      <div class="grid grid-cols-2 gap-4">
        <div class="bg-[#1E293B] p-6 rounded-2xl border border-gray-800 hover:border-cyan-500 transition-colors">
          <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center mb-4">
            📊
          </div>
          <h3 class="font-semibold mb-2">Statistiques en direct</h3>
          <p class="text-gray-400 text-sm">Suivez votre progression en temps réel</p>
        </div>
        <div class="bg-[#1E293B] p-6 rounded-2xl border border-gray-800 hover:border-cyan-500 transition-colors translate-y-8">
          <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center mb-4">
            🎯
          </div>
          <h3 class="font-semibold mb-2">Objectifs clairs</h3>
          <p class="text-gray-400 text-sm">Définissez et atteignez vos buts</p>
        </div>
        <div class="bg-[#1E293B] p-6 rounded-2xl border border-gray-800 hover:border-cyan-500 transition-colors">
          <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center mb-4">
            🤝
          </div>
          <h3 class="font-semibold mb-2">Collaboration</h3>
          <p class="text-gray-400 text-sm">Travaillez ensemble efficacement</p>
        </div>
        <div class="bg-[#1E293B] p-6 rounded-2xl border border-gray-800 hover:border-cyan-500 transition-colors translate-y-8">
          <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center mb-4">
            📱
          </div>
          <h3 class="font-semibold mb-2">Multi-plateforme</h3>
          <p class="text-gray-400 text-sm">Accessible partout, tout le temps</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Section Statistiques -->
  <div class="relative py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid md:grid-cols-3 gap-8">
        <div class="relative group">
          <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
          <div class="relative bg-[#1E293B] p-8 rounded-2xl border border-gray-800">
            <div class="text-4xl font-bold bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
              500+
            </div>
            <p class="text-gray-400 mt-2">Présentations réalisées</p>
          </div>
        </div>
        <div class="relative group">
          <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
          <div class="relative bg-[#1E293B] p-8 rounded-2xl border border-gray-800">
            <div class="text-4xl font-bold bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
              98%
            </div>
            <p class="text-gray-400 mt-2">Taux de satisfaction</p>
          </div>
        </div>
        <div class="relative group">
          <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity"></div>
          <div class="relative bg-[#1E293B] p-8 rounded-2xl border border-gray-800">
            <div class="text-4xl font-bold bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
              1000+
            </div>
            <p class="text-gray-400 mt-2">Utilisateurs actifs</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Innovant -->
  <footer class="border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-6 py-12">
      <div class="flex flex-col md:flex-row justify-between items-center gap-8">
        <div class="text-gray-400 text-sm">
          © 2024 VeillePro. Tous droits réservés.
        </div>
        <div class="flex space-x-6">
          <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">Politique de confidentialité</a>
          <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">Conditions d'utilisation</a>
          <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">Contact</a>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>