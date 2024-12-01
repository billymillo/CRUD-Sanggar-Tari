@extends('layout.index')
@section('content')
<div class="container flex justify-center h-full w-full mb-5 mt-5">
    <div class="w-1/2 rounded overflow-hidden shadow-lg bg-white mt-5 ms-5 p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Tambah Akun</h2>
        <form class="flex flex-col" action="{{ route('user.form.update', $userId['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            @if(Session::get('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ Session::get('success') }}
            </div>
            @endif

                <label for="name" class="mb-2 text-gray-700 font-semibold">Name</label>
                    <input type="text" value="{{$userId['name']}}" id="name" name="name" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                <label for="email" class="mb-2 text-gray-700 font-semibold">Email</label>
                    <input type="text" value="{{$userId['email']}}" id="email" name="email" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                <label for="role" class="mb-2 text-gray-700 font-semibold">Role</label>
                    <select id="role" name="role" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pengelola" {{ old('role') == 'pengelola' ? 'selected' : '' }}>Pengelola</option>
                        <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : ''   }}>Siswa</option>
                    </select>
                <label for="password" class="mb-2 text-gray-700 font-semibold">Password</label>
                    <input type="password" id="password" name="password" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" >
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500 mt-4">
                    Edit Akun
                </button>
        </form>
    </div>
</div>
@endsection
