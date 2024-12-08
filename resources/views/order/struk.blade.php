@extends('layout.index')
@section('content')

<div class="flex items-center justify-center w-full h-full">
    <div class="flex flex-col justify-center items-center w-full h-screen p-6 text-white">
        <div class="flex flex-col justify-center items-center w-full">
            <div class="min-h-screen flex items-center justify-center">
                <div class="bg-gray-700 p-8 rounded-lg shadow-lg max-w-md w-full">
                     <a href="{{route('costume.download')}}">Cetak (.pdf)</a>
                  <h1 class="text-2xl font-bold mb-4 text-center">
                   QR Code Payment
                  </h1>
                  <p class=" mb-6 text-center">
                   Scan the QR code below to proceed with the payment via WhatsApp.
                  </p>
                  <div class="flex justify-center mb-6">
                   <img alt="A placeholder QR code for payment, with a text 'QR Code' in the center" class="w-48 h-48" height="200" src="{{ asset('assets/qrcode.png')}}" width="200"/>
                  </div>
                  <div class="text-center">
                   <a class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-300 inline-flex items-center" href="https://wa.me/1234567890">
                    <i class="fab fa-whatsapp mr-2">
                    </i>
                    Pay with WhatsApp
                   </a>
                  </div>
                 </div>
                </div>
        </div>
    </div>
@endsection
