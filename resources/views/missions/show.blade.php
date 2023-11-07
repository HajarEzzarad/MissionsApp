<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Show Categorie
        </h2>
    </x-slot>
    <div>
    <div class="block mt-8">
                <a href="{{ route('missions.index') }}" class="bg-purple-200 hover:bg-purple-300 text-black font-bold py-2 px-4 rounded">Back to list</a>
            </div>
  <div class="mt-6 border-t border-gray-100">

    <dl class="divide-y divide-gray-100">
    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-sm font-medium leading-6 text-gray-900">Name of the categorie</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">Categorie 1</dd>
      </div>
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-sm font-medium leading-6 text-gray-900">ID</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">1</dd>
      </div>
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-sm font-medium leading-6 text-gray-900">Name the Manager of this categorie</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">Hajar Ezzarad</dd>
</div>
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-sm font-medium leading-6 text-gray-900">Numbers of the missions</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">20</dd>
      </div>
      
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-sm font-medium leading-6 text-gray-900">Missions</dt>
        <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
          <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
              <div class="flex w-0 flex-1 items-center">
                
                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                  <span class="truncate font-medium">Mission 1</span>
                </div>
              </div>
              <div class="ml-4 flex-shrink-0">
              <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-trash mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
              </div>
            </li>
            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
              <div class="flex w-0 flex-1 items-center">
                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                  <span class="truncate font-medium">Mission 2</span>
                </div>
              </div>
              <div class="ml-4 flex-shrink-0">
              <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-trash mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
              </div>
            </li>
            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
              <div class="flex w-0 flex-1 items-center">
                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                  <span class="truncate font-medium">Mission 3</span>
                </div>
              </div>
              <div class="ml-4 flex-shrink-0">
              <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-trash mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
              </div>
            </li>
            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
              <div class="flex w-0 flex-1 items-center">
                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                  <span class="truncate font-medium">Mission 4</span>
                </div>
              </div>
              <div class="ml-4 flex-shrink-0">
              <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-trash mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
              </div>
            </li>
            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
              <div class="flex w-0 flex-1 items-center">
                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                  <span class="truncate font-medium">Mission 5</span>
                </div>
              </div>
              <div class="ml-4 flex-shrink-0">
              <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-eye mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-trash mr-2"></i>
                        </a>
                        <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">
                        <i class="fas fa-edit mr-2"></i>
                        </a>
              </div>
            </li>
          </ul>
        </dd>
      </div>
    </dl>
  </div>
</div>
</x-app-layout>