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
          <div class="w-full max-w-7xl bg-white shadow-sm rounded-lg p-6 space-y-6">
            <div class="flex justify-between items-center">
              <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                Gestion des Sujets
              </h1>
            </div>

            <!-- Table -->
            <div class="font-[sans-serif] overflow-x-auto">
              <table class="min-w-full bg-white">
                <thead class="whitespace-nowrap">
                  <tr>
                    <th class="p-4 text-left text-sm font-semibold text-gray-900">ID</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-900">Titre</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-900">Description</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-900">Étudiant</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-900">Actions</th>
                  </tr>
                </thead>

                <tbody class="whitespace-nowrap">
                  <?php if(isset($sujets) && !empty($sujets)): ?>
                    <?php foreach($sujets as $sujet): ?>
                    
                      <tr class="odd:bg-gray-50">
                        <td class="p-4 text-sm text-gray-600">
                          <?= htmlspecialchars($sujet['id_sujet']) ?>
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                          <?= htmlspecialchars($sujet['titre']) ?>
                        </td>
                        <td class="p-4 text-sm text-gray-600 max-w-xs truncate">
                          <?= htmlspecialchars($sujet['description']) ?>
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                          <?= htmlspecialchars($sujet['student_name']) ?>
                        </td>
                        <td class="p-4 text-sm">
                          <form action="/update-sujet-status" method="POST">
                            <input type="hidden" name="sujet_id" value="<?= $sujet['id_sujet'] ?>">
                            <select name="status" onchange="this.form.submit()" 
                                    class="px-3 py-1 rounded-full text-sm font-medium
                                    <?php
                                      switch($sujet['status']) {
                                        case 'Validé':
                                          echo 'bg-emerald-100 text-emerald-800';
                                          break;
                                        case 'Rejeté':
                                          echo 'bg-red-100 text-red-800';
                                          break;
                                        default:
                                          echo 'bg-yellow-100 text-yellow-800';
                                      }
                                    ?>">
                              <option value="Proposé" <?= $sujet['status'] === 'Proposé' ? 'selected' : '' ?>>
                                En attente
                              </option>
                              <option value="Validé" <?= $sujet['status'] === 'Validé' ? 'selected' : '' ?>>
                                Approuvé
                              </option>
                              <option value="Rejeté" <?= $sujet['status'] === 'Rejeté' ? 'selected' : '' ?>>
                                Rejeté
                              </option>
                            </select>
                          </form>
                        </td>
                        <td class="p-4">
                          <form action="/delete-sujet" method="POST" class="inline" 
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce sujet ?');">
                            <input type="hidden" name="sujet_id" value="<?= $sujet['id_sujet'] ?>">
                            <button type="submit" 
                                    class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                              Supprimer
                            </button>
                          </form>
                        </td>
                      </tr>
              
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="6" class="p-4 text-center text-gray-500">
                        Aucun sujet trouvé
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <!----------------------------------------------- GESTION DES CONTENU ----------------------------------------------------------->

      </section>
    </div>
  </div>


</body>

</html>