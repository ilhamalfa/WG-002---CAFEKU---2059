@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">+ Tambah Menu</button>
                    </div>

                    <!-- Modal create-->
                    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('menu') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Nama Menu : </label>
                                            <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label>Foto : </label>
                                            <input type="file" name="foto" class="form-control  @error('foto') is-invalid @enderror">
                                            @error('foto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label>Harga Menu : </label>
                                            <input type="number" min="0" name="harga" class="form-control  @error('harga') is-invalid @enderror" value="{{ old('harga') }}">
                                            @error('harga')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label>Keterangan : </label>
                                            <input type="text" name="keterangan" class="form-control  @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}">
                                            @error('keterangan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label>Kategori : </label>
                                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                                @foreach ($datas as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah menu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Table --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Menu</th>
                                <th style="width: 20%">Foto</th>
                                <th>Harga</th>
                                <th>Keterangan</th>
                                <th>Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->nama }}</td>
                                <td><img src="{{ asset('storage/'.$item->foto) }}" alt="" class="img img-thumbnail" style="height: 10%"></td>
                                <td>@currency($item->harga)</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->kategori->nama }}</td>
                                <td>
                                    {{-- Tombol Edit --}}
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}">Edit</button>

                                    <!-- Modal Edit-->
                                    <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit menu</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('menu/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>Nama Menu : </label>
                                                            <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror" value="{{ $item->nama }}">
                                                            @error('nama')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Foto : </label>
                                                            <img src="{{ asset('storage/'.$item->foto) }}" alt="" class="img img-thumbnail" style="height: 10%"<br>
                                                            <input type="file" name="foto" class="form-control  @error('foto') is-invalid @enderror">
                                                            @error('foto')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Harga Menu : </label>
                                                            <input type="number" min="0" name="harga" class="form-control  @error('harga') is-invalid @enderror" value="{{ $item->harga }}">
                                                            @error('harga')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Keterangan : </label>
                                                            <input type="text" name="keterangan" class="form-control  @error('keterangan') is-invalid @enderror" value="{{ $item->keterangan }}">
                                                            @error('keterangan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Kategori : </label>
                                                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                                                @foreach ($datas as $data)
                                                                    <option value="{{ $data->id }}" @selected($item->kategori_id == $data->id)>{{ $data->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('kategori_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Edit menu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tombol Delete --}}
                                    <button class="btn btn-danger" onclick="event.preventDefault();
                                    document.getElementById('delete-form{{ $loop->iteration }}').submit();">Hapus</button>

                                    {{-- Form Delete --}}
                                    <form id="delete-form{{ $loop->iteration }}" action="{{ url('menu/' . $item->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
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
@endsection
