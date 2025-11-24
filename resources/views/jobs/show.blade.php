<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Lowongan
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4 class="font-semibold text-lg mb-2">Judul Lowongan</h4>
                    <h3 class="text-2xl font-bold mb-2">{{ $job->title }}</h3>
                    <hr class="my-8">
                    <h4 class="font-semibold text-lg mb-2">Perusahaan</h4>
                    <p class="text-lg text-gray-700 mb-2">{{ $job->company }}</p>
                    <hr class="my-8">
                    <h4 class="font-semibold text-lg mb-2">Lokasi Lowongan</h4>
                    <p class="text-md text-gray-600 mb-4">{{ $job->location }}</p>
                    <hr class="my-8">
                    <h4 class="font-semibold text-lg mb-3">Jenis Pekerjaan</h4>
                    <span class="inline-flex items-center rounded-md bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700 mb-4">
                        {{ $job->jenis_pekerjaan }}
                    </span>
                    <hr class="my-8">
                    <h4 class="font-semibold text-lg mb-3">Gaji</h4>
                    <p class="text-xl font-semibold text-green-700 my-4">
                        Rp {{ number_format($job->salary, 0, ',', '.') }}
                    </p>
                    <hr class="my-8">
                    <h4 class="font-semibold text-lg mb-2">Deskripsi Lowongan</h4>
                    <div class="prose max-w-none">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                    <hr class="my-8">
                    <h4 class="font-semibold text-lg mb-2">Lamar Pekerjaan Ini</h4>
                    <form action="{{ route('apply.store', $job->id)}}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="cv" class="block text-sm font-medium text-gray-700">Upload CV (PDF, max: 2MB)</label>
                        <input type="file" name="cv" required>
                        <br>
                        <button type="submit" class="text-white px-3 py-1 rounded text-xs"style="background-color: #0a3d62;">Lamar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>