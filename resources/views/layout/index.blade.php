<!doctype html>
<html>
<head>
    <title>Studio Seni Indonesia</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <link rel="icon" type="image/x-icon" href="{{asset('assets/logo.ico')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Oldenburg&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Oldenburg&family=Outfit:wght@100..900&family=Tinos:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
</head>
<body>
    <style>
        body {
            background-color: black;
            background-image: url('../assets/batik.png'); /* Adjust the path as necessary */
            background-size: cover; /* Cover the entire element */
            background-repeat: no-repeat; /* Prevent the image from repeating */
            background-position: center; /* Center the image */
            min-height: 100vh; /* Set the minimum height to full viewport height */
        }
        nav {
            background-color: rgba(255, 255, 255, 0.5); /* White with 50% opacity */
            backdrop-filter: blur(10px); /* Apply blur effect */
        }

        .oldenburg-regular {
            font-family: "Oldenburg", serif;
            font-weight: 400;
            font-style: normal;
        }

        .tinos-regular {
          font-family: "Tinos", serif;
          font-weight: 400;
          font-style: normal;
        }

        .tinos-bold {
          font-family: "Tinos", serif;
          font-weight: 700;
          font-style: normal;
        }

        .tinos-regular-italic {
          font-family: "Tinos", serif;
          font-weight: 400;
          font-style: italic;
        }

        .tinos-bold-italic {
          font-family: "Tinos", serif;
          font-weight: 700;
          font-style: italic;
        }

        .yellow {
            color: rgb(242, 190, 95);
        }

    </style>
    @if(Auth::check())
    <nav class="flex justify-between align-middle w-full h-20 oldenburg-regular shadow hover:shadow-lg bg-white">
        <img src="{{ asset('assets/logo.png') }}" alt="" class="size-14 mt-3 ms-10">
        <div class="flex flex-row ms-24">
            <a href="{{route('landingpage')}}" class="px-4 py-2 mt-5">Home</a>
            <a href="{{route('costume.gallery')}}" class="px-4 py-2 mt-5">Gallery</a>
            @if (Auth::user()->role == 'admin')
            <a href="{{route('user.table')}}" class="px-4 py-2 mt-5">Akun</a>
            @endif
            <a href="{{route('logout')}}" class="px-4 py-2 mt-5 {{Route::is('logout') ? 'activate' : ''}}">Logout</a>
        </div>
        <div class="flex flex-col">
            <p class="px-4 mt-5 me-5">Nama : <span class="text-red-700">{{ Auth::user()->name }}</span></p>
            <p class="px-4">Role : <span class="text-green-400">{{ Auth::user()->role }}</span></p>
        </div>
    </nav>
    @endif
    @yield('content')
</body>
</html>
