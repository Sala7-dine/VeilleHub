<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Calendrier de Présentations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/fr.js'></script>
</head>
<body>
    <div class="relative bg-[#f7f6f9] min-h-screen font-[sans-serif]">
        <div class="flex items-start">
        <?php include __DIR__ . "/../layouts/aprenantSidebare.php"; ?>

        <section class="main-content w-full px-8">
                <?php include __DIR__ . "/../layouts/dashboardHeader.php"; ?>

                <div class="p-6">
                    <!-- En-tête -->
                    <div class="mb-8">
                        <h1 class="text-2xl font-bold text-gray-800">Mon Calendrier de Présentations</h1>
                        <p class="text-gray-600 mt-2">Visualisez vos présentations à venir et passées</p>
                    </div>

                    <!-- Conteneur du calendrier avec style personnalisé -->
                    <div class="bg-white rounded-2xl shadow-sm p-6 overflow-hidden">
                        <div id="calendar"></div>
                    </div>

                    <!-- Modal de détails de présentation -->
                    <div id="eventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                        <div class="bg-white rounded-2xl p-6 max-w-lg w-full mx-4">
                            <div class="flex justify-between items-start mb-4">
                                <h2 id="eventTitle" class="text-xl font-bold text-gray-800"></h2>
                                <button onclick="closeEventModal()" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600">Date et heure</p>
                                    <p id="eventDateTime" class="text-gray-800 font-medium"></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Participants</p>
                                    <p id="eventParticipants" class="text-gray-800"></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Statut</p>
                                    <p id="eventStatus" class="mt-1 inline-flex px-3 py-1 rounded-full text-sm font-medium"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <style>
        /* Style personnalisé pour le calendrier */
        .fc-header-toolbar {
            padding: 1rem 0;
        }

        .fc-button {
            background-color: #fff !important;
            border: 1px solid #e5e7eb !important;
            color: #374151 !important;
            padding: 0.5rem 1rem !important;
            font-weight: 500 !important;
            border-radius: 0.5rem !important;
            box-shadow: none !important;
        }

        .fc-button:hover {
            background-color: #f3f4f6 !important;
        }

        .fc-button-active {
            background-color: #3b82f6 !important;
            color: #fff !important;
        }

        .fc-today {
            background-color: #eff6ff !important;
        }

        .fc-event {
            border: none !important;
            padding: 3px 8px !important;
            border-radius: 6px !important;
            margin: 2px !important;
        }

        .fc-event.upcoming {
            background-color: #ecfdf5 !important;
            border-left: 4px solid #059669 !important;
            color: #065f46 !important;
        }

        .fc-event.past {
            background-color: #f3f4f6 !important;
            border-left: 4px solid #6b7280 !important;
            color: #374151 !important;
        }
    </style>

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
                selectable: false,
                selectHelper: true,
                editable: false,
                eventLimit: true,
                events: '/get-student-presentations',
                eventRender: function(event, element) {
                    const now = moment();
                    const eventDate = moment(event.start);
                    const isPast = eventDate.isBefore(now);
                    
                    element.addClass(isPast ? 'past' : 'upcoming');
                    
                    element.find('.fc-title').html(`
                        <div class="font-medium">${event.title}</div>
                        <div class="text-sm opacity-75">Avec: ${event.students}</div>
                    `);

                    element.attr('title', `${event.title}\nDate: ${eventDate.format('DD/MM/YYYY HH:mm')}\nParticipants: ${event.students}`);
                },
                eventClick: function(event) {
                    showEventDetails(event);
                },
                noEventsMessage: 'Aucune présentation prévue',
                buttonText: {
                    today: "Aujourd'hui",
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour'
                }
            });
        });

        function showEventDetails(event) {
            const modal = document.getElementById('eventModal');
            document.getElementById('eventTitle').textContent = event.title;
            document.getElementById('eventDateTime').textContent = moment(event.start).format('DD MMMM YYYY, HH:mm');
            document.getElementById('eventParticipants').textContent = event.students;
            
            const statusElement = document.getElementById('eventStatus');
            const isPast = moment(event.start).isBefore(moment());
            if (isPast) {
                statusElement.textContent = 'Terminée';
                statusElement.className = 'inline-flex px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800';
            } else {
                statusElement.textContent = 'À venir';
                statusElement.className = 'inline-flex px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800';
            }
            
            modal.classList.remove('hidden');
        }

        function closeEventModal() {
            document.getElementById('eventModal').classList.add('hidden');
        }

        // Fermer la modal en cliquant en dehors
        document.getElementById('eventModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEventModal();
            }
        });
    </script>
</body>
</html>
