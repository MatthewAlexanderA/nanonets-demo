@extends('layout')

@section('bpkb')
shadow-lg bg-slate-50
@endsection

@section('content')

<!-- Main -->
<section id="Main">
    <h1 class="text-2xl text-blue lg:pt-6 pt-5 lg:pb-6 pb-5 font-bold px-6">Nanonets <span
            class="text-black">BPKB</span></h1>
    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 lg:gap-x-12 lg:px-10 px-5">
        <div class="">
            <form action="{{ route('extractBpkb') }}" method="post" enctype="multipart/form-data" id="extract">
                @csrf
                <label for="file-input" id="dropArea">
                    <div class="border-2 border-dashed border-gray-400 rounded-md">
                        @if (!empty($path))
                            <div dir="rtl">
                                <a href="/bpkb" class="rounded-full bg-red-500 hover:bg-red-700 text-white py-4 px-5 absolute mr-4 mt-4">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                            <div class="grid justify-items-center">
                                <div class="lg:w-full p-10 text-center">
                                    @if(strpos($path, '.pdf') !== false)
                                        <embed src="{{ $path }}" class="w-full h-[900px]" />
                                    @else
                                        <img class="w-full" src="{{ $path }}" alt="Uploaded Image" />
                                    @endif
                                </div>
                            </div>
                        @else
                            <div dir="rtl">
                                <a href="/bpkb" id="delete-btn" class="hidden rounded-full bg-red-500 hover:bg-red-700 text-white py-4 px-5 absolute mr-4 mt-4">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                            <div class="w-fill pt-10 pl-10 pr-10" id="preview"></div>
                            <div class="grid justify-items-center">
                                <div class="lg:w-[400px] p-5 text-center" id="previewTidakTersedia">
                                    <img id="blankImage" draggable="false" class="hidden" src="assets/images/file.png" class="w-full">
                                    <p class="text-center" id="fileNameDisplay"></p>
                                </div>
                                <span id="dropAreaText" class="lg:py-[180px] py-[80px] lg:px-60 block text-center">
                                    Drag and drop a file here, or click to browse
                                </span>
                            </div>
                            <input type="file" id="file-input" name="file" class="hidden"
                                onchange="handleFileChange(event)" />
                            {{-- <button id="delete-btn" class="hidden bg-red-500 text-white px-2 py-1 rounded-md mt-4">
                                Delete
                            </button> --}}
                        @endif
                    </div>
                </label>
                <div class="pt-3">
                    <button type="submit" class="bg-blue py-3 w-full rounded-md text-white font-bold disabled:bg-gray-400" @if (!empty($data)) disabled @endif>Upload</button>
                </div>
            </form>
        </div>
        <div class="border-2 border-gray-300 rounded-md mt-5 lg:mt-0">
            @if (!empty($data))
                <div class="p-3">
                    @php $no = 1; @endphp
                    @foreach ($data as $item)
                        @if ($item['label'] != 'table')
                            <div class="grid grid-cols-3 @if ($no % 2 != 0) bg-gray-100 @else bg-white @endif p-3 rounded-md shadow-md m-3">
                                <div class="font-bold grid content-evenly">{{ strtoupper(str_replace('_', ' ', $item['label'])) }} </div>
                                <div class="col-span-2 grid content-evenly">: {{ $item['ocr_text'] }}</div>
                            </div>
                            @php $no += 1; @endphp
                        @endif
                    @endforeach
                    @foreach ($data as $item)
                        @if ($item['label'] == 'table')
                        <div class="lg:p-5 p-0 mt-3" style="overflow-x: auto;">
                            <table class="border-collapse border border-slate-400">
                                <thead>
                                    <tr>
                                        @php $col = 0 @endphp
                                            @foreach ($item['cells'] as $cell)
                                            @php $row = 1 @endphp
                                            @if ($cell['row'] == 1)
                                                <th class="p-3 border border-slate-950">{{ strtoupper(str_replace('_', ' ', $cell['label'])) }}</th>
                                                @php $col += 1 @endphp
                                            @endif
                                            @if ($cell['row'] < $row)
                                                @php $row += 1 @endphp
                                            @elseif ($cell['row'] > $row )
                                                @php $col += 1 @endphp
                                            @endif
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item['cells'] as $cell)
                                        @if ($cell['col'] == 1)
                                            <tr>
                                                <td class="p-3 border border-slate-950">{{ $cell['text'] }}</td>
                                        @elseif ($cell['col'] == $col)
                                                <td class="p-3 border border-slate-950">{{ $cell['text'] }}</td>
                                            </tr>
                                        @else
                                                <td class="p-3 border border-slate-950">{{ $cell['text'] }}</td>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="grid justify-items-center pt-5 text-center">
                    <img src="assets/images/blank.jpg" alt="" class="w-1/2" id="folderImage">
                    <img src="assets/images/loading.gif" alt="" class="hidden" alt="Loading..." id="loadingImage">
                    <span id="textUpload">kindly upload file document for processing</span>
                </div>
            @endif
        </div>
    </div>
</section>

<script>
    document.getElementById('extract').addEventListener('submit', function () {
        // Show the loading GIF
        document.getElementById('folderImage').style.display = 'none';
        document.getElementById('textUpload').style.display = 'none';
        document.getElementById('loadingImage').style.display = 'inline-block';

        // You can also disable the submit button to prevent multiple submissions
        document.getElementById('submitButton').disabled = true;
    });
</script>

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
            // fileInput.disabled = true;
        }
    }

    function handleFileSelect(file) {
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const fileType = file.type;

                if (fileType === 'image/png' || fileType === 'image/jpg' || fileType === 'image/jpeg') {
                    const image = new Image();
                    image.src = e.target.result;
                    preview.innerHTML = '';
                    preview.appendChild(image);
                    deleteButton.classList.remove('hidden');
                    dropAreaText.style.display = 'none';
                } else if (fileType === 'application/pdf') {
                    const pdf = document.createElement('iframe');
                    pdf.src = e.target.result;
                    pdf.width = '100%';
                    pdf.height = '500px';
                    preview.innerHTML = '';
                    preview.appendChild(pdf);
                    deleteButton.classList.remove('hidden');
                    dropAreaText.style.display = 'none';
                    blankImage.style.display = 'none';
                } else {
                    preview.innerHTML = 'Preview tidak tersedia untuk jenis file ini.';
                    preview.classList.add('text-center');
                    document.getElementById('blankImage').classList.remove('hidden');
                    document.getElementById('blankImage').src = 'assets/images/no-images.png';
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
