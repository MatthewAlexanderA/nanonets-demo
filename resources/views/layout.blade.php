<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
        <title>Solusi Aplikasi Integrasi</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
        <!-- Link Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Header -->
    <header>
        <nav class="w-full">
            <div class="header bg-blue py-4 relative z-10 flex items-center px-6">
                <button id="menuButton" class="text-white text-xl focus:outline-none mr-5">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <a href="/"><img class="w-32" src="assets/images/nanonets.png" alt=""></a>
                </div>
            </div>

            <div
                class="sidebar fixed inset-y-0 left-0 z-0 w-72 bg-white border-r border-gray-300 text-white p-4 transform -translate-x-full transition duration-300 ease-in-out">
                <a href="#">
                    <div class="text-black mt-20 p-3 first-line:rounded-md font-bold hover:shadow-md @yield('invoice')">
                        <i class="fa-solid fa-file-invoice text-blue text-2xl pr-5"></i> 
                        Invoices
                    </div>
                </a>
                <a href="#">
                    <div class="text-black p-3 mt-1 first-line:rounded-md font-bold hover:shadow-md @yield('receipt')">
                        <i class="fa-solid fa-receipt text-blue text-2xl pr-5"></i> 
                        Receipt
                    </div>
                </a>
                <a href="#">
                    <div class="text-black p-3 mt-1 first-line:rounded-md font-bold hover:shadow-md @yield('faktur')">
                        <i class="fa-solid fa-file-invoice-dollar text-blue text-2xl pr-5"></i> 
                        Faktur Pajak
                    </div>
                </a>
                <a href="#">
                    <div class="text-black p-3 mt-1 first-line:rounded-md font-bold hover:shadow-md @yield('ktp')">
                        <i class="fa-solid fa-id-card text-blue text-2xl pr-3"></i> 
                        KTP
                    </div>
                </a>
                <a href="#">
                    <div class="text-black p-3 mt-1 first-line:rounded-md font-bold hover:shadow-md @yield('stnk')">
                        <i class="fa-solid fa-file-powerpoint text-blue text-2xl pr-5"></i> 
                        STNK
                    </div>
                </a>
                <a href="#">
                    <div class="text-black p-3 mt-1 first-line:rounded-md font-bold hover:shadow-md @yield('bpkb')">
                        <i class="fa-solid fa-file-lines text-blue text-2xl pr-5"></i> 
                        BPKB
                    </div>
                </a>
                <a href="#">
                    <div class="text-black p-3 mt-1 first-line:rounded-md font-bold hover:shadow-md @yield('bank')">
                        <i class="fa-solid fa-file text-blue text-2xl pr-5"></i> 
                        Bank Statement
                    </div>
                </a>
                <a href="#">
                    <div class="text-black p-3 mt-1 first-line:rounded-md font-bold hover:shadow-md @yield('npwp')">
                        <i class="fa-solid fa-id-card-clip text-blue text-2xl pr-3"></i> 
                        NPWP
                    </div>
                </a>
                <a href="#">
                    <div class="text-black p-3 mt-1 first-line:rounded-md font-bold hover:shadow-md @yield('passport')">
                        <i class="fa-solid fa-passport text-blue text-2xl pr-5"></i> 
                        Passport
                    </div>
                </a>
                <a href="#">
                    <div class="text-black p-3 mt-1 first-line:rounded-md font-bold hover:shadow-md @yield('kk')">
                        <i class="fa-solid fa-file-image text-blue text-2xl pr-5"></i> 
                        Kartu Keluarga
                    </div>
                </a>
            </div>
        </nav>
    </header>

    @yield('content')

    <script>
        const menuButton = document.getElementById('menuButton');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.getElementById('mainContent'); // Tambahkan ini

        menuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            mainContent.classList.toggle('translate-x-64'); // Atur transformasi konten utama
        });

    </script>

</body>

</html>
