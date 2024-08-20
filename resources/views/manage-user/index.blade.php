<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table id="users-table" class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th>Nomor Telepon</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($normal_user as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <div class="font-bold">{{ $value->name }}</div>
                                        </td>
                                        <td>
                                            <span>
                                                {{ $value->email }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-ghost badge-md">
                                                {{ $value->nomor_telepon }}
                                            </span>
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
                                            @if ($value->status->id == 1)
                                                <form method="POST"
                                                    action="{{ route('manage-user.update', $value->id) }}">
                                                    @csrf
                                                    @method('PUT')

                                                    <button class="btn btn-neutral">Approve</button>
                                                </form>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="flex justify-between items-center mt-4">
                            <div>
                                Showing {{ $normal_user->firstItem() }} to {{ $normal_user->lastItem() }} of
                                {{ $normal_user->total() }} entries
                            </div>
                            <div>
                                {{ $normal_user->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
