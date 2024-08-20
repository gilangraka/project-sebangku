<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button class="btn btn-neutral text-white mb-6" onclick="tambah_modal.showModal()">
                        Tambah Produk
                    </button>
                    <div class="overflow-x-auto">
                        <table id="produk-table" class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $key => $value)
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
                                        <td>
                                            <div class="flex gap-2 items-center">
                                                <button class="btn btn-sm"
                                                    onclick="openEditModal({{ $value->id }})"><i
                                                        data-feather="edit"></i></button>
                                                <button class="btn btn-sm"
                                                    onclick="openHapusModal({{ $value->id }})"><i
                                                        data-feather="trash-2"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="flex justify-between items-center mt-4">
                            <div>
                                Showing {{ $produk->firstItem() }} to {{ $produk->lastItem() }} of
                                {{ $produk->total() }} entries
                            </div>
                            <div>
                                {{ $produk->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('manage-produk.modal')
</x-app-layout>
