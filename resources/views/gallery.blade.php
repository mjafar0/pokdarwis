<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- {{ __('//') }} --}}
            <h1 class="font-bold text-3xl italic mb-2">Bintan Gallery!</h1>
            <p class="text-gray-500">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
        </h2>
  </x-slot>

  <div class="py-12">
        {{-- disini edit konten  --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Explore Bintan!") }}
                    <div class="flex items-center justify-center gap-4 my-8">
                    <button class="text-2xl font-bold text-gray-700 px-3 hover:text-black">&lt;</button>
                        <div class="flex gap-6 overflow-x-auto">
                            <span class="text-lg font-semibold text-black">Guderm Bee Farm</span>
                            <span class="text-lg text-gray-400">Guderm Bee Farm</span>
                            <span class="text-lg text-gray-400">Guderm Bee Farm</span>
                            <span class="text-lg text-gray-400">Guderm Bee Farm</span>
                        </div>
                    <button class="text-2xl font-bold text-gray-700 px-3 hover:text-black">&gt;</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>