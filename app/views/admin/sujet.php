<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Sujets</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

  <div class="relative bg-[#f7f6f9] h-full min-h-screen font-[sans-serif]">
    <div class="flex items-start">

      <?php include __DIR__ . "/../layouts/sidebar.php"; ?>

      <section class="main-content w-full px-8">

        <?php include __DIR__ . "/../layouts/dashboardHeader.php"; ?>

        <!--------------------------------------------- GESTION DES SUJET ---------------------------------------------------------->

        <section id="user" class="flex flex-col items-center bg-gray-50 min-h-screen p-6">
          <!-- Header -->
          <div class="w-full max-w-7xl p-6 space-y-6">
            <div class="flex justify-between items-center">
              <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                Gestion des Sujets
              </h1>
            </div>

            <!-- Remplacer la section "Grid de cartes" par ce nouveau code -->
            <div class="p-6 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
                <div class="max-w-7xl mx-auto">
                    <!-- En-tête avec statistiques -->
                    <div class="flex flex-wrap gap-4 mb-8">
                        <div class="flex-1 min-w-[200px] bg-white rounded-2xl p-4 border border-blue-100 backdrop-blur-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Sujets</p>
                                    <p class="text-2xl font-bold text-gray-800"><?= count($sujets) ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex-1 min-w-[200px] bg-white rounded-2xl p-4 border border-emerald-100">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Sujets Validés</p>
                                    <p class="text-2xl font-bold text-gray-800">
                                        <?= count(array_filter($sujets, fn($s) => $s['status'] === 'Validé')) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grille de cartes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php if(isset($sujets) && !empty($sujets)): ?>
                            <?php foreach($sujets as $sujet): ?>
                                <div class="group relative">
                                    <!-- Carte principale -->
                                    <div class="relative bg-white rounded-[0.6rem] p-6 shadow-lg border border-blue-100/50">
                                        <!-- Badge de statut -->
                                        <?php
                                            $statusColors = [
                                                'Validé' => 'bg-gradient-to-r from-emerald-500 to-teal-500',
                                                'Rejeté' => 'bg-gradient-to-r from-red-500 to-pink-500',
                                                'Proposé' => 'bg-gradient-to-r from-amber-500 to-orange-500'
                                            ];
                                            $statusColor = $statusColors[$sujet['status']] ?? $statusColors['Proposé'];
                                        ?>
                                        <div class="absolute -top-3 right-6">
                                            <div class="px-4 py-1 rounded-full <?= $statusColor ?> text-white text-sm font-medium shadow-lg">
                                                <?= htmlspecialchars($sujet['status']) ?>
                                            </div>
                                        </div>

                                        <!-- Contenu de la carte -->
                                        <div class="space-y-6">
                                            <!-- En-tête -->
                                            <div class="flex justify-between items-start">
                                                <h3 class="text-xl font-bold text-gray-800 line-clamp-2">
                                                    <?= htmlspecialchars($sujet['titre']) ?>
                                                </h3>
                                                <form action="/delete-sujet" method="POST" class="inline" 
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce sujet ?');">
                                                    <input type="hidden" name="sujet_id" value="<?= $sujet['id_sujet'] ?>">
                                                    <button type="submit" 
                                                            class="p-2 rounded-full hover:bg-red-50 text-red-500 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Description -->
                                            <p class="text-gray-600 text-sm line-clamp-3">
                                                <?= htmlspecialchars($sujet['description']) ?>
                                            </p>

                                            <!-- Étudiant -->
                                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50">
                                                <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center shadow-sm">
                                                    <span class="text-2xl">👨‍🎓</span>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Proposé par</p>
                                                    <p class="text-sm text-gray-600"><?= htmlspecialchars($sujet['student_name']) ?></p>
                                                </div>
                                            </div>

                                            <!-- Actions -->
                                            <div class="flex gap-3">
                                                <form action="/update-sujet-status" method="POST" class="flex-1">
                                                    <input type="hidden" name="sujet_id" value="<?= $sujet['id_sujet'] ?>">
                                                    <select name="status" onchange="this.form.submit()" 
                                                            class="w-full px-4 py-2.5 rounded-xl text-sm font-medium bg-gray-50 
                                                                   border-2 border-gray-100 focus:border-blue-500 transition-all">
                                                        <option value="Proposé" <?= $sujet['status'] === 'Proposé' ? 'selected' : '' ?>>
                                                            🕒 En attente
                                                        </option>
                                                        <option value="Validé" <?= $sujet['status'] === 'Validé' ? 'selected' : '' ?>>
                                                            ✅ Approuvé
                                                        </option>
                                                        <option value="Rejeté" <?= $sujet['status'] === 'Rejeté' ? 'selected' : '' ?>>
                                                            ❌ Rejeté
                                                        </option>
                                                    </select>
                                                </form>
                                                <button onclick="openDetailsModal(<?= htmlspecialchars(json_encode($sujet)) ?>)" 
                                                        class="px-4 py-2.5 rounded-xl bg-blue-500 text-white hover:bg-blue-600 
                                                               transition-colors flex items-center gap-2">
                                                    <span>Détails</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" 
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-span-full">
                                <div class="flex flex-col items-center justify-center p-12 bg-white rounded-[2rem] border border-blue-100/50">
                                    <div class="w-24 h-24 mb-6 rounded-2xl bg-blue-50 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Aucun sujet trouvé</h3>
                                    <p class="text-gray-500 text-center max-w-sm">
                                        Il n'y a pas encore de sujets proposés. Les étudiants peuvent commencer à soumettre leurs idées.
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
          </div>
        </section>

        <!----------------------------------------------- GESTION DES CONTENU ----------------------------------------------------------->

      </section>
    </div>
  </div>

  <!-- Modal de détails -->
  <div id="detailsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center z-[1000]">
    <div class="bg-white rounded-lg max-w-2xl w-full mx-4">
      <div class="p-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-bold text-gray-800" id="modalTitle"></h2>
          <button onclick="closeDetailsModal()" class="text-gray-500 hover:text-gray-700">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="space-y-4">
          <div>
            <h3 class="text-sm font-medium text-gray-500">Description</h3>
            <p class="mt-1 text-sm text-gray-900" id="modalDescription"></p>
          </div>
          <div>
            <h3 class="text-sm font-medium text-gray-500">Étudiant</h3>
            <p class="mt-1 text-sm text-gray-900" id="modalStudent"></p>
          </div>
          <div>
            <h3 class="text-sm font-medium text-gray-500">Status</h3>
            <p class="mt-1 text-sm" id="modalStatus"></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function openDetailsModal(sujet) {
      document.getElementById('modalTitle').textContent = sujet.titre;
      document.getElementById('modalDescription').textContent = sujet.description;
      document.getElementById('modalStudent').textContent = sujet.student_name;
      
      const statusElement = document.getElementById('modalStatus');
      statusElement.textContent = sujet.status;
      statusElement.className = `mt-1 text-sm px-2 py-1 rounded-full inline-block ${
        sujet.status === 'Validé' ? 'bg-emerald-100 text-emerald-800' :
        sujet.status === 'Rejeté' ? 'bg-red-100 text-red-800' :
        'bg-yellow-100 text-yellow-800'
      }`;
      
      document.getElementById('detailsModal').classList.remove('hidden');
    }

    function closeDetailsModal() {
      document.getElementById('detailsModal').classList.add('hidden');
    }

    // Fermer la modal en cliquant en dehors
    document.getElementById('detailsModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeDetailsModal();
      }
    });
  </script>

</body>

</html>