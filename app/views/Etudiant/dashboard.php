<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant | Youdemy</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        .card-gradient {
            background: linear-gradient(135deg, #082f49 0%,#0ea5e9 100%);
        }

        .nav-link:hover .icon-wrapper {
            background-color: #6366f1;
            color: white;
        }

        .icon-wrapper {
            transition: all 0.3s ease;
        }
        
    </style>
</head>
<body>
    <div class="flex h-screen bg-gray-100">

        
        <?php include __DIR__ . "/../layouts/aprenantSidebare.php"; ?>

        

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between px-8 py-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Dashboard Enseignant</h2>
                        <p class="text-gray-600">Gérez vos cours et vos étudiants</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <button class="p-2 text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bell text-xl"></i>
                        </button>



                        <div class="flex items-center justify-end gap-6 ml-auto">
                            <div class="w-1 h-10 border-l border-gray-200"></div>
                            <div class="dropdown-menu relative flex shrink-0 group">
                                <div class="flex items-center gap-4">
                                    <p class="text-md font-bold text-gray-600">Welcom, <?= $_SESSION['user_name']; ?></p>
                                <img src="https://readymadeui.com/team-1.webp" alt="profile-pic" class="w-[38px] h-[38px] rounded-full border-2 border-gray-200 cursor-pointer" />
                                </div>

                                <div class="dropdown-content invisible opacity-0 group-hover:visible group-hover:opacity-100 shadow-lg p-4 bg-white rounded-xl absolute top-[48px] right-0 w-64 transition-all duration-300 ease-in-out transform translate-y-2 group-hover:translate-y-0">
                                <div class="w-full space-y-2">
                                    <a href="/profile" class="text-sm text-gray-700 hover:text-sky-500 flex items-center p-2 rounded-lg hover:bg-sky-50 transition duration-300">
                                    <i class="fas fa-user mr-3 w-5 text-center"></i>
                                    Profil
                                    </a>

                                    <?php if($_SESSION["user_role"] == 1){ ?>

                                    <a href="/dashboard" class="text-sm text-gray-700 hover:text-sky-500 flex items-center p-2 rounded-lg hover:bg-sky-50 transition duration-300">
                                    <i class="fas fa-book mr-3 w-5 text-center"></i>
                                    dashboard
                                    </a>

                                    <?php } else if($_SESSION["user_role"] == 0){ ?>
                                    <a href="/dashboard/teacher" class="text-sm text-gray-700 hover:text-sky-500 flex items-center p-2 rounded-lg hover:bg-sky-50 transition duration-300">
                                    <i class="fas fa-book mr-3 w-5 text-center"></i>
                                    dashboard
                                    </a>
                                    <?php } else{ ?>
                                    
                                    <p></p>

                                    <?php } ?>


                                    <hr class="my-2">
                                    <form action="/logout" method="post">
                                    <button type="submit" name="logout" class="w-full text-left text-sm text-red-500 hover:text-red-600 flex items-center p-2 rounded-lg hover:bg-red-50 transition duration-300">
                                        <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                                        Déconnexion
                                    </button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Total Courses -->
                    <div class="card-gradient rounded-2xl p-6 text-white">
                        <div class="flex justify-between items-center mb-4">
                            <div class="p-3 bg-white/20 rounded-xl">
                                <i class="fas fa-book-open text-xl"></i>
                            </div>
                            <span class="text-white/70">+12%</span>
                        </div>
                        <h3 class="text-3xl font-bold mb-1"> <?= $totalCours; ?> </h3>
                        <p class="text-white/70">Cours publiés</p>
                    </div>

                    <!-- Total Students -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <div class="p-3 bg-green-100 rounded-xl text-green-600">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <span class="text-green-600">+25%</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1"><?= $totalInscrits; ?></h3>
                        <p class="text-gray-500">Étudiants inscrits</p>
                    </div>

                </div>
            

                <!-- Remplacer la section des cartes par -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Tableau des Cours -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Liste des Cours</h3>
                            <a href="/mes-cours" class="text-sky-600 hover:text-sky-800 text-sm font-medium">Voir tout</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-2 text-sm font-semibold text-gray-600">Titre</th>
                                        <th class="text-left py-3 px-2 text-sm font-semibold text-gray-600">Catégorie</th>
                                        <th class="text-left py-3 px-2 text-sm font-semibold text-gray-600">date creation</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php for($i = 0 ; $i < 3;$i++): ?>
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-2 text-sm text-gray-800"><?= htmlspecialchars($cours[$i]['titre']) ?></td>
                                        <td class="py-3 px-2 text-sm text-gray-600"> <?= htmlspecialchars($cours[$i]['categorie_nom']) ?></td>
                                        <td class="py-3 px-2 text-sm text-gray-600">   <?= date('d/m/Y', strtotime($cours[$i]['date_creation'])) ?></td>
                                       
                                    </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tableau des Étudiants -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Derniers Étudiants Inscrits</h3>
                            <a href="/etudiants" class="text-sky-600 hover:text-sky-800 text-sm font-medium">Voir tout</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-2 text-sm font-semibold text-gray-600">Étudiant</th>
                                        <th class="text-left py-3 px-2 text-sm font-semibold text-gray-600">Cours</th>
                                        <th class="text-left py-3 px-2 text-sm font-semibold text-gray-600">Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php for($i = 0 ; $i < 3;$i++): ?>

                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-2">
                                            <div class="flex items-center">
                                                <span class="text-sm text-gray-800"><?= htmlspecialchars($etudiants[$i]['nom']) ?></span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-2 text-sm text-gray-600"><?= htmlspecialchars($etudiants[$i]['titre']) ?></td>
                                        <td class="py-3 px-2 text-sm text-gray-600"><?= date('d/m/Y', strtotime($etudiants[$i]['date_inscription'])) ?></td>
                                    </tr>

                                <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>




    <script defer>
            document.addEventListener('DOMContentLoaded', () => {
                let sidebarToggleBtn = document.getElementById('toggle-sidebar');
                let sidebarCollapseMenu = document.getElementById('sidebar-collapse-menu');

                sidebarToggleBtn.addEventListener('click', () => {
                    if (!sidebarCollapseMenu.classList.contains('open')) {
                        sidebarCollapseMenu.classList.add('open');
                        sidebarCollapseMenu.style.cssText = 'width: 250px; visibility: visible; opacity: 1;';
                        sidebarToggleBtn.style.cssText = 'left: 236px;';
                    } else {
                        sidebarCollapseMenu.classList.remove('open');
                        sidebarCollapseMenu.style.cssText = 'width: 32px; visibility: hidden; opacity: 0;';
                        sidebarToggleBtn.style.cssText = 'left: 10px;';
                    }
                });
            });
        </script>
</body>
</html>