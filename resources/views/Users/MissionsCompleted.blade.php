<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Validation
        </h2>
    </x-slot>
    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
        <div class="block mb-8">
                <a href="{{ route('users.index') }}" class="text-purple font-bold py-2 px-4 rounded"><i class="fas fa-arrow-left"></i>Back</a>
                <p class="text-purple-500 font-bold py-2 px-2 rounded">Client: {{ $client->nom }} {{ $client->prenom }}    ID: {{ $client->id }}</p>

            </div>
            
                        </div>
                       
                        <div class="flex items-center justify-end">
    <p class="text-purple-900 font-bold py-2 px-2 rounded">{{ $missionsCount }}</p>
    <i class="fas fa-check" style="color: purple;"></i>
</div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                       MISSION ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        CATEGORIE ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        STATUS
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                       
                                    </th>
                                    
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if(count($completedMissions) > 0)
                    @foreach($completedMissions as $mission)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $mission['id'] }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $mission['category_id'] }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $mission['status'] == 0 ? 'Not validated' : 'validated' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Mission</a>
                                        <form method="post" action="{{ route('valide-missions-completed', ['userId' => $client->id, 'missionId' => $mission['id']]) }}">
                                            @csrf
                                            @method('post')
                                <button class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Valider</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                <p class="text-red-300">No completed missions found!!</p>
            @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>