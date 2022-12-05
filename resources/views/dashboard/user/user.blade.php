@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">+ Tambah User</button>
                    </div>

                    <!-- Modal create-->
                    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('user') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Nama User : </label>
                                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label>Email : </label>
                                            <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label>Password : </label>
                                            <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label>Konfirmasi Password : </label>
                                            <input type="password" name="password_confirmation" class="form-control  @error('password_confirmation') is-invalid @enderror">
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label>Role : </label>
                                            <select name="role" class="form-control @error('role') is-invalid @enderror">
                                                <option value="admin">admin</option>
                                                <option value="owner">owner</option>
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah User</button>
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role }}</td>
                                <td>
                                    {{-- Tombol Edit --}}
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}">Edit</button>

                                    <!-- Modal Edit-->
                                    <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit user</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('user/' . $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>Nama User : </label>
                                                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{ $item->name }}">
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Email : </label>
                                                            <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{ $item->email }}">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Password : </label>
                                                            <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Konfirmasi Password : </label>
                                                            <input type="password" name="password_confirmation" class="form-control  @error('password_confirmation') is-invalid @enderror">
                                                            @error('password_confirmation')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Role : </label>
                                                            <select name="role" class="form-control @error('role') is-invalid @enderror">
                                                                <option value="admin" @selected($item->role == 'admin')>admin</option>
                                                                <option value="owner" @selected($item->role == 'owner')>owner</option>
                                                            </select>
                                                            @error('role')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Edit User</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tombol Delete --}}
                                    <button class="btn btn-danger" onclick="event.preventDefault();
                                    document.getElementById('delete-form{{ $loop->iteration }}').submit();">Hapus</button>

                                    {{-- Form Delete --}}
                                    <form id="delete-form{{ $loop->iteration }}" action="{{ url('user/' . $item->id) }}" method="POST" class="d-none">
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
