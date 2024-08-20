{{-- Modal Tambah --}}
<dialog id="tambah_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Tambah Produk</h3>

        <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nama Produk</span>
                </label>
                <input type="text" name="nama" placeholder="Masukkan nama produk" class="input input-bordered" />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Harga</span>
                </label>
                <input type="number" name="harga" placeholder="Masukkan harga produk" class="input input-bordered" />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Gambar Produk</span>
                </label>
                <input type="file" name="gambar_produk" accept="image/*"
                    class="file-input file-input-bordered w-full" />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Status
                        Produk</span>
                </label>
                <select name="status_id" class="select select-bordered">
                    @foreach ($ref_status as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->nama_status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-neutral w-full">Simpan</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

{{-- Modal Edit --}}
<dialog id="edit_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Edit Produk</h3>

        <form id="edit-form" method="POST" action="{{ route('produk.update', 'ID_PLACEHOLDER') }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input id="edit_id" type="hidden" value="">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nama Produk</span>
                </label>
                <input id="edit_nama" type="text" name="nama" placeholder="Masukkan nama produk"
                    class="input input-bordered" />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Harga</span>
                </label>
                <input id="edit_harga" type="number" name="harga" placeholder="Masukkan harga produk"
                    class="input input-bordered" />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Gambar Produk</span>
                </label>
                <input type="file" name="gambar_produk" accept="image/*"
                    class="file-input file-input-bordered w-full" />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Status
                        Produk</span>
                </label>
                <select id="edit_status" name="status_id" class="select select-bordered">
                    @foreach ($ref_status as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->nama_status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-neutral w-full">Simpan</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

{{-- Modal Hapus --}}
<dialog id="hapus_modal" class="modal">
    <div class="modal-box">
        <form id="delete-form" method="POST" action="{{ route('produk.destroy', 'ID_PLACEHOLDER') }}">
            @csrf
            @method('DELETE')
            <div class="flex flex-col gap-5">
                <h1>Apakah kamu yakin ingin menghapus data?</h1>
                <div class="flex gap-2 items-center">
                    <button type="submit" class="btn btn-neutral w-1/2">Yakin</button>
                    <button type="button" class="btn w-1/2" onclick="closeModal()">Batalkan</button>
                </div>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>


<script>
    function closeModal() {
        document.getElementById('hapus_modal').close();
    }

    function openHapusModal(id_produk) {
        const form = document.getElementById('delete-form');
        const baseUrl = '{{ route('produk.destroy', '') }}';

        form.action = `${baseUrl}/${id_produk}`;
        document.getElementById('hapus_modal').showModal();
    }

    function openEditModal(id_produk) {
        const apiUrl = `/produk/${id_produk}/edit`;

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_nama').value = data.nama;
                document.getElementById('edit_harga').value = data.harga;
                const statusSelect = document.getElementById('edit_status');
                statusSelect.value = data.status_id;

                const form = document.getElementById('edit-form');
                form.action = form.action.replace('ID_PLACEHOLDER', id_produk);
                document.getElementById('edit_modal').showModal();
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
    }
</script>
