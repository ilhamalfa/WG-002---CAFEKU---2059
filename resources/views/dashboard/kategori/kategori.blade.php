@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Kategori') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">+ Tambah Kategori</button>
                    </div>

                    <!-- Modal create-->
                    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah kategori</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('kategori') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Nama Kategori : </label>
                                            <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah Kategori</button>
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
                                <th>Nama Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    {{-- Tombol Edit --}}
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}">Edit</button>

                                    <!-- Modal Edit-->
                                    <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit kategori</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('kategori/' . $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>Nama Kategori : </label>
                                                            <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror" value="{{ $item->nama }}">
                                                            @error('nama')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Edit Kategori</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tombol Delete --}}
                                    <button class="btn btn-danger" onclick="event.preventDefault();
                                    document.getElementById('delete-form{{ $loop->iteration }}').submit();">Hapus</button>

                                    {{-- Form Delete --}}
                                    <form id="delete-form{{ $loop->iteration }}" action="{{ url('kategori/' . $item->id) }}" method="POST" class="d-none">
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
