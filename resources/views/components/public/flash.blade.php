@if (session('success'))
    <div class="flash flash-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="flash flash-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
