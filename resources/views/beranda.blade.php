@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Daftar Menu') }}</div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($items as $item)
                        <div class="card m-3" style="width: 18rem;">
                            <img src="{{ asset('storage/'.$item->foto) }}" class="card-img-top" alt="...">
                            <ul class="list-group list-group-flush text-center">
                                <li class="list-group-item"><h5>{{ $item->nama }}</h5> </li>
                                <li class="list-group-item">Harga : @currency($item->harga)</li>
                                <li class="list-group-item">Kategori : {{ $item->kategori->nama }}</li>
                            </ul>
                            <div class="card-body text-center">
                                <p class="card-text text-secondary">
                                    {{ $item->keterangan }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
