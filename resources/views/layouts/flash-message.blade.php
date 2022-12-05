@if (session()->has('success'))
    <div class="alert alert-success mt-2" role="alert">
        {{ session('success') }}
    </div>
@endif