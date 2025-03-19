<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen px-3">
        <div class="w-full max-w-md md:p-8 p-4 space-y-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-900">Login</h2>
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('failed'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    <p>{{ session()->get('failed') }}</p>
                </div>
            @endif
            <form class="mt-8 space-y-6" action="/auth/login-process" method="POST" autocomplete="off">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="relative">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input value="{{ old('email') }}" id="email-address" name="email" type="email"
                            autocomplete="email" required
                            class="relative block w-full px-3 py-2 pl-10 border border-gray-300 rounded-t-md focus:outline-none focus:ring-[#307487] focus:border-[#307487] focus:z-10 sm:text-sm"
                            placeholder="Email address">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-envelope text-gray-400 z-40"></i>
                        </div>
                    </div>
                    <div class="relative">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="relative block w-full px-3 py-2 pl-10 pr-10 border border-gray-300 rounded-b-md focus:outline-none focus:ring-[#307487] focus:border-[#307487] sm:text-sm"
                            placeholder="Password">
                        <!-- Icon lock di sebelah kiri -->
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>

                        <!-- Icon mata di sebelah kanan -->
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <button type="button" id="togglePassword" class="focus:outline-none">
                                <i class="fas fa-eye text-gray-400"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="relative flex justify-center items-center w-full px-4 py-2 text-sm font-medium text-white bg-[#307487] border border-transparent rounded-md group hover:bg-[#307487] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#307487]">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                    </button>
                </div>
            </form>
            <div class="text-center">
                <p class="text-sm text-gray-600">Tidak punya akun?
                    <a href="/register" class="font-medium text-emeralbg-[#307487] hover:text-[#307487]">Daftar
                        disini</a>
                </p>
            </div>
        </div>
    </div>
</body>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        let passwordInput = document.getElementById('password');
        let icon = this.querySelector('i');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

</html>
