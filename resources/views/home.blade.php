@extends('layout')

@section('content')
    
    <!-- Main -->
    <section id="Main">
        <div class="lg:px-28 px-10 pt-10">
            <div class="grid lg:grid-cols-4 lg:gap-12 grid-cols-1 gap-y-4 text-center">
                <a href="/invoice">
                    <div class="bg-indigo-600 p-5 font-bold rounded-lg shadow-lg text-white hover:shadow-none hover:bg-white hover:text-indigo-600 border-4 border-indigo-600 duration-150 ease-in">
                        <i class="fa-solid fa-file-invoice text-5xl"></i> <br>
                        <div class="text-3xl pt-3"> Invoices</div>
                    </div>
                </a>
                <a href="/receipt">
                    <div class="bg-indigo-600 p-5 font-bold rounded-lg shadow-lg text-white hover:shadow-none hover:bg-white hover:text-indigo-600 border-4 border-indigo-600 duration-150 ease-in">
                        <i class="fa-solid fa-receipt text-5xl"></i> <br>
                        <div class="text-3xl pt-3"> Receipt</div>
                    </div>
                </a>
                <a href="faktur-pajak">
                    <div class="bg-indigo-600 p-5 font-bold rounded-lg shadow-lg text-white hover:shadow-none hover:bg-white hover:text-indigo-600 border-4 border-indigo-600 duration-150 ease-in">
                        <i class="fa-solid fa-file-invoice-dollar text-5xl"></i> <br>
                        <div class="text-3xl pt-3"> Faktur Pajak</div>
                    </div>
                </a>
                <a href="/ktp">
                    <div class="bg-indigo-600 p-5 font-bold rounded-lg shadow-lg text-white hover:shadow-none hover:bg-white hover:text-indigo-600 border-4 border-indigo-600 duration-150 ease-in">
                        <i class="fa-solid fa-id-card text-5xl"></i> <br>
                        <div class="text-3xl pt-3"> KTP</div>
                    </div>
                </a>
                <a href="/stnk">
                    <div class="bg-indigo-600 p-5 font-bold rounded-lg shadow-lg text-white hover:shadow-none hover:bg-white hover:text-indigo-600 border-4 border-indigo-600 duration-150 ease-in">
                        <i class="fa-solid fa-file-powerpoint text-5xl"></i> <br>
                        <div class="text-3xl pt-3"> STNK</div>
                    </div>
                </a>
                <a href="/bpkb">
                    <div class="bg-indigo-600 p-5 font-bold rounded-lg shadow-lg text-white hover:shadow-none hover:bg-white hover:text-indigo-600 border-4 border-indigo-600 duration-150 ease-in">
                        <i class="fa-solid fa-file-lines text-5xl"></i> <br>
                        <div class="text-3xl pt-3"> BPKB</div>
                    </div>
                </a>
                <a href="/bank-statement">
                    <div class="bg-indigo-600 p-5 font-bold rounded-lg shadow-lg text-white hover:shadow-none hover:bg-white hover:text-indigo-600 border-4 border-indigo-600 duration-150 ease-in">
                        <i class="fa-solid fa-file text-5xl"></i> <br>
                        <div class="text-3xl pt-3"> Bank Statement</div>
                    </div>
                </a>
                <a href="/npwp">
                    <div class="bg-indigo-600 p-5 font-bold rounded-lg shadow-lg text-white hover:shadow-none hover:bg-white hover:text-indigo-600 border-4 border-indigo-600 duration-150 ease-in">
                        <i class="fa-solid fa-id-card-clip text-5xl"></i> <br>
                        <div class="text-3xl pt-3"> NPWP</div>
                    </div>
                </a>
                {{-- <div class="lg:block hidden"></div> --}}
                <a href="/passport">
                    <div class="bg-indigo-600 p-5 font-bold rounded-lg shadow-lg text-white hover:shadow-none hover:bg-white hover:text-indigo-600 border-4 border-indigo-600 duration-150 ease-in">
                        <i class="fa-solid fa-passport text-5xl"></i> <br>
                        <div class="text-3xl pt-3"> Passport</div>
                    </div>
                </a>
                <a href="/kartu-keluarga">
                    <div class="bg-indigo-600 p-5 font-bold rounded-lg shadow-lg text-white hover:shadow-none hover:bg-white hover:text-indigo-600 border-4 border-indigo-600 duration-150 ease-in">
                        <i class="fa-solid fa-file-image text-5xl"></i> <br>
                        <div class="text-3xl pt-3"> Kartu Keluarga</div>
                    </div>
                </a>
            </div>
        </div>
    </section>

@endsection