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
@if(Session::get('failed'))
    <div class="bg-red-500 text-white p-2">
        {{ Session::get('failed') }}
    </div>
    @endif
    @if(Session::get('success'))
    <div class="bg-green-500 text-white p-2">
        {{ Session::get('success') }}
    </div>
    @endif
<div class="flex flex-col items-center justify-center h-screen">
    <div class="flex bg-white w-2/3 shadow-lg rounded-lg">
        <div class="flex flex-col w-1/2 p-6 justify-start">
            <div class="px-3 py-6 sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto size-24 mt-16" src="{{ asset('assets/logo.png') }}" alt="Your Company">
                <h2 class="mt-5 text-center text-2xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
            </div>

            <div class=" sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                        </div>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-indigo-600">Sign in</button>
                    </div>
                </form>

                <p class="mt-5 text-center text-sm text-gray-500">
                    Not a member?
                    <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Start a 14 day free trial</a>
                </p>
            </div>
        </div>
        <div class="h-full w-1/2 p-3 rounded-sm flex items-center justify-center">
            <img src="{{ asset('assets/login.png') }}" alt="" class="max-w-full h-auto rounded-md">
        </div>
    </div>
</div>
</body>
</html>
