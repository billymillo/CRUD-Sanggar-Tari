@extends('layout.index')
@section('content')
    <div class="container mx-auto flex flex-col">
        @if(Session::get('success'))
        <div class="bg-green-500 text-white p-2">
            {{ Session::get('success') }}
        </div>
        @endif

        <div class="flex justify-end w-full">
             <form class="w-1/3 mt-5 me-4" action="{{ route('costume.gallery')}}" role="search" method="GET">
                 <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                 <div class="relative">
                     <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                         <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                         </svg>
                     </div>
                     <input type="text" name="search_costume" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Costume" required />
                     <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                 </div>
             </form>
             @if(Auth::user()->role == 'admin')
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-5 me-16">
                <a href="{{route('costume.form')}}">+ Tambah Kostum</a>
            </button>
            @endif
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($costume as $data)
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white mt-5 mb-5 ms-16 p-2">
                <img class="h-96 w-full object-cover rounded-md" src="/images/{{ $data['image']}}" alt="">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-1">{{ $data['name']}}</div>
                    <div class="font-bold text-l mb-2">Rp. {{ number_format($data['price'], 0, ',', '.')}}</div>
                    <p class="text-gray-700 text-base">{{ $data['stock']}} pcs</p>
                    <p class="text-gray-700 text-base">{{ $data['description']}}</p>
                </div>
                <div class="px-6 pb-2 flex flex-row justify-between">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Pesan
                    </button>
                @if(Auth::user()->role == 'admin')
                <div class="flex flex-row justify-end">
                    <a href="{{ route('costume.form.edit', $data['id']) }}">
                        <i class="fa-duotone fa-solid fa-square-pen text-2xl text-blue-700"></i>
                        </a>
                        <a href="#" data-modal-target="popup-modal" data-modal-toggle="popup-modal" onclick="deleteCostume('{{ $data->id }}', '{{ $data->name }}')" class="btn btn-danger">
                        <i class="fa-duotone fa-solid fa-trash-can text-2xl ms-2 text-red-700"></i>
                        </a>
                    </div>
                @endif
                </div>
            </div>
            @endforeach
        </div>

    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <form method="POST" action="{{ route('costume.delete', $data->id) }}">
            @csrf
            @method('DELETE')
        <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this <span id="costume-name"></span>?</h3>
                    <button data-modal-hide="popup-modal" type="submit" id="confirm-delete" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </div>
            </div>
        </div>
    </form>
    </div>

    </div>
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
    function deleteCostume(id, name) {
        // Generate the delete URL dynamically
        let urlDelete = "{{ route('costume.delete', ':id') }}".replace(':id', id);

        // Update the form action
        $("#form-delete-costume").attr('action', urlDelete);

        // Populate the costume name in the modal
        $('#costume-name').text(name);

        // Show the modal (Tailwind)
        $('#popup-modal').removeClass('hidden'); // Ensure it's visible
        $('#popup-modal').addClass('flex');
    }


    </script>
    @endpush
@endsection

