@extends('layout.index')
@section('content')
    <div class="container flex justify-center h-full w-full mb-5 mt-5">
        <div class="w-1/2 rounded overflow-hidden shadow-lg bg-white mt-5 ms-5 p-6">
            <h2 class="text-2xl font-bold mb-6 text-center">Tambah Kostum</h2>
            <form class="flex flex-col" action="{{ route('costume.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                        <label for="image" class="mb-2 text-gray-700 font-semibold">Insert Image</label>
                        <input type="file" id="image" name="image" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <label for="name" class="mb-2 text-gray-700 font-semibold">Name</label>
                            <input type="text" id="name" name="name" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <label for="price" class="mb-2 text-gray-700 font-semibold">Price</label>
                            <input type="number" id="price" name="price" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <label for="stock" class="mb-2 text-gray-700 font-semibold">Stock</label>
                            <input type="number" id="stock" name="stock" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <label for="description" class="mb-2 text-gray-700 font-semibold">Description</label>
                            <textarea type="text" id="description" name="description" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required id="to" cols="40" rows="2" class="form-control" placeholder="Input Description"></textarea>
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500 mt-4">
                            Pesan
                        </button>
            </form>
        </div>
    </div>
@endsection
