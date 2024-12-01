@extends('layout.index')
@section('content')
<div class="container flex justify-center h-full w-full mb-5 mt-5">
    <div class="w-1/2 rounded overflow-hidden shadow-lg mt-5 ms-5 p-6 bg-white">
        <form action="{{ route('costume.form.update', $costumeId['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            @if(Session::get('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ Session::get('success') }}
            </div>
            @endif

            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Images</label>
                    <input type="file" value="{{$costumeId['image']}}" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                </div>
                <div class="col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                    <input type="text" value="{{$costumeId['name']}}" name="name" id ="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Nama Kostum" required>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                    <input type="number" value="{{$costumeId['price']}}" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Harga" required>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                    <input type="number" value="{{$costumeId['stock']}}" name="stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Stock" required>
                </div>
                <div class="col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Product Description</label>
                    <textarea id="description" value="{{$costumeId['description']}}" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Deskripsi" required></textarea>
                </div>
            </div>
            <button type="submit" class="text-white inline-flex items-center bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                + Edit
            </button>
        </form>
    </div>
</div>
@endsection
