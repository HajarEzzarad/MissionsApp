<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Payement
        </h2>
    </x-slot>
    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between ">
        <div class="block mb-8 justify-end">
                <a href="{{ route('users.index') }}" class="text-purple font-bold py-2 px-4 rounded"><i class="fas fa-arrow-left"></i>Back</a>
            </div>
                       
                        <div class="justify-end">
                       
</div>
        </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="container mx-auto p-4 flex flex-wrap">
    <!--left side-->
    <div class="w-100 md:w-1/2 border-b shadow rounded bg-green-50 p-12">
    <p class="text-black-500 font-bold py-2 px-2 rounded"><i class="fas fa-user" style="color: green;"> user Name :</i> {{ $clients->nom }} {{ $clients->prenom }}</p>
    <p class="text-black-500 font-bold py-2 px-2 rounded"><i class="fas fa-check" style="color: green;"></i> {{ $count}} completed missions</p>
    <p class="text-black-500 font-bold py-2 px-2 rounded"><i class="fas fa-pen" style="color: green;"> RIB :</i> {{ $clients->RIB}}</p>
    <p class="text-black-500 font-bold py-2 px-2 rounded"><i class="fas fa-building" style="color: green;"> Bank Name :</i> {{ $clients->NomBanque}}</p>
   
    </div>
    <div class="p-4 md:w-1/2 w-full">
    <canvas id="weeklyPayerChart" ></canvas>
                    </div>
    <!--right side
    <div class="w-full md:w-1/3 p-4">
        <h2 class="text-lg font-bold mb-2">completed missions validated in %:  {{ $completionPercentage }}%</h2>
        <canvas id="completionChart"></canvas>
    </div>-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Assuming completionPercentage is passed from the controller
    var completionPercentage = {{ $completionPercentage }};
    
    var ctx = document.getElementById('completionChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Completed Missions validated'],
            datasets: [{
                data: [completionPercentage],
                backgroundColor: ['rgba(160, 32, 240, 0.2)'],
                borderColor: ['rgba(160, 32, 240, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
</script>





    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8 w-full">
    <div class="block mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 sm:grid-cols-2 gap-10">
        <!-- 1-->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-yellow-300 p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-dollar-sign mr-2"></i>
                    Total
                </h2>
            </div>
            <div class="p-4">
                @if( $clients->badge == 0)
                <p class="text-3xl font-bold text-gray-800">0 DH</p>
                @else
                <p class="text-3xl font-bold text-gray-800">{{ $clients->badge}} DH</p>
            @endif
            </div>
        </div>
         <!-- 1-->
         <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-c9a0f2 p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-dollar-sign mr-2"></i>
                    Paid
                </h2>
            </div>
            <div class="p-4">
            @if( $clients->payer == 0)
                <p class="text-3xl font-bold text-gray-800">0 DH</p>
                @else
                <p class="text-3xl font-bold text-gray-800">{{ $clients->payer}} DH</p>
                @endif
            </div>
        </div>
         <!-- 1-->
         <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-05f26c p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-dollar-sign mr-2"></i>
                    Credit
                </h2>
            </div>
            <div class="p-4">
            @if( $clients->credit == 0)
                <p class="text-3xl font-bold text-gray-800">0 DH</p>
                @else
                <p class="text-3xl font-bold text-gray-800">{{ $clients->credit}} DH</p>
           @endif
            </div>
        </div>
         <!-- 1-->
         <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-666df2 p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-check mr-2"></i>
                    Total Missions Completed
                </h2>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold text-gray-800">{{ $count}}</p>
            </div>
        </div>
    </div>
    </div>
    @if(session('message'))
                <div class="bg-green-500 text-white p-4">{{ session('message')}}</div>
                @endif
            <!--    <div class="bg-white  shadow-lg overflow-hidden">
            <div class="bg-gray-700 p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    Bank Information
                </h2>
            </div>
            <div class="p-4">
                   <div class="flex justify-center">
                   <label for="prix" class="flex font-medium text-sm text-gray-700"><i class="fas fa-pen mr-2"></i>RIB : </label>   
                         <span class="flex font-medium text-sm text-gray-700"> {{ $clients->RIB}} </span>
                   </div> 
</br>
                   <div class="flex justify-center">
                   <label for="prix" class="flex font-medium text-sm text-gray-700"><i class="fas fa-building mr-2"></i>Bank Name : </label>   
                         <span class="flex font-medium text-sm text-gray-700"> {{ $clients->NomBanque}} </span>
                   </div> 
          
            </div>
        </div>-->
              
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('ajouter-payer', $clients->id) }}" enctype="multipart/form-data">
                    @csrf
                        <div class="px-4 py-5 bg-white sm:p-6 justify-start">
                        <label for="payer" class="block font-medium text-sm text-gray-700"><i class="fas fa-dollar-sign mr-2"></i>PRIX DE PAYEMENT</label>
                            <input type="text" name="payer" id="payer" placeholder="00.00" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="" />
                        </div>
                       
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>











</div>
                        </div>
                    </div>
                </div>
            </div>

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



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!--<script>
        // Prepare data from PHP to JavaScript
        var chartData = @json($data);

        // Extract labels and data for Chart.js
        var labels = chartData.map(entry => entry.week);
        var data = chartData.map(entry => entry.total_payer);

        // Create a chart
        var ctx = document.getElementById('weeklyPayerChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Weekly Payer',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>-->


    <script>
        // Prepare data from PHP to JavaScript
        var chartData = @json($data);

        // Extract labels and data for Chart.js
        var labels = [];
        var data = [];

        // Iterate over the weeks and populate labels and data arrays
        for (var i = 1; i <= 52; i++) { // Assuming there are 52 weeks in a year
            var weekData = chartData.find(entry => entry.week === i);

            if (weekData) {
                labels.push(i);
                data.push(weekData.total_payer);
            } else {
                labels.push(i);
                data.push(0);
            }
        }

        // Create a chart
        var ctx = document.getElementById('weeklyPayerChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line', // Set the chart type to 'line'
            data: {
                labels: labels,
                datasets: [{
                    label: 'Weekly Paid',
                    data: data,
                    backgroundColor: 'rgba(160, 32, 240, 0.2)',
                    borderColor: 'rgba(160, 32, 240, 1)',
                    borderWidth: 1,
                    fill: false // Set fill to false for a line chart
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


</x-app-layout>