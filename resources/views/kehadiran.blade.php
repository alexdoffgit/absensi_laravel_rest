<x-layout title="Kehadiran" :$uid :jabatan="$position" >
    <div class="container-fluid g-0" style="width: 1024px;">
        <div id="calendar"></div>
    </div>
    <x-slot:script>
        <script type="module">
            const calendar = window.absensi.createCalendar("{{ $uid }}")

            calendar.render()
        </script>
    </x-slot>
</x-layout>