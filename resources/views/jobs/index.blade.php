<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Daftar Lowongan
            </h2>
            @if(auth()->user()->role == 'admin')
            <div class="item-end">
                <p class="text-sm font-medium text-gray-900 item-end">Import data Lowongan</p>
                <form action="/jobs/import" method="POST" enctype="multipart/form-data" class="mt-1 item-end">
                    @csrf
                    <input type="file" name="file" required>
                    <br>
                    <button type="submit" class="item-end text-white px-5 py-1 rounded text-xs" style="background-color: #0a3d62;">Import Lowongan</button>
                </form>
                <a href="{{ route('jobs.create') }}" class="item-end text-white px-5 py-1 rounded text-xs" style="background-color: #0a3d62;">
                Tambah Lowongan
                </a>
                <br>
                <a href="{{ route('jobs.template') }}" class="item-end text-white px-5 py-1 rounded text-xs" style="background-color: #0a3d62;">
                    Download Template Import
                </a>
            </div>
            @endif
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-500 text-sm">
                        <thead class="bg-gray-100">
                            
                            <tr>
                                <th class="border px-4 py-2 text-left">Judul</th>
                                <th class="border px-4 py-2 text-left">Perusahaan</th>
                                <th class="border px-4 py-2 text-left">Lokasi</th>
                                <th class="border px-4 py-2 text-left">Gaji</th>
                                <th class="border px-4 py-2 text-left">Logo</th>
                                <th class="border px-4 py-2 text-left">Jenis Pekerjaan</th>
                                <th class="border px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="border px-4 py-2">{{ $job->title }}</td>
                                    <td class="border px-4 py-2">{{ $job->company }}</td>
                                    <td class="border px-4 py-2">{{ $job->location }}</td>
                                    <td class="border px-4 py-2">{{ $job->salary }}</td>
                                    <td class="border px-4 py-2">
                                        @if ($job->logo)
                                            <img src="{{ asset('storage/' . $job->logo) }}" alt="Logo" width="70" class="rounded">
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">{{ $job->jenis_pekerjaan }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex justify-center space-x-2 gap-4">
                                            @if(auth()->user()->role == 'admin')
                                                <a href="{{ route('jobs.edit', $job->id) }}" 
                                                class="text-white px-5 py-1 rounded text-xs"style="background-color: #0a3d62;">Edit</a>
                                                
                                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Hapus data?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs">Hapus</button>
                                                </form>
                                                <a href="{{ route('applications.index', $job->id) }}" 
                                                class="text-white px-5 py-1 rounded text-xs"style="background-color: #0a3d62;">Lihat pelamar</a>

                                            @elseif(auth()->user()->role == 'user')
                                                <a href="{{ route('jobs.show', $job->id) }}" class="text-white px-5 py-1 rounded text-xs"style="background-color: #0a3d62;">
                                                    Lihat Detail
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($jobs->isEmpty())
                    <p class="text-gray-500 text-center mt-4">Belum ada lowongan tersedia.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
