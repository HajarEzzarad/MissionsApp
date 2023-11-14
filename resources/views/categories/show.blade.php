<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Show Category
        </h2>
    </x-slot>
    <div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('categories.index') }}" class="bg-purple-200 hover:bg-purple-300 text-black font-bold py-2 px-4 rounded">Back to Categories</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        {{ $category->id }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                       {{ $category->nom }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Number of Managers
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                       {{ $managersCount}}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Managers :
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <ul>
                                      @foreach($category->managers as $manager)
                                        <li>{{ $manager->nom}} {{ $manager->prenom}}</li>
                                    @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Numbers of the missions
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                       {{ $missionsCount }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ICON
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <img src="{{ asset('storage/category_photo/'.$category->icon_path)}}" class="h-20 w-50" alt="">
                                    </td>
                                </tr>
                                
                            </table>
</div>
</div>
</div>
  <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                            <button class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150">
                            <a href="{{ route('create-mission', $category->id)  }}">Add mission</a>
                            </button>
                        </div>
                        @if(session('message'))
                <div class="bg-red-500 text-white p-4">{{ session('message')}}</div>
                @endif
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 p-4 gap-10">
          @foreach($missions as $mission)
        <div class="max-w-sm p-6 bg-witheborder border-gray-200 rounded-lg shadow bg-white">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $mission->nom}}</h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">{{$mission->description}}</p>
                <div class="flex items-center">
                   <div class="text-sm">
                        <a href="{{ route('missions-show', $mission->id )}}" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="{{ route('missions.edit', $mission->id)}}" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
                        <form class="inline-block" action="{{ route('missions-destroy', $mission->id) }}" method="POST">
                                               @csrf
                                               @method('DELETE')
                                               <button type="submit" onclick="return confirm('Are you sure?');" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                                               <i class="fas fa-trash mr-2"></i>
                                               </button>
                                                </form>
                    </div>
                </div>
</div>
@endforeach
        </div>
       
        </div>
</div>
    </div>
</x-app-layout>