<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Here') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($level === 1 || $level === 2)
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 mb-4">
                    {{-- Total Employee --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="grid gap-y-2">
                            <div class="flex items-center gap-x-2">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Employee</span>
                            </div>
                            <div class="text-3xl font-semibold tracking-tight text-gray-950 dark:text-white">{{ $employeeTotal }}</div>
                        </div>
                    </div>
        
                    {{-- Verified Logs --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="grid gap-y-2">
                            <div class="flex items-center gap-x-2">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Unverified Daily Log</span>
                            </div>
                            <div class="text-3xl font-semibold tracking-tight text-gray-950 dark:text-white">{{ $logsToVerifyTotal }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-md mb-4">
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('Calendar Daily Logs') }}
                        </h3>
                    </div>
                    <div class="relative overflow-x-auto p-4">
                        <div id='calendar'></div>
                    </div>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: @json($calendarEvents)
        });
        calendar.render();
    });
</script>