<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Présentations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Ajout de FullCalendar -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/fr.js'></script>
</head>
<body>
    <div class="relative bg-[#f7f6f9] h-full min-h-screen font-[sans-serif]">
        <div class="flex items-start">
            <?php include __DIR__ . "/../layouts/sidebar.php"; ?>
            
            <section class="main-content w-full px-8">
                <?php include __DIR__ . "/../layouts/dashboardHeader.php"; ?>

                <section class="flex flex-col items-center bg-gray-50 min-h-screen p-6">
                    <div class="w-full max-w-7xl bg-white shadow-sm rounded-lg p-6 space-y-6">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-3xl font-bold text-gray-800">Calendrier des Présentations</h1>
                            <button onclick="openAddEventModal()" 
                                    class="px-4 py-2 bg-emerald-500 text-white rounded-md hover:bg-emerald-600 transition-colors">
                                Planifier une présentation
                            </button>
                        </div>

                        <!-- Calendrier -->
                        <div id="calendar" class="mt-4"></div>
                    </div>
                </section>

                <!-- Modal pour ajouter/éditer une présentation -->
                <div id="eventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold" id="modalTitle">Planifier une présentation</h2>
                            <button onclick="closeEventModal()" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <form id="eventForm" action="/save-presentation" method="POST">
                            <input type="hidden" name="event_id" id="eventId">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Sujet
                                    </label>
                                    <select name="sujet_id" id="sujetSelect" required 
                                            class="w-full p-2 border rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                                        <option value="">Sélectionner un sujet</option>
                                        <?php if(isset($sujets)): ?>
                                            <?php foreach($sujets as $sujet): ?>
                                                <option value="<?= $sujet['id_sujet'] ?>">
                                                    <?= htmlspecialchars($sujet['titre']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Date de présentation
                                    </label>
                                    <input type="datetime-local" name="presentation_date" id="presentationDate" required
                                           class="w-full p-2 border rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                                </div>
                            </div>
                            <div class="flex justify-end gap-4 mt-6">
                                <button type="button" onclick="closeEventModal()"
                                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                                    Annuler
                                </button>
                                <button type="submit"
                                        class="px-4 py-2 bg-emerald-500 text-white rounded-md hover:bg-emerald-600 transition-colors">
                                    Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                locale: 'fr',
                navLinks: true,
                selectable: true,
                selectHelper: true,
                editable: true,
                eventLimit: true,
                events: '/get-presentations',
                select: function(start, end) {
                    openAddEventModal(start);
                },
                eventClick: function(event) {
                    openEditEventModal(event);
                },
                eventDrop: function(event) {
                    updateEventDate(event);
                }
            });
        });

        function openAddEventModal(date = null) {
            document.getElementById('modalTitle').textContent = 'Planifier une présentation';
            document.getElementById('eventId').value = '';
            if (date) {
                document.getElementById('presentationDate').value = date.format('YYYY-MM-DDTHH:mm');
            }
            document.getElementById('eventModal').classList.remove('hidden');
        }

        function openEditEventModal(event) {
            document.getElementById('modalTitle').textContent = 'Modifier la présentation';
            document.getElementById('eventId').value = event.id;
            document.getElementById('sujetSelect').value = event.sujetId;
            document.getElementById('presentationDate').value = event.start.format('YYYY-MM-DDTHH:mm');
            document.getElementById('eventModal').classList.remove('hidden');
        }

        function closeEventModal() {
            document.getElementById('eventModal').classList.add('hidden');
            document.getElementById('eventForm').reset();
        }

        function updateEventDate(event) {
            fetch('/update-presentation-date', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    event_id: event.id,
                    new_date: event.start.format('YYYY-MM-DD HH:mm:ss')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Erreur lors de la mise à jour de la date');
                    $('#calendar').fullCalendar('refetchEvents');
                }
            });
        }
    </script>
</body>
</html>
