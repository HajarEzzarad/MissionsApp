<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Configuration Firebase
        </h2>
    </x-slot>
    <div>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        @if(count($config) == 0)
    <div class="block mb-8">
                            <button class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150">
                            <a href="{{ route('configuration.create') }}">Ajouter un config</a>
                            </button>
                        </div>
@endif

@if(session('message'))
                <div class="bg-green-500 text-white p-4">{{ session('message')}}</div>
                @endif

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                @if(count($config) != 0)
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class=" border-b shadow rounded bg-white p-12">
                           
        @foreach($config as $cnf)
      <p class="text-black-500 font-bold py-2 px-2 rounded"><i class="" style="color: blue;">  apiKey :</i> {{ $cnf->apiKey}}</p>
        <p class="text-black-500 font-bold py-2 px-2 rounded"><i class="" style="color: blue;"> authDomain : </i>{{ $cnf->authDomain}}</p>
        <p class="text-black-500 font-bold py-2 px-2 rounded"><i class="" style="color: blue;"> databaseURL :</i>{{ $cnf->databaseURL}}</p>
        <p class="text-black-500 font-bold py-2 px-2 rounded"><i class="" style="color: blue;"> projectId : </i>{{ $cnf->projectId}}</p>
        <p class="text-black-500 font-bold py-2 px-2 rounded"> <i class="" style="color: blue;">storageBocket : </i>{{ $cnf->storageBocket}}</p>
        <p class="text-black-500 font-bold py-2 px-2 rounded"><i class="" style="color: blue;"> messagingSenderId : </i>{{ $cnf->messagingSenderId}}</p>
        <p class="text-black-500 font-bold py-2 px-2 rounded"><i class="" style="color: blue;"> appId : </i>{{ $cnf->appId}}</p>
        <p class="text-black-500 font-bold py-2 px-2 rounded"><i class="" style="color: blue;"> measurementId :</i> {{ $cnf->measurementId}}</p>
      <div class="flex items-center justify-end">
        <a href="{{ route('configuration.edit', $cnf->id)}}" class="text-white bg-indigo-600 w-15 p-2 rounded">Edit</a>
        <form class="inline-block" action="{{ route('configuration.destroy', $cnf->id)}}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="text-white bg-red-600 w-20 p-2 rounded" value="Delete">
                                            </form>
</div>
        @endforeach
       
    
</div>
                
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>

</x-app-layout>