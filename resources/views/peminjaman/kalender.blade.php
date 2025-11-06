@extends('layouts.app')

@section('title', 'Kalender Jadwal')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Kalender Jadwal Peminjaman</h4>
                <a href="{{ route('peminjaman.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i>Ajukan Peminjaman
                </a>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Kalender ini menampilkan jadwal peminjaman ruangan yang sudah disetujui.
                </div>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<style>
    #calendar {
        background-color: white;
        border-radius: 0.375rem;
        padding: 1rem;
    }
    .fc-header-toolbar {
        margin-bottom: 1.5rem !important;
    }
    .fc-toolbar-chunk {
        display: flex;
        align-items: center;
    }
    .fc-button {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }
    .fc-button:hover {
        background-color: #0b5ed7 !important;
        border-color: #0a58ca !important;
    }
    .fc-button-active {
        background-color: #0a58ca !important;
        border-color: #0a53be !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/id.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'id',
        firstDay: 1, // Senin sebagai hari pertama
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText: {
            today: 'Hari Ini',
            month: 'Bulan',
            week: 'Minggu',
            day: 'Hari'
        },
        events: @json($events),
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
        eventDisplay: 'block',
        eventColor: '#0d6efd',
        eventTextColor: '#ffffff',
        height: 'auto',
        navLinks: true,
        editable: false,
        selectable: false,
        dayMaxEvents: true,
        handleWindowResize: true,
        windowResize: function(view) {
            if (window.innerWidth < 768) {
                calendar.changeView('dayGridMonth');
            }
        },
        loading: function(bool) {
            if (bool) {
                // Show loading indicator
                calendarEl.innerHTML = '<div class="text-center p-4"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Memuat kalender...</p></div>';
            }
        },
        eventDidMount: function(info) {
            // Tooltip untuk event
            info.el.setAttribute('title', info.event.title);
            info.el.setAttribute('data-bs-toggle', 'tooltip');
        }
    });

    calendar.render();

    // Inisialisasi tooltip Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Responsive behavior
    window.addEventListener('resize', function() {
        calendar.updateSize();
    });
});
</script>
@endpush