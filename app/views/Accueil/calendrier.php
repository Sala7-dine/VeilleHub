<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Présentations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .fc-event { cursor: pointer; }
        .fc-event:hover { opacity: 0.9; }
        .fc-toolbar-title { font-size: 1.5em !important; font-weight: 600 !important; }
        .fc-button { background-color: #06b6d4 !important; border-color: #06b6d4 !important; }
        .fc-button:hover { background-color: #0284c7 !important; }
        .fc-day-today { background-color: #eff6ff !important; }
    </style>
</head>
<body class="bg-cyan-100">


    <?php include __DIR__ . "/../layouts/header.php"; ?>
    <div class="min-h-screen p-4 md:p-8">
        
        <div class="max-w-7xl mx-auto mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Calendrier des Présentations</h1>
        </div>

        <!-- Calendar Container -->
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-4 md:p-8">
            <div id="calendar"></div>
        </div>

        <!-- Modal for Event Details -->
        <div id="eventModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-[1000]">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4" id="modalTitle"></h3>
                    <div class="space-y-3">
                        <p class="text-sm text-gray-600" id="modalDate"></p>
                        <p class="text-sm text-gray-600" id="modalStudents"></p>
                        <p class="text-sm text-gray-600" id="modalDescription"></p>
                    </div>
                    <div class="mt-6">
                        <button onclick="closeModal()" class="w-full bg-cyan-600 text-white py-2 px-4 rounded-lg hover:bg-cyan-700 transition-colors">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: <?php echo json_encode($presentations); ?>,
                eventClick: function(info) {
                    showModal(info.event);
                },
                eventDidMount: function(info) {
                    info.el.title = info.event.title;
                }
            });
            calendar.render();
        });

        function showModal(event) {
            document.getElementById('modalTitle').textContent = event.title;
            document.getElementById('modalDate').textContent = 'Date: ' + event.start.toLocaleDateString('fr-FR', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            document.getElementById('modalStudents').textContent = 'Participants: ' + (event.extendedProps.students || 'Non spécifié');
            document.getElementById('modalDescription').textContent = 'Description: ' + (event.extendedProps.description || 'Aucune description');
            document.getElementById('eventModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('eventModal').classList.add('hidden');
        }

        // Fermer la modal si on clique en dehors
        document.getElementById('eventModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>
