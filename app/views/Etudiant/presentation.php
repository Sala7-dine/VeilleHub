<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mes Présentations</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <div class="relative bg-[#f7f6f9] h-full min-h-screen font-[sans-serif]">
    <div class="flex items-start">


    <?php include __DIR__ . "/../layouts/aprenantSidebare.php"; ?>

    <section class="main-content w-full px-8">
      
      <?php include __DIR__ . "/../layouts/dashboardHeader.php"; ?>
        <div class="p-6">
          <!-- Présentations à venir -->
          <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Présentations à venir</h2>
            <div class="bg-white rounded-lg shadow">
              <?php if (!empty($upcoming)): ?>
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participants</th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($upcoming as $presentation): ?>
                      <tr>
                        <td class="px-6 py-4">
                          <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($presentation['titre']) ?></div>
                          <div class="text-sm text-gray-500"><?= htmlspecialchars($presentation['description']) ?></div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                          <?= date('d/m/Y H:i', strtotime($presentation['presentation_date'])) ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                          <?= htmlspecialchars($presentation['student_names']) ?>
                        </td>
                        <td class="px-6 py-4">
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                            À venir
                          </span>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              <?php else: ?>
                <div class="p-6 text-center text-gray-500">
                  Aucune présentation à venir
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Présentations passées -->
          <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Présentations passées</h2>
            <div class="bg-white rounded-lg shadow">
              <?php if (!empty($past)): ?>
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participants</th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($past as $presentation): ?>
                      <tr>
                        <td class="px-6 py-4">
                          <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($presentation['titre']) ?></div>
                          <div class="text-sm text-gray-500"><?= htmlspecialchars($presentation['description']) ?></div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                          <?= date('d/m/Y H:i', strtotime($presentation['presentation_date'])) ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                          <?= htmlspecialchars($presentation['student_names']) ?>
                        </td>
                        <td class="px-6 py-4">
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            Terminée
                          </span>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              <?php else: ?>
                <div class="p-6 text-center text-gray-500">
                  Aucune présentation passée
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

      </section>
    </div>
  </div>


</body>

</html>