<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col gap-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h5 class="mb-3 text-xs">JUMLAH PRODUK</h5>
                            <p class="text-lg font-bold text-indigo-500">{{ $data['jml_produk'] }} PRODUK</p>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h5 class="mb-3 text-xs">JUMLAH USER</h5>
                            <p class="text-lg font-bold text-indigo-500">{{ $data['jml_user'] }} USER</p>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h5 class="mb-3 text-xs">JUMLAH PRODUK AKTIF</h5>
                            <p class="text-lg font-bold text-indigo-500">{{ $data['jml_produk_aktif'] }} PRODUK AKTIF
                            </p>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h5 class="mb-3 text-xs">JUMLAH USER AKTIF</h5>
                            <p class="text-lg font-bold text-indigo-500">{{ $data['jml_user_aktif'] }} USER AKTIF</p>
                        </div>
                    </div>
                </div>


                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h5 class="font-bold mb-4">Data Produk Terbaru</h5>
                        <div class="overflow-x-auto">
                            <table class="table">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['data_produk'] as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <div class="flex items-center gap-3">
                                                    <div class="avatar">
                                                        <div class="mask mask-squircle h-12 w-12">
                                                            <img src="{{ asset('gambar_produk/' . $value->gambar_produk) }}"
                                                                alt="Gambar Produk" />
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold">{{ $value->nama }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-ghost badge-md">Rp.
                                                    {{ number_format($value->harga, 0, ',', '.') }}</span>
                                            </td>
                                            <td>
                                                <div class="flex gap-2 items-center">
                                                    <div
                                                        class="w-4 h-4 bg-{{ $value->status->style }}-200 rounded-full flex items-center justify-center">
                                                        <div
                                                            class="w-2 h-2 bg-{{ $value->status->style }}-500 rounded-full">
                                                        </div>
                                                    </div>
                                                    <span>{{ $value->status->nama_status }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
