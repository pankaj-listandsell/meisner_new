{{-- Office hours badge, shared by the header topbar and the footer so the two never drift.
     Text comes from Settings > General > "Office Hours" (office_hours); nothing renders when
     it is empty. The clock is an inline SVG rather than a file in /assests/img/icons — it
     costs no extra request and picks up the badge colour through currentColor. --}}
@php $office_hours = setting_item_with_lang('office_hours'); @endphp

@if(!empty($office_hours))
    <span class="office-hours">
        <svg class="office-hours-icon" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/>
            <path d="M12 6.75V12l3.5 2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="office-hours-text">{{ $office_hours }}</span>
    </span>
@endif
