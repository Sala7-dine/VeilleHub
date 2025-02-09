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
        <main class="flex-1 overflow-y-auto px-4">
            
            <!-- Top Bar -->
            <?php include __DIR__ . "/../layouts/dashboardHeader.php"; ?>

            <!-- Dashboard Content -->
            <div class="p-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Présentations -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white">
                        <div class="flex justify-between items-center mb-4">
                            <div class="p-3 bg-white/20 rounded-xl">
                                <i class="fas fa-presentation text-xl"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold mb-1"><?= $stats['total_presentations'] ?></h3>
                        <p class="text-white/70">Total Présentations</p>
                    </div>

                    <!-- Présentations Terminées -->
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white">
                        <div class="flex justify-between items-center mb-4">
                            <div class="p-3 bg-white/20 rounded-xl">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold mb-1"><?= $stats['completed_presentations'] ?></h3>
                        <p class="text-white/70">Présentations Terminées</p>
                    </div>

                    <!-- Présentations à Venir -->
                    <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl p-6 text-white">
                        <div class="flex justify-between items-center mb-4">
                            <div class="p-3 bg-white/20 rounded-xl">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold mb-1"><?= $stats['upcoming_presentations'] ?></h3>
                        <p class="text-white/70">Présentations à Venir</p>
                    </div>
                </div>

                <!-- Présentations Récentes -->
                <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Présentations Récentes</h3>
                        <a href="/calendar" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Voir tout</a>
                    </div>
                    <div class="space-y-4">
                        <?php foreach($recentPresentations as $presentation): ?>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-file-alt text-blue-500"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-800">
                                            <?= htmlspecialchars($presentation['titre']) ?>
                                        </h4>
                                        <p class="text-sm text-gray-500">
                                            <?= date('d/m/Y H:i', strtotime($presentation['presentation_date'])) ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <?php
                                    $isPast = strtotime($presentation['presentation_date']) < time();
                                    $statusClass = $isPast ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800';
                                    $statusText = $isPast ? 'Terminée' : 'À venir';
                                    ?>
                                    <span class="px-3 py-1 rounded-full text-sm font-medium <?= $statusClass ?>">
                                        <?= $statusText ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
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