@extends('layout.index')

@section('content')
@if(Session::get('success'))
    <div class="bg-green-500 text-white p-2">
        {{ Session::get('success') }}
    </div>
@endif
@if(Session::get('failed'))
    <div class="bg-red-500 text-white p-2">
        {{ Session::get('failed') }}
    </div>
@endif
<div class="flex justify-center w-full mb-9">
    <img src="{{ asset('assets/ssiwhite.png') }}" class="size-1/4 mt-9 mb-4 rounded-full" alt="SSI Logo">
</div>
<div class="flex flex-col items-center w-full">
    <img src="{{ asset('assets/top.png') }}" class="size-1/12 mb-2">
    <h1 class=" text-center text-3xl w-6/12 tinos-bold font-bold yellow">THE OFFICIAL STUDIO SENI INDONESIA WEBSITE, TRADITIONAL SHOW AND TRAINING</h1>
    <img src="{{ asset('assets/bottom.png') }}" class="size-1/12 mt-2">
    <button class="px-6 py-3 text-white font-medium bg-red-500 rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-200 mt-10">
        <a href="{{route('costume.gallery')}}">Gallery Costume</a>
      </button>
</div>
{{-- <div class="flex justify-between w-full ">
    <div class="flex flex-col w-1/2">
        <h2>Start Your Journey</h2>
        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nam assumenda odio corrupti adipisci nemo culpa. Officia veritatis aspernatur nostrum harum et aliquid, fugiat est dolorem debitis possimus corrupti autem!</p>
    </div> --}}
    {{-- <div>
        <img src="{{ asset('assets/isi.jpg') }}" class="size-1/4">
    </div> --}}
{{-- </div> --}}

@endsection
