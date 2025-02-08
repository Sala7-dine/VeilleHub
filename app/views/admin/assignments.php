<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Présentations</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <div class=" bg-[#f7f6f9] h-full min-h-screen font-[sans-serif]">
    <div class="flex items-start">

      <?php include __DIR__ . "/../layouts/sidebar.php"; ?>

      <section class="main-content w-full px-8">

        <?php include __DIR__ . "/../layouts/dashboardHeader.php"; ?>


        <section id="user" class="flex flex-col items-center bg-gray-50 min-h-screen p-6">
          <!-- Header -->
          <div class="w-full max-w-7xl bg-white shadow-sm rounded-lg p-6 space-y-6">
            <div class="flex justify-between items-center">
              <h1 class="text-3xl font-bold text-gray-800">Gestion des Présentations</h1>
            </div>

            <!-- Table des sujets -->
            <div class="overflow-x-auto">
              <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="p-4 text-left text-sm font-semibold text-gray-900">Titre</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-900">Description</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-900">Étudiants assignés</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-900">Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <?php if(isset($sujets) && !empty($sujets)): ?>
                    <?php foreach($sujets as $sujet): ?>
                      <?php if($sujet['status'] === 'Validé'): ?>
                      <tr>
                        <td class="p-4 text-sm text-gray-900">
                          <?= htmlspecialchars($sujet['titre']) ?>
                        </td>
                        <td class="p-4 text-sm text-gray-600 max-w-xs truncate">
                          <?= htmlspecialchars($sujet['description']) ?>
                        </td>
                        <td class="p-4 text-sm">
                          <span class="px-3 py-1 rounded-full bg-green-100 text-green-800">
                            <?= htmlspecialchars($sujet['status']) ?>
                          </span>
                        </td>
                        <td class="p-4 text-sm">
                          <?php
                            $statusColors = [
                              'pending' => 'bg-yellow-100 text-yellow-800',
                              'completed' => 'bg-green-100 text-green-800',
                              'cancelled' => 'bg-red-100 text-red-800'
                            ];
                            $statusColor = $statusColors[$sujet['presentation_status']] ?? 'bg-gray-100 text-gray-800';
                          ?>
                          <button onclick="openStatusModal(<?= $sujet['id_sujet'] ?>, '<?= $sujet['presentation_status'] ?>')" 
                                  class="px-3 py-1 rounded-full <?= $statusColor ?> hover:opacity-80 transition-opacity">
                            <?= ucfirst(htmlspecialchars($sujet['presentation_status'] ?? 'pending')) ?>
                          </button>
                        </td>
                        <td class="p-4 text-sm">
                          <?php if(isset($sujet['assigned_students'])): ?>
                            <div class="flex flex-wrap gap-2">
                              <?php foreach($sujet['assigned_students'] as $student): ?>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                  <?= htmlspecialchars($student['nom']) ?>
                                </span>
                              <?php endforeach; ?>
                            </div>
                          <?php else: ?>
                            <span class="text-gray-500">Aucun étudiant assigné</span>
                          <?php endif; ?>
                        </td>
                        <td class="p-4 text-sm">
                          <button onclick="openAssignModal(<?= $sujet['id_sujet'] ?>)" 
                                  class="px-4 py-2 bg-cyan-500 text-white rounded-md hover:bg-cyan-600 transition-colors">
                            Assigner des étudiants
                          </button>
                        </td>
                      </tr>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="5" class="p-4 text-center text-gray-500">
                        Aucun sujet validé trouvé
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
        
        <!-- Modal d'assignation avec checkboxes -->
        <div id="assignModal" class="hidden fixed z-[1000] inset-0 bg-black bg-opacity-50 flex items-center justify-center">
          <div class="bg-white rounded-lg p-6 w-full max-w-md max-h-[80vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-bold">Assigner des étudiants</h2>
              <button onclick="closeAssignModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
            <form action="/assign-students" method="POST" id="assignForm">
              <input type="hidden" name="sujet_id" id="modalSujetId">
              <div class="mb-4">
                <p class="text-sm font-medium text-gray-700 mb-2">
                  Sélectionner les étudiants (minimum 2)
                </p>
                <div class="space-y-2 max-h-60 overflow-y-auto border rounded-md p-3">
                  <?php if(isset($students)): ?>
                    <?php foreach($students as $student): ?>
                      <label class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded">
                        <input type="checkbox" 
                               name="student_ids[]" 
                               value="<?= $student['id_user'] ?>"
                               class="h-4 w-4 text-cyan-600 rounded border-gray-300 focus:ring-cyan-500">
                        <span class="text-sm text-gray-700">
                          <?= htmlspecialchars($student['nom']) ?>
                        </span>
                      </label>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
                <p class="text-xs text-gray-500 mt-2">
                  <span class="text-red-500">* </span> Sélectionnez au moins 2 étudiants
                </p>
              </div>
              <div class="flex justify-end gap-4 mt-6">
                <button type="button" 
                        onclick="closeAssignModal()" 
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                  Annuler
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-cyan-500 text-white rounded-md hover:bg-cyan-600 transition-colors">
                  Assigner
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Modal pour le changement de statut -->
        <div id="statusModal" class="hidden fixed z-[1000] inset-0 bg-black bg-opacity-50 flex items-center justify-center">
          <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-bold">Modifier le statut de la présentation</h2>
              <button onclick="closeStatusModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
            <form action="/update-presentation-status" method="POST" id="statusForm">
              <input type="hidden" name="sujet_id" id="statusSujetId">
              <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Nouveau statut
                </label>
                <select name="status" id="presentationStatus" 
                        class="w-full p-2 border rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                  <option value="pending">En attente</option>
                  <option value="completed">Terminée</option>
                  <option value="cancelled">Annulée</option>
                </select>
              </div>
              <div class="flex justify-end gap-4 mt-6">
                <button type="button" 
                        onclick="closeStatusModal()" 
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                  Annuler
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-cyan-500 text-white rounded-md hover:bg-cyan-600 transition-colors">
                  Mettre à jour
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>

  <script>
    function openAssignModal(sujetId) {
      document.getElementById('modalSujetId').value = sujetId;
      document.getElementById('assignModal').classList.remove('hidden');
      // Réinitialiser les checkboxes
      document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
    }

    function closeAssignModal() {
      document.getElementById('assignModal').classList.add('hidden');
    }

    // Validation du formulaire
    document.getElementById('assignForm').addEventListener('submit', function(e) {
      const checkedBoxes = document.querySelectorAll('input[name="student_ids[]"]:checked');
      if (checkedBoxes.length < 2) {
        e.preventDefault();
        alert('Veuillez sélectionner au moins 2 étudiants');
      }
    });

    // Fermer la modal en cliquant en dehors
    document.getElementById('assignModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeAssignModal();
      }
    });

    function openStatusModal(sujetId, currentStatus) {
      document.getElementById('statusSujetId').value = sujetId;
      document.getElementById('presentationStatus').value = currentStatus;
      document.getElementById('statusModal').classList.remove('hidden');
    }

    function closeStatusModal() {
      document.getElementById('statusModal').classList.add('hidden');
    }

    // Fermer la modal en cliquant en dehors
    document.getElementById('statusModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeStatusModal();
      }
    });
  </script>

</body>

</html>