@extends('layout')

@section('invoice')
shadow-lg bg-slate-50
@endsection

@section('content')

<!-- Main -->
<section id="Main">
    <h1 class="text-2xl text-blue lg:pt-6 pt-5 lg:pb-6 pb-5 font-bold px-6">Nanonets <span
            class="text-black">Invoices</span></h1>
    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 lg:gap-x-12 lg:px-10 px-5">
        <div class="">
            <form action="">
                <label for="file-input" id="dropArea">
                    <div class="border-2 border-dashed border-gray-400 rounded-md">
                        <div dir="rtl">
                            <button id="delete-btn" class="hidden rounded-full bg-red-500 hover:bg-red-700 text-white py-4 px-5 absolute -mr-3 mt-4">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                        <div class="grid justify-items-center">
                            <div class="lg:w-[400px] p-5 text-center" id="previewTidakTersedia">
                                <img id="blankImage" draggable="false" class="hidden" src="assets/images/blank.jpg" class="w-full">
                                <p class="text-center" id="fileNameDisplay"></p>
                            </div>
                            <span id="dropAreaText" class="lg:py-[200px] py-[80px] lg:px-60 block text-center">
                                Drag and drop a file here, or click to browse
                            </span>
                        </div>
                        <input type="file" id="file-input" name="file-input" class="hidden"
                            onchange="handleFileChange(event)" />
                        <div class="w-fill" id="preview"></div>
                        {{-- <button id="delete-btn" class="hidden bg-red-500 text-white px-2 py-1 rounded-md mt-4">
                            Delete
                        </button> --}}
                    </div>
                </label>
                <div class="pt-3">
                    <button type="submit" class="bg-blue py-3 w-full rounded-md text-white font-bold">Upload</button>
                </div>
            </form>
        </div>
        <div class="border-2 border-gray-300 rounded-md mt-5 lg:mt-0 text-center">
            <div class="grid justify-items-center pt-5">
                <img src="assets/images/blank.jpg" alt="" class="w-1/2">
                <span>kindly upload file document for processing</span>
            </div>
        </div>
    </div>
</section>

<script>
    const dropArea = document.getElementById('dropArea');
    const dropAreaText = document.getElementById('dropAreaText');
    const fileInput = document.getElementById('file-input');
    const preview = document.getElementById('preview');
    const deleteButton = document.getElementById('delete-btn');

    dropArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropArea.classList.add('border-blue-500');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('border-blue-500');
    });

    dropArea.addEventListener('drop', (event) => {
        event.preventDefault();
        dropArea.classList.remove('border-blue-500');
        const file = event.dataTransfer.files[0];
        fileInput.files = event.dataTransfer.files;

        handleFileSelect(file);
    });

    dropAreaText.addEventListener('dragenter', (event) => {
        event.preventDefault();
        dropAreaText.style.opacity = '0'; // Sembunyikan teks saat drag dimulai
    });

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        handleFileSelect(file);
        if (file.type === 'application/pdf') {
            const fileName = file.name; // Mendapatkan nama file
            // Tampilkan nama file di suatu elemen, contohnya dengan ID "fileNameDisplay"
            document.getElementById('fileNameDisplay').innerText = `${fileName}`;
            document.getElementById('dropAreaText').style.display = 'none';
        }
    });

    let fileUploaded = false;

    function handleFileChange(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];
        handleFileSelect(file);

        if (file.type === 'application/pdf') {
            const fileName = file.name;
            document.getElementById('fileNameDisplay').innerText = `File yang diunggah: ${fileName}`;
            fileUploaded = true;

            // Menonaktifkan input file setelah file diunggah
            fileInput.disabled = true;
        }
    }

    function handleFileSelect(file) {
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const fileType = file.type.split('/')[0];

                if (fileType === 'image') {
                    const image = new Image();
                    image.src = e.target.result;
                    preview.innerHTML = '';
                    preview.appendChild(image);
                    deleteButton.classList.remove('hidden');
                    dropAreaText.style.display = 'none';
                } else if (fileType === 'video') {
                    const video = document.createElement('video');
                    video.src = e.target.result;
                    video.controls = true;
                    preview.innerHTML = '';
                    preview.appendChild(video);
                    deleteButton.classList.remove('hidden');
                } else if (fileType === 'application/pdf') {
                    const pdf = document.createElement('iframe');
                    pdf.src = e.target.result;
                    pdf.width = '100%';
                    pdf.height = '500px';
                    preview.innerHTML = '';
                    preview.appendChild(pdf);
                    deleteButton.classList.remove('hidden');
                    dropArea.style.display = 'none';
                } else {
                    preview.innerHTML = 'Preview tidak tersedia untuk jenis file ini.';
                    preview.classList.add('text-center');
                    document.getElementById('blankImage').classList.remove('hidden');
                    document.getElementById('blankImage').src = 'assets/images/blank.jpg';
                    dropAreaText.style.display = 'none';
                    deleteButton.classList.remove('hidden');
                }
            };

            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = 'Tidak ada file yang dipilih.';
            preview.style.textAlign = 'center';
            deleteButton.classList.add('hidden');
        }
    }

    deleteButton.addEventListener('click', () => {
        preview.innerHTML = '';
        fileInput.value = '';
        deleteButton.classList.add('hidden');
        dropAreaText.style.display = 'block';
        fileInput.disabled = false;
    });

</script>

@endsection
