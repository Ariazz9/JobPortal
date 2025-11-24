<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pelamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between mb-6">
                        <p class="text-lg font-medium text-gray-700">
                            Kelola daftar pelamar yang tersedia.
                        </p>
                        <a href="{{ route('applications.export', $jobId) }}"
                        class="text-white px-3 py-1 rounded text-xs"style="background-color: #0a3d62;">
                        Export ke Excel
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-500 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Nama Pelamar
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Lowongan
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">
                                        CV
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Status
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="w-full border divide-y divide-gray-200">
                                @forelse($applications as $app)
                                    <tr class="w-full">
                                        <td class="px-4 py-3 text-center text-sm text-gray-700">
                                            {{ $app->user->name }}
                                        </td>

                                        <td class="px-4 py-3 text-center text-sm text-gray-700">
                                            {{ $app->job->title }}
                                        </td>

                                        <td class="px-4 py-3 text-center text-sm text-gray-700">
                                            <a href="{{ asset('storage/' . $app->cv) }}"
                                               target="_blank"
                                               class="text-white px-3 py-1 rounded text-xs"style="background-color: #0a3d62;">
                                                Lihat CV
                                            </a>
                                            <a href="{{ asset('storage/' . $app->cv) }}"
                                                target="_blank"
                                                download 
                                                class="ml-2 text-white px-3 py-1 rounded text-xs"style="background-color: #0a3d62;">
                                                Download CV 
                                            </a>
                                        </td>

                                        <td class="px-4 py-3 text-center text-sm text-gray-700">
                                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium
                                                @if($app->status === 'Pending')
                                                    bg-yellow-100 text-yellow-700
                                                @elseif($app->status === 'Accepted')
                                                    bg-green-100 text-green-700
                                                @else
                                                    bg-red-100 text-red-700
                                                @endif">
                                                {{ $app->status }}
                                            </span>
                                        </td>
                                            <div class="flex items-center gap-2">
                                                <form action="{{ route('applications.update', $app->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="Accepted">
                                                    <td class="text-center px-2 py-3 text-sm text-gray-200 items-center">
                                                        <div class="flex items-center gap-2 text-center justify-center">
                                                            <form action="{{ route('applications.update', $app->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="Accepted">
                                                                <button type="submit"
                                                                        class="text-white px-3 py-1 rounded text-xs"style="background-color: #0a3d62;">
                                                                    Terima
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('applications.update', $app->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="Rejected">
                                                                <button type="submit"
                                                                        class="inline-flex items-center text-center rounded-md border border-transparent bg-red-600 px-3 py-1 text-xs font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                                                                    Tolak
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-4 py-6 text-center text-sm text-gray-500">
                                            Belum ada pelamar yang daftar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
