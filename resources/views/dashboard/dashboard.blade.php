@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-header">{{ __('Order') }}</div>

                <div class="card-body">
                    <form action="{{ url('dashboard-admin/submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Nama : </label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="mb-3">Pesanan : </label>
                            <div class="row">
                                @foreach ($menus as $menu)
                                    <div class="col-md-4 text-center ">
                                        <input type="checkbox" name="menu[]" value="{{ $menu->id }}"> <label class="form-check-label">{{ $menu->nama }} (@currency($menu->harga)) </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Status : </label>
                            <select name="status" class="form-control">
                                <option value="Member">Member</option>
                                <option value="Non Member">Non Member</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        @isset($data)
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-header">{{ __('Order Output') }}</div>
    
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nama : </th>
                            <td>{{ $data['nama'] }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Pesanan : </th>
                            <td>{{ $data['jumlah_pesanan'] }}</td>
                        </tr>
                        <tr>
                            <th>Total : </th>
                            <td>@currency($data['total_pesanan'])</td>
                        </tr>
                        <tr>
                            <th>Status : </th>
                            <td>{{ $data['status'] }}</td>
                        </tr>
                        <tr>
                            <th>Diskon : </th>
                            <td>{{ $data['diskon'] }}</td>
                        </tr>
                        <tr>
                            <th>Total Pembayaran : </th>
                            <td>@currency($data['total'])</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @endisset
    </div>
</div>
@endsection
