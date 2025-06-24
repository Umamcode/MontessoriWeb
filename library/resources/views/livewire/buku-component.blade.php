<div>
    <div class="card">
        <div class="card-header">
            Kelola Buku
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
                            <th scope="col">judul</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">isbn</th>
                            <th scope="col">tahun</th>
                            <th scope="col">jumlah</th>
                            @if(Auth::user()->jenis === 'admin')
                            <th>Proses</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->judul }}</td>
                                <td>{{ $data->kategori->nama }}</td>
                                <td>{{ $data->penulis }}</td>
                                <td>{{ $data->penerbit }}</td>
                                <td>{{ $data->isbn }}</td>
                                <td>{{ $data->tahun }}</td>
                                <td>{{ $data->jumlah }}</td>
                                @if(Auth::user()->jenis === 'admin')
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
                {{ $buku ->links() }}
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
                            <label for="">Judul</label>
                            <input type="text" class="form-control" wire:model="judul" value="{{ @old('judul') }}">
                            @error('judul')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select wire:model='kategori' class="form-control">
                                <option value="">---Pilih---</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penulis</label>
                            <input type="text" class="form-control" wire:model="penulis" value="{{ @old('penulis') }}">
                            @error('penulis')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penerbit</label>
                            <input type="text" class="form-control" wire:model="penerbit" value="{{ @old('penerbit') }}">
                            @error('penerbit')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Isbn</label>
                            <input type="text" class="form-control" wire:model="isbn" value="{{ @old('isbn') }}">
                            @error('isbn')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="text" class="form-control" wire:model="tahun" value="{{ @old('tahun') }}">
                            @error('tahun')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah</label>
                            <input type="text" class="form-control" wire:model="jumlah" value="{{ @old('jumlah') }}">
                            @error('jumlah')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="store" class="btn btn-primary" >Save</button>
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
                            <label for="">Kategori</label>
                            <select wire:model='kategori' class="form-control">
                                <option value="">---Pilih---</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" class="form-control" wire:model="judul" value="{{ @old('judul') }}">
                            @error('judul')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penulis</label>
                            <input type="text" class="form-control" wire:model="penulis" value="{{ @old('penulis') }}">
                            @error('penulis')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penerbit</label>
                            <input type="text" class="form-control" wire:model="penerbit" value="{{ @old('penerbit') }}">
                            @error('penerbit')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Isbn</label>
                            <input type="text" class="form-control" wire:model="penerbit" value="{{ @old('penerbit') }}">
                            @error('isbn')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="text" class="form-control" wire:model="tahun" value="{{ @old('tahun') }}">
                            @error('tahun')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>  
                        <div class="form-group">
                            <label for="">Jumlah</label>
                            <input type="text" class="form-control" wire:model="jumlah" value="{{ @old('jumlah') }}">
                            @error('jumlah')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>  
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="update" class="btn btn-primary"
                       >Save</button>
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
