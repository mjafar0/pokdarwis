@extends('layouts.galleryLayout')



@section('banner')
  <!-- ***Inner Banner html start form here*** -->
  <div class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image:url('{{ asset('assets/images/guruntelagabiru.jpg') }}');">
      <div class="container">
        <div class="inner-banner-content text-center text-white">
          <h1 class="page-title">Gallery</h1>
          <p class="mb-0">Beautiful Bintan</p>
        </div>
      </div>
    </div>
  </div>
  <!-- ***Inner Banner html end here*** -->
@endsection

@section('main')
    <x-gallery-card :items="
        [
            ['src' => 'assets/images/guruntelagabiru.jpg','alt'=>'Pantai'],
            ['src' => 'assets/images/img11.jpg','alt'=>'Gunung'],
            ['src' => 'assets/images/img12.jpg','alt'=>'Hutan'],
            ['src' => 'assets/images/img13.jpg','alt'=>'Danau'],
        ]" gallery="wisata-gallery" class="my-5" 
    />
@endsection
















{{-- <x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            
            <h1 class="font-bold text-3xl italic mb-2">Bintan Gallery!</h1>
            <p class="text-gray-500">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
        </h2>
  </x-slot>

  <div class="py-12">
        
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
</x-app-layout> --}}