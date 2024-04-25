@extends('layouts.app')

@section('title', 'Calendrier')

@section('contenu')
  <div id="calendar"></div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="{{ asset('js/fullcalendar/main.js') }}"></script>
  <link href="{{ asset('css/fullcalendar/main.css') }}" rel="stylesheet">
  <script src="{{ asset('js/fullcalendar/locales/fr.js') }}"></script>
  <style>
    #calendar {
      width: 100%;
      max-width: 1100px;
      margin: 0 auto;
      height: 40vh; /* 70% de la hauteur de la fenêtre */
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        locale: 'fr',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'timeGridWeek,timeGridDay'
        },
        businessHours: {
          // Définit les jours ouvrables de la semaine (lundi au vendredi)
          daysOfWeek: [1, 2, 3, 4, 5], // lundi - vendredi
          startTime: '07:00', // Heure de début
          endTime: '17:00' // Heure de fin
        },
        slotMinTime: '07:00', // Heure de début des créneaux
        slotMaxTime: '17:00', // Heure de fin des créneaux
        slotDuration: '01:00', // Durée des créneaux (1 heure)
        selectable: true, // Active la sélection de dates
        select: function(info) {
  // Vérifie si la date sélectionnée est un samedi ou un dimanche
  if ([6, 0].includes(info.start.getDay())) {
    alert("Vous ne pouvez pas créer de disponibilité le samedi ou le dimanche.");
    calendar.unselect();
    return;
  }
  
  // Vérifie si la durée de la sélection dépasse 2 heures
  var diffInHours = moment(info.end).diff(moment(info.start), 'hours');

  if (diffInHours >1 ) {
    alert("Vous ne pouvez sélectionner qu'une période maximale de 1 heure.");
    calendar.unselect();
    return;
  }
          
          var start = info.startStr;
          var end = info.endStr;
          var eventData;
          if (confirm("Voulez-vous ajouter une disponibilité pour ce créneau horaire?")) {
            eventData = {
              start: moment(start).format("YYYY-MM-DD HH:mm:ss"),
              end: moment(end).format("YYYY-MM-DD HH:mm:ss"),
            };
            // Envoyer les données au serveur pour les enregistrer dans la base de données
            $.ajax({
              url: '/disponibilites',
              type: 'POST',
              data: {
                start: moment(start).format("YYYY-MM-DD HH:mm:ss"),
                end: moment(end).format("YYYY-MM-DD HH:mm:ss"),
                _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                // Afficher un message de succès
                alert(response.message);
                // Recharger le calendrier
                calendar.refetchEvents();
              },
              error: function(xhr) {
                // Afficher un message d'erreur
                alert("Une erreur s'est produite lors de l'ajout de la disponibilité.");
              }
            });
          }
          calendar.unselect();
        },
        events: '/disponibilites',
        eventClick: function(info) {
          if (confirm("Voulez-vous supprimer cette disponibilité?")) {
            $.ajax({
              url: '/disponibilites/' + info.event.id,
              type: 'DELETE',
              data: {
                _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                alert(response.message);
                calendar.refetchEvents();
              },
              error: function(xhr) {
                alert("Une erreur s'est produite lors de la suppression de la disponibilité.");
              }
            });
          }
        }
      });
      calendar.render();
    });
  </script>
@endsection
