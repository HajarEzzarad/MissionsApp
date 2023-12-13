<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div>
    </br>
    </br>
    <!--dashboard-->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-666df2 p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-users mr-2"></i>
                    Clients Totaux
                </h2>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold text-gray-800">{{ $clientsCount}}</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-05f26c p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-users mr-2"></i>
                    Managers Totaux
                </h2>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold text-gray-800">{{ $managersCount}}</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-yellow-500 p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-user-plus mr-2"></i>
                    Nouveaux Clients
                </h2>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold text-gray-800">{{ $newClientsCount }}</p>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto p-4 flex flex-wrap">
    <!--left side-->
    <div class="w-full md:w-1/2">
        <canvas  id="chart"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>
<script>
    const ctx= document.getElementById('chart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data :{
            labels: ['Clients', 'Managers'],
            datasets: [{
                data: [  
                    {{ $clientPercentage}}, 
                    {{ $managerPercentage}}
                ],
                    backgroundColor: ['blue','rgba(75, 192, 192, 0.2)'],
            }],
        },
        options:{

        },

    });
</script>
    </div>
    <!--right side-->
    <div class="w-full md:w-1/2 p-4 ">
      
    <canvas class="relative rounded-lg overflow-hidden bg-purple-50 p-6 shadow" id="missionsLineChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>
<script>
    // Prepare data from PHP to JavaScript
    var missionsData = @json($missionsByMonth);

    // Extract labels and data for Chart.js
    var labels = Object.keys(missionsData);
    var data = Object.values(missionsData);

    // Create a line chart
    var ctx2 = document.getElementById('missionsLineChart').getContext('2d');
    var myChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Missions accomplies',
                data: data,
                backgroundColor: 'purple',
                borderColor: 'purple',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            }
        }
    });
</script>
</div>
</div>



<style>
    .bg-05f26c {
    background-color: #05f26c;
}
.bg-666df2{
    background-color : #666df2;
}
.bg-c9a0f2{
    background-color: #c9a0f2;
}
</style>
</x-app-layout>

