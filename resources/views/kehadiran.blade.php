<x-layout title="Kehadiran" :$uid :jabatan="$position" :$empName>
    <div class="g-0 py-2" style="margin-left: 40px; margin-right: 40px; overflow-y: hidden;">
        <div class="d-flex my-2">
            <button id="prev" class="btn btn-primary">Prev</button>
            <button id="next" class="btn btn-primary">Next</button>
        </div>
        <div id="calendar"></div>
    </div>
    <x-slot:script>
        <script type="module">
            const calendar = window.absensi.createCalendar("{{ $uid }}");
            calendar.render();

            document.getElementById('prev').addEventListener('click', function() {
                calendar.prev();
            })

            document.getElementById('next').addEventListener('click', function() {
                calendar.next();
            })
        </script>
    </x-slot>
</x-layout>