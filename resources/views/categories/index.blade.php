<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categories List
        </h2>
    </x-slot>

        <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
                            <button class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150">
                            <a href="{{ route('categories.create') }}">Add Category</a>
                            </button>
                        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
            @foreach($categories as $categorie)
        <div class="max-w-sm p-6 bg-witheborder border-gray-200 rounded-lg shadow bg-white">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Youtube_logo.png?20220706172052" class="h-8 w-10">
                <a>
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $categorie->nom}}</h5>
                </a>
               
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">{{ $categorie->mission_count}} Missions</p>
       
                <div class="flex items-center">
                   <div class="text-sm">
                        <a href="{{ route('categories.show', $categorie->id) }}" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="{{ route('categories.edit', $categorie->id) }}" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
                        <form class="inline-block" action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
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
        <style>
            .delete_btn{
                background: none;
                border: none;
                color: red;
                cursor: pointer;
            }
        </style>
</x-app-layout>