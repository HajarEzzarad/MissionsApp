<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Configuration
        </h2>
    </x-slot>
    <div>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        @if(count($config) == 0)
    <div class="block mb-8">
                            <button class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150">
                            <a href="{{ route('configuration.create') }}">Ajouter config</a>
                            </button>
                        </div>
@endif

@if(session('message'))
                <div class="bg-green-500 text-white p-4">{{ session('message')}}</div>
                @endif

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                           
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    apiKey
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    authDomain
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    databaseURL
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    projectId
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    storageBocket
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    messagingSenderId
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    appId
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    measurementId
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                       
                                    </th>
                                    
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                             @foreach($config as $cnf)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                      {{ $cnf->apiKey}}
                                        </td>
                                      
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                          {{ $cnf->authDomain}}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $cnf->databaseURL}}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $cnf->projectId}}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $cnf->storageBocket}}
                                        </td>
                                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                          {{ $cnf->messagingSenderId}}
                                          </td>
                                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                          {{ $cnf->appId}}
                                          </td>
                                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                          {{ $cnf->measurementId}}
                                          </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                              <a href="{{ route('configuration.edit', $cnf->id)}}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                           <form class="inline-block" action="{{ route('configuration.destroy', $cnf->id)}}" method="POST" onsubmit="return confirm('Are you sure?');">
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
</x-app-layout>