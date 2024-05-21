@if (session('success'))
    <div class="flash flash-success">
        {{ session('success') }}
    </div>
@endif
