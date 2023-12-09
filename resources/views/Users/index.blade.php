<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clients List
        </h2>
    </x-slot>
    

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <input type="text" id="searchInput" placeholder="Search by name" class="form-input rounded-md shadow-sm">

<div id="filteredResults" class="block mb-8">
    <!-- Display the filtered results here -->
</div>
        <div class="block mb-8">
                            <button class="inline-flex items-center px-4 py-2 bg-red-300 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
                            <a href="{{ route('users.unapproved-clients') }}">Clients Pending : {{ $unapprovedClientsCount}}</a>
                            </button>
                        </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
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
                                        Bank
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Credit
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                       
                                    </th>
                                    
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                               @foreach ($approvedClients as $user)
                                    <tr>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->nom}}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->prenom}}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->email}}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->NomBanque}}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                            @if( $user->badge == 0)
                                              00.00
                                             @else
                                                {{ $user->badge}}
                                             @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                            @if( $user->credit == 0)
                                              00.00
                                             @else
                                             {{ $user->credit}}
                                             @endif
                                        </td>
                                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                          
                                          </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('users.payement-user', $user->id) }}" class="text-purple-800 hover:text-purple-900 mb-2 mr-2">Payer</a>
                                        <a href="{{ route('users.missions-completed', $user->id) }}" class="text-green-800 hover:text-green-900 mb-2 mr-2">Validation</a>
                                        <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                                              <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                           <form class="inline-block" action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
        $('#searchInput').on('input', function () {
          
            var searchQuery = $(this).val().toLowerCase();
            var filteredClients = {!! $approvedClients->toJson() !!}.filter(function (client) {
                return client.nom.toLowerCase().includes(searchQuery) || client.prenom.toLowerCase().includes(searchQuery);
            });

            if (searchQuery === '') {
                $('#filteredResults').html(''); 
            } else if (filteredClients.length > 0) {
                renderResults(filteredClients);
            } else {
                $('#filteredResults').html('<p>No results found for "' + searchQuery + '"</p>');
            }
        });

     
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

            results.forEach(function (client) {
                var validationUrl = "{{ route('users.missions-completed', ':id') }}".replace(':id', client.id);
                var payerUrl = "{{ route('users.payement-user', ':id') }}".replace(':id', client.id);
                var showUrl = "{{ route('users.show', ':id') }}".replace(':id', client.id);
    var editUrl = "{{ route('users.edit', ':id') }}".replace(':id', client.id);
    var deleteUrl = "{{ route('users.destroy', ':id') }}".replace(':id', client.id);

    resultHtml += '<tr>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' + client.id + '</td>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' + client.nom + '</td>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' + client.prenom + '</td>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' + client.email + '</td>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' + client.phone + '</td>' +
        '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">' +
        
        '<a href="' + validationUrl + '" class="text-green-600 hover:text-green-900 mb-2 mr-2">Validation</a>' +
        '<a href="' + payerUrl + '" class="text-purple-600 hover:text-purple-900 mb-2 mr-2">Payer</a>' +
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