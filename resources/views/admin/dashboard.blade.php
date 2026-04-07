
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const ctx = document.getElementById('peminjamanChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pending', 'Disetujui', 'Dipinjam', 'Selesai'],
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: [
                    {{ $pending }},
                    {{ $disetujui }},
                    {{ $dipinjam }},
                    {{ $selesai }}
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

});
</script>
