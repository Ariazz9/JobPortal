<x-app-layout>
    <x-slot name="header">
        <h2>Edit Lowongan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col  p-6">
                    @method('PUT')
                    @csrf
                    <label for="logo" class="mb-2 font-semibold">Judul Lowongan</label>
                    <input type="text" name="title" value="{{ $job->title }}" class="border border-gray-300 rounded p-2 mb-6">
                    <label for="logo" class="mb-2 font-semibold">Deskripsi Lowongan</label>
                    <textarea name="description" class="border border-gray-300 rounded p-2 mb-6">{{ $job->description }}"</textarea>
                    <label for="logo" class="mb-2 font-semibold">Lokasi Lowongan</label>
                    <input type="text" name="location" value="{{ $job->location }}" class="border border-gray-300 rounded p-2 mb-6">
                    <label for="logo" class="mb-2 font-semibold">Nama Perusahaan</label>
                    <input type="text" name="company" value="{{ $job->company }}" class="border border-gray-300 rounded p-2 mb-6">
                    <label for="logo" class="mb-2 font-semibold">Gaji Pekerjaan</label>
                    <input type="number" name="salary" value="{{ $job->salary }}" class="border border-gray-300 rounded p-2 mb-6">
                    <label for="logo" class="mb-2 font-semibold">Logo Perusahaan</label>
                    <input type="file" name="logo" id="logo" class="border border-gray-300 rounded p-2 mb-2">
                    <p class="text-sm text-gray-500 mb-6">Unggah logo perusahaan dalam format .jpg, .png, atau .jpeg</p>
                    <div class="mb-2">
                    <label for="jenis_pekerjaan" class="block mb-2 font-semibold">Jenis Pekerjaan</label>
                    <select name="jenis_pekerjaan" class="form-control">
                        <option value="Full-time" {{ $job->jenis_pekerjaan == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ $job->jenis_pekerjaan == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    </select>
                    </div>
                    <div class="mt-6 flex justify-start space-x-3">
                        <x-secondary-button type="submit">
                            {{ __('Simpan') }}
                        </x-secondary-button>

                        <x-danger-button type="button" onclick="window.history.back()" class="ml-3">
                            {{ __('Batal') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
