@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white p-6 rounded-2xl shadow">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            Log Aktivitas Sistem
        </h2>

        <!-- FILTER -->
        <form method="GET" class="flex flex-wrap gap-4">

            <!-- SEARCH -->
            <input type="text" name="search"
                value="{{ request('search') }}"
                placeholder="Search activity..."
                class="border rounded-lg px-4 py-2 text-sm">

            <!-- FILTER USER -->
            <select name="user_id" class="border rounded-lg px-4 py-2 text-sm">
                <option value="">Semua User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <!-- FILTER DATE -->
            <input type="date" name="date"
                value="{{ request('date') }}"
                class="border rounded-lg px-4 py-2 text-sm">

            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                Filter
            </button>

        </form>
    </div>

    <!-- CHART -->
    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="font-semibold mb-4 text-gray-700">
            Aktivitas 7 Hari Terakhir
        </h3>

        <canvas id="logChart" height="80"></canvas>
    </div>

    <!-- LOG GROUPED -->
    <div class="bg-white p-6 rounded-2xl shadow">

        @php
            $grouped = $logs->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
            });
        @endphp

        @foreach($grouped as $date => $items)

            <h4 class="text-sm font-semibold text-gray-500 mt-6 mb-3">
                {{ \Carbon\Carbon::parse($date)->diffForHumans() }}
            </h4>

            @foreach($items as $log)
            <div class="flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition p-4 rounded-xl mb-2">

                <div>
                    <p class="text-sm font-medium text-gray-800">
                        {{ $log->description }}
                    </p>
                    <p class="text-xs text-gray-400">
                        {{ $log->user->name ?? 'System' }}
                    </p>
                </div>

                <span class="text-xs text-gray-400">
                    {{ $log->created_at->format('H:i') }}
                </span>

            </div>
            @endforeach

        @endforeach

        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $logs->links() }}
        </div>

    </div>

</div>


<!-- AUTO REFRESH -->
<script>
    setTimeout(function(){
        window.location.reload();
    }, 10000);
</script>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('logChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartData->pluck('date')) !!},
            datasets: [{
                label: 'Total Aktivitas',
                data: {!! json_encode($chartData->pluck('total')) !!},
                tension: 0.4
            }]
        }
    });
</script>

@endsection