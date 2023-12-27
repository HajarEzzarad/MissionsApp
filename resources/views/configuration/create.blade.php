<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Configuration
        </h2>
    </x-slot>
    <div>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
<a href="{{ route('configuration.index')}}">retour</a>
@if(session('message'))
                <div class="bg-green-500 text-white p-4">{{ session('message')}}</div>
                @endif
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('configuration.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="apiKey" class="block font-medium text-sm text-gray-700">apiKey</label>
                            <input type="text" name="apiKey" id="apiKey" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('apiKey', '') }}" />
                          @if ($errors->has('apiKey'))
                                <p class="text-sm text-red-600">{{ $errors->first('apiKey') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="authDomain" class="block font-medium text-sm text-gray-700">authDomain</label>
                            <input type="text" name="authDomain" id="authDomain" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('authDomain', '') }}" />
                            @if ($errors->has('authDomain'))
                                <p class="text-sm text-red-600">{{ $errors->first('authDomain') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="databaseURL" class="block font-medium text-sm text-gray-700">databaseURL</label>
                            <input type="text" name="databaseURL" id="databaseURL" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('databaseURL', '') }}" />
                                   @if ($errors->has('databaseURL'))
                                <p class="text-sm text-red-600">{{ $errors->first('databaseURL') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="projectId" class="block font-medium text-sm text-gray-700">projectId</label>
                            <input type="text" name="projectId" id="projectId" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('projectId', '') }}" />
                                   @if ($errors->has('projectId'))
                                <p class="text-sm text-red-600">{{ $errors->first('projectId') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="storageBocket" class="block font-medium text-sm text-gray-700">storageBocket</label>
                            <input type="text" name="storageBocket" id="storageBocket" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('storageBocket', '') }}" />
                                   @if ($errors->has('storageBocket'))
                                <p class="text-sm text-red-600">{{ $errors->first('storageBocket') }}</p>
                         @endif
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="messagingSenderId" class="block font-medium text-sm text-gray-700">messagingSenderId</label>
                            <input type="text" name="messagingSenderId" id="messagingSenderId" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('messagingSenderId', '') }}" />
                                   @if ($errors->has('messagingSenderId'))
                                <p class="text-sm text-red-600">{{ $errors->first('messagingSenderId') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="appId" class="block font-medium text-sm text-gray-700">appId</label>
                            <input type="text" name="appId" id="appId" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('appId', '') }}" />
                                   @if ($errors->has('appId'))
                                <p class="text-sm text-red-600">{{ $errors->first('appId') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="measurementId" class="block font-medium text-sm text-gray-700">measurementId</label>
                            <input type="text" name="measurementId" id="measurementId" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('measurementId', '') }}" />
                                   @if ($errors->has('measurementId'))
                                <p class="text-sm text-red-600">{{ $errors->first('measurementId') }}</p>
                         @endif
                        </div>
                       
                        <div class="flex items-center justify-end px-4 py-3 bg-purple-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150">
                                Créer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>