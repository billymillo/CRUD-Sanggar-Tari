@extends('layout.index')
@section('content')
<div class="flex items-center justify-center mt-10">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4 text-center">Customer Keranjang Form</h2>
        <form action="{{ route('order.keranjang') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="name_customer">Nama Pemesan</label>
                <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name_customer') border-red-500 @enderror" type="text" id="name_customer" name="name_customer" placeholder="Masukkan Nama Customer" value="{{ old('name_customer') }}"/>
                @error('name_customer')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="quantity">Kostum</label>
                <div id="costumes-container">
                    @if (isset($dataCostume))
                        @foreach ($dataCostume['costumes'] as $key => $medicine)
                            <div class="flex items-center mb-2" id="costumes-{{ $key }}">
                                <select name="costumes[]" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('costumes.*') border-red-500 @enderror">
                                    <option disabled selected hidden>PILIH</option>
                                    @foreach ($costumes as $itemData)
                                        @if ($itemData['stock'] > 0)
                                            <option value="{{ $itemData->id }}"> {{ $itemData->name }} (Price: Rp. {{ number_format($itemData->price, 0, ',', '.') }}) (Stock: {{ $itemData->stock }})</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($key > 0)
                                    <div>
                                        <span style="cursor: pointer" class="text-red-500 p-2" onclick="deleteSelect('costumes-{{ $key }}')">X</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="flex items-center mb-2" id="costumes-1">
                            <select name="costumes[]" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('costumes.*') border-red-500 @enderror">
                                <option disabled selected hidden>PILIH</option>
                                @foreach ($costumes as $itemData)
                                    @if ($itemData['stock'] > 0)
                                        <option value="{{ $itemData->id }}"> {{ $itemData->name }} (Price: Rp. {{ number_format($itemData->price, 0, ',', '.') }}) (Stock: {{ $itemData->stock }})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
                <p style="cursor: pointer" class="text-blue-500 hover:underline" id="add-select">+ Tambah Kostum</p>
            </div>
            <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out" type="submit">Pesan</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let no = {{ isset($dataCostume) ? count($dataCostume['costumes']) : 1 }}; // Start from the current count of costumes

 $('#add-select').on('click', function () {
        let html = `
        <div class="flex items-center mb-2" id="costumes-${no}">
            <select name="costumes[]" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option disabled selected hidden>PILIH</option>
                @foreach ($costumes as $itemData)
                    @if ($itemData['stock'] > 0)
                        <option value="{{ $itemData->id }}"> {{ $itemData->name }} (Price: Rp. {{ number_format($itemData->price, 0, ',', '.') }}) (Stock: {{ $itemData->stock }})</option>
                    @endif
                @endforeach
            </select>
            <div>
                <span style="cursor: pointer" class="text-red-500 p-2" onclick="deleteSelect('costumes-${no}')">X</span>
            </div>
        </div>`;
        $('#costumes-container').append(html);
        no++;
    });

    function deleteSelect(id) {
        $(`#${id}`).remove();
        no--;
    }
</script>
@endsection
