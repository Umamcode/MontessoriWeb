<div>
    <div class="card">
        <div class="card-header">
            Kelola Peminjaman
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
                            <th scope="col">User</th>
                            <th scope="col">Buku</th>
                            <th scope="col">Tgl_peminjaman</th>
                            <th scope="col">Tgl_Pengembalian</th>
                            @if(Auth::user()->jenis === 'admin')
                                <th scope="col">Status</th>
                                <th>Proses</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pinjam as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->user->nama }}</td>
                                <td>{{ $data->buku->judul }}</td>
                                <td>{{ $data->tgl_pinjam }}</td>
                                <td>{{ $data->tgl_kembali }}</td>
                                @if(Auth::user()->jenis === 'admin')
                                <td>{{ $data->status }}</td>
                                <td>
                                    <a href="#" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-info"
                                        data-toggle="modal" data-target="#editPage">Ubah</a>
                                    <a href="#" wire:click="confirm({{ $data->id }})"
                                        class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#deletePage">Hapus</a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pinjam->links() }}
            </div>
            @if(Auth::user()->jenis === 'admin')
            <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addPage">Tambah</a>
            @endif
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
                            <label for="">Nama Member</label>
                            <select wire:model='user_id' class="form-control">
                                <option value="">---Pilih---</option>
                                @foreach ($member as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('member')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">judul Buku</label>
                            <select wire:model='buku_id' class="form-control">
                                <option value="">---Pilih---</option>
                                @foreach ($buku as $item)
                                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                @endforeach
                            </select>
                            @error('buku')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" wire:model="tgl_pinjam"
                                value="{{ @old('tgl_pinjam') }}">
                            @error('tgl_pinjam')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" wire:model="tgl_kembali"
                                value="{{ @old('tgl_kembali') }}">
                            @error('tgl_kembali')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control" wire:model="status">
                                <option value="">---Pilih---</option>
                                <option value="Dipinjam">Dipinjam</option>
                                <option value="Dikembalikan">Dikembalikan</option>
                                <option value="Terlambat">Terlambat</option>
                            </select>
                            @error('status')
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
                        <div class="form-group">
                            <label for="">Nama Member</label>
                            <select wire:model='member' class="form-control">
                                <option value="">---Pilih---</option>
                                @foreach ($member as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('member')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">judul Buku</label>
                            <select wire:model='buku' class="form-control">
                                <option value="">---Pilih---</option>
                                @foreach ($buku as $item)
                                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                @endforeach
                            </select>
                            @error('buku')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" wire:model="tgl_pinjam"
                                value="{{ @old('tgl_pinjam') }}">
                            @error('tgl_pinjam')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" wire:model="tgl_kembali"
                                value="{{ @old('tgl_kembali') }}">
                            @error('tgl_kembali')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control" wire:model="status">
                                <option value="">---Pilih---</option>
                                <option value="Dipinjam">Dipinjam</option>
                                <option value="Dikembalikan">Dikembalikan</option>
                                <option value="Terlambat">Terlambat</option>
                            </select>
                            @error('status')
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
