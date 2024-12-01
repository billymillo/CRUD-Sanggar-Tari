@extends('layout.index')
@section('content')

@if(Session::get('success'))
<div class="bg-green-500 text-white p-2">
    {{ Session::get('success') }}
</div>
@endif
<div class="flex justify-end w-full">
    <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-5 me-5">
        <a href="{{route('user.form')}}">+ Tambah Akun</a>
    </button>
</div>
<div class="flex justify-center">
    <div class="relative overflow-x-auto shadow-md rounded-lg w-2/3 mt-9">
        <table class="w-full rounded-lg text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="bg-red-500 text-white">
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Role
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">()</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-yellow-100 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user['name'] }}
                </th>
                <td class="px-6 py-4">
                    {{ $user['email'] }}
                </td>
                <td class="px-6 py-4">
                    {{ $user['role'] }}
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('user.form.edit', $user['id']) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline me-2">
                        <i class="fa-duotone fa-solid fa-square-pen text-2xl text-blue-700"></i>
                    </a>
                    <a href="#" data-modal-target="popup-modal" data-modal-toggle="popup-modal" onclick="deleteAkun('{{ $user->id }}', '{{ $user->name }}')" class="btn btn-danger">
                        <i class="fa-duotone fa-solid fa-trash-can text-2xl ms-2 text-red-700"></i>
                        </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <form method="POST" action="{{ route('user.delete', $user->id) }}">
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
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this <span id="user-name"></span>?</h3>
                <button data-modal-hide="popup-modal" type="submit" id="confirm-delete" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</form>
</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
    function deleteUser(id, name) {
        // Generate the delete URL dynamically
        let urlDelete = "{{ route('user.delete', ':id') }}".replace(':id', id);

        // Update the form action
        $("#form-delete-user").attr('action', urlDelete);

        // Populate the costume name in the modal
        $('#user-name').text(name);

        // Show the modal (Tailwind)
        $('#popup-modal').removeClass('hidden'); // Ensure it's visible
        $('#popup-modal').addClass('flex');
    }
    </script>
    @endpush

@endsection
