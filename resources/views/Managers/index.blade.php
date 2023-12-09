<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Managers List
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Add this inside your form or wherever you want the search input -->
<input type="text" id="searchInput" placeholder="Search by name" class="form-input rounded-md shadow-sm">

<div id="filteredResults" class="block mb-8">
    <!-- Display the filtered results here -->
</div>
            

            <div class="block mb-8">
                            <button class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150">
                            <a href="{{ route('managers.create') }}">Ajouter Manager</a>
                            </button>
                        </div>



            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                           
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Prénom
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Phone
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                       
                                    </th>
                                    
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                               @foreach ($managers as $manager)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           {{ $manager->id}}
                                        </td>
                                      
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $manager->nom}}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $manager->prenom}}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $manager->email}}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $manager->phone}}
                                        </td>
                                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                         
                                          </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                              <a href="{{ route('managers.show', $manager->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                                              <a href="{{ route('managers.edit', $manager->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                           <form class="inline-block" action="{{ route('managers.destroy', $manager->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    $(document).ready(function () {
        // Attach an event listener to the search input
        $('#searchInput').on('input', function () {
            // Get the search input value
            var searchQuery = $(this).val().toLowerCase();

            // Filter the managers based on the search query in both "nom" and "prenom" fields
            var filteredManagers = {!! $managers->toJson() !!}.filter(function (manager) {
                return manager.nom.toLowerCase().includes(searchQuery) || manager.prenom.toLowerCase().includes(searchQuery);
            });

            // Render the filtered results or a message
            if (searchQuery === '') {
                $('#filteredResults').html(''); // Clear the results container if the search input is empty
            } else if (filteredManagers.length > 0) {
                renderResults(filteredManagers);
            } else {
                $('#filteredResults').html('<p>No results found for "' + searchQuery + '"</p>');
            }
        });

        // Function to render the filtered results
        function renderResults(results) {
            var resultHtml = '<table class="min-w-full divide-y divide-gray-200 w-full">' +
                                '<thead>' +
                                    '<tr>' +
                                        '<th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">' +
                                            'ID' +
                                        '</th>' +
                                        '<th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">' +
                                            'Nom' +
                                        '</th>' +
                                        '<th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">' +
                                            'Prénom' +
                                        '</th>' +
                                        '<th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">' +
                                            'Email' +
                                        '</th>' +
                                        '<th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">' +
                                            'Phone' +
                                        '</th>' +
                                        '<th scope="col" width="200" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">' +
                                            '' +
                                        '</th>' +
                                    '</tr>' +
                                '</thead>' +
                                '<tbody class="bg-white divide-y divide-gray-200">';

            results.forEach(function (manager) {
                var showUrl = "{{ route('managers.show', ':id') }}".replace(':id', manager.id);
    var editUrl = "{{ route('managers.edit', ':id') }}".replace(':id', manager.id);
    var deleteUrl = "{{ route('managers.destroy', ':id') }}".replace(':id', manager.id);

    resultHtml += '<tr>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' + manager.id + '</td>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' + manager.nom + '</td>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' + manager.prenom + '</td>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' + manager.email + '</td>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' + manager.phone + '</td>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">' +
        '<a href="' + showUrl + '" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>' +
        '<a href="' + editUrl + '" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>' +
        '<form class="inline-block" action="' + deleteUrl + '" method="POST" onsubmit="return confirm(\'Are you sure?\');">' +
        '<input type="hidden" name="_method" value="DELETE">' +
        '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
        '<input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">' +
        '</form>' +
        '</td>' +
        '</tr>';
            });

            resultHtml += '</tbody></table>';

            // Display the results in the #filteredResults container
            $('#filteredResults').html(resultHtml);
        }
    });
</script>
</x-app-layout>