<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier une Catgeorie
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('categories.update', $categories->id) }}">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="nom" class="block font-medium text-sm text-gray-700">NOM</label>
                            <input type="text" name="nom" id="nom" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('nom', $categories->nom) }}" />
                                   @if ($errors->has('nom'))
                                <p class="text-sm text-red-600">{{ $errors->first('nom') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="icon_path" class="block font-medium text-sm text-gray-700">ICON</label>
                            <input type="file" name="icon_path" id="icon_path" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $categories->icon_path}}" />
                               
                                   @if ($errors->has('icon_path'))
                                <p class="text-sm text-red-600">{{ $errors->first('icon_path') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="add_manager" class="block font-medium text-sm text-gray-700">Ajouter Managers :</label>
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom de Manager
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
</tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($availableManagers as $manager)
                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $manager->nom}} {{ $manager->prenom}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                         </td>
                                         <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                         </td>
                                         <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                         </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('categories.addManager', ['category'=> $categories->id, 'manager' => $manager->id])}}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">Add</a>
                                        </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="add_manager" class="block font-medium text-sm text-gray-700">Actuel Managers :</label>
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
</tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($categories->managers as $manager)
                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $manager->nom}} {{ $manager->prenom}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                         </td>
                                         <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                         </td>
                                         <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                         </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('categories.detachManager', ['category'=> $categories->id, 'manager' => $manager->id])}}" class="text-red-600 hover:text-red-900 mb-2 mr-2">Delete</a>
                                        </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex items-center justify-end px-4 py-3 bg-purple-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150">
                                Modifier
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function addManagers()
        {
            var selectedManagerIds =  $('#add_manager').val();
            $.each(selectedManagerIds, function(index, managerId){
                var managerName = $('#add_manager option[value=" ' + managerId + ' "]').text();
                $('#current-managers-list').append('<li>' + managerName + '</li>');
            });
            //clear the selection in the dropdown
            $('#add_manager').val([]);
        }
    </script>
</x-app-layout>