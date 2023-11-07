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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-666df2 p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-users mr-2"></i>
                    Total Users
                </h2>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold text-gray-800">1002</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-05f26c p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-user-check mr-2"></i>
                    Active Users
                </h2>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold text-gray-800">50</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-yellow-500 p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-user-plus mr-2"></i>
                    New Users
                </h2>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold text-gray-800">20</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-c9a0f2 p-4">
                <h2 class="text-lg font-bold text-white mb-2">
                    <i class="fas fa-dollar-sign mr-2"></i>
                    Revenue
                </h2>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold text-gray-800">2</p>
            </div>
        </div>
    </div>
</div>

</style>
</x-app-layout>

