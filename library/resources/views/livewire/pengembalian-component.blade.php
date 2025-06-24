<div>
    <div class="card">
        <div class="card-header">
            Kelola Pengembalian
        </div>
        @if (@session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <input type="text" wire:model.live="cari" class="form-control w-50" placeholder="Cari...">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Id Peminjaman</th>
                            <th scope="col">Tanggal_pengembalian</th>
                            <th scope="col">Denda</th>
                            <th>Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengembalian as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->pinjam->id }}</td>
                                <td>{{ $data->tgl_kembali }}</td>
                                <td>{{ $data->denda }}</td>
                                <td>
                                    <a href="#" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-info"
                                        data-toggle="modal" data-target="#editPage">Ubah</a>
                                    <a href="#" wire:click="confirm({{ $data->id }})"
                                        class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#deletePage">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pengembalian->links() }}
            </div>
            <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addPage">Tambah</a>
        </div>
    </div>
    {{-- Tambah --}}
    <div wire:ignore.self class="modal fade" id="addPage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                                <label for="">Id Peminjaman</label>
                                <select wire:model='pinjam_id' class="form-control">
                                    <option value="">---Pilih---</option>
                                    @foreach ($pinjam as $item)
                                        <option value="{{ $item->id }}">{{ $item->id }}</option>
                                    @endforeach
                                </select>
                                @error('pinjam_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        <div class="form-group">
                            <label for="">Tanggal_pengembalian</label>
                            <input type="date" class="form-control" wire:model="tgl_kembali"
                                value="{{ @old('tgl_kembali') }}">
                            @error('tgl_kembali')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Denda</label>
                            <input type="text" class="form-control" wire:model="denda" value="{{ @old('denda') }}">
                            @error('denda')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="store" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit --}}
    <div wire:ignore.self class="modal fade" id="editPage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <form>
                            <div class="form-group">
                                <label for="">Id Peminjaman</label>
                                <select wire:model='pinjam_id' class="form-control">
                                    <option value="">---Pilih---</option>
                                    @foreach ($pinjam as $item)
                                        <option value="{{ $item->id }}">{{ $item->id }}</option>
                                    @endforeach
                                </select>
                                @error('pinjam_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal_pengembalian</label>
                                <input type="date" class="form-control" wire:model="tgl_kembali"
                                    value="{{ @old('tgl_kembali') }}">
                                @error('tgl_kembali')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Denda</label>
                                <input type="text" class="form-control" wire:model="denda"
                                    value="{{ @old('denda') }}">
                                @error('denda')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="update" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- DeletePage --}}
    <div wire:ignore.self class="modal fade" id="deletePage" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin hapus data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="destroy" class="btn btn-primary"
                        data-dismiss="modal">Ya</button>
                </div>
            </div>
        </div>
    </div>

</div>
