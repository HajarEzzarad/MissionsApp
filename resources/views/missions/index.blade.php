<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categories List
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
        <div class="max-w-sm p-6 bg-witheborder border-gray-200 rounded-lg shadow bg-white">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Youtube_logo.png?20220706172052" class="h-8 w-10">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">categoerie 1</h5>
                </a>
                @foreach ($users as $user)
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">20 Missions {{ $user->id}}</p>
                @endforeach
                <div class="flex items-center">
                   <div class="text-sm">
                        <a href="{{ route('missions.show', $user->id) }}" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-trash mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
                    </div>
                </div>
        </div>
        <div class="max-w-sm p-6 bg-witheborder border-gray-200 rounded-lg shadow bg-white">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Youtube_logo.png?20220706172052" class="h-8 w-10">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">categoerie 1</h5>
                </a>
                @foreach ($users as $user)
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">20 Missions {{ $user->id}}</p>
                @endforeach
                <div class="flex items-center">
                   <div class="text-sm">
                        <a href="{{ route('missions.show', $user->id) }}" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-trash mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
                    </div>
                </div>
        </div>
        <div class="max-w-sm p-6 bg-witheborder border-gray-200 rounded-lg shadow bg-white">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Youtube_logo.png?20220706172052" class="h-8 w-10">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">categoerie 1</h5>
                </a>
                @foreach ($users as $user)
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">20 Missions {{ $user->id}}</p>
                @endforeach
                <div class="flex items-center">
                   <div class="text-sm">
                        <a href="{{ route('missions.show', $user->id) }}" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-trash mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
                    </div>
                </div>
        </div>
        <div class="max-w-sm p-6 bg-witheborder border-gray-200 rounded-lg shadow bg-white">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Youtube_logo.png?20220706172052" class="h-8 w-10">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">categoerie 1</h5>
                </a>
                @foreach ($users as $user)
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">20 Missions {{ $user->id}}</p>
                @endforeach
                <div class="flex items-center">
                   <div class="text-sm">
                        <a href="{{ route('missions.show', $user->id) }}" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-trash mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
                    </div>
                </div>
        </div>
        <div class="max-w-sm p-6 bg-witheborder border-gray-200 rounded-lg shadow bg-white">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Youtube_logo.png?20220706172052" class="h-8 w-10">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">categoerie 1</h5>
                </a>
                @foreach ($users as $user)
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">20 Missions {{ $user->id}}</p>
                @endforeach
                <div class="flex items-center">
                   <div class="text-sm">
                        <a href="{{ route('missions.show', $user->id) }}" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-trash mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
                    </div>
                </div>
        </div>
        <div class="max-w-sm p-6 bg-witheborder border-gray-200 rounded-lg shadow bg-white">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Youtube_logo.png?20220706172052" class="h-8 w-10">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">categoerie 1</h5>
                </a>
                @foreach ($users as $user)
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">20 Missions {{ $user->id}}</p>
                @endforeach
                <div class="flex items-center">
                   <div class="text-sm">
                        <a href="{{ route('missions.show', $user->id) }}" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-trash mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
                    </div>
                </div>
        </div>
        </div>
       


</x-app-layout>