<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flower Inventory</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .row { display:flex; gap:12px; align-items:center; flex-wrap:wrap; }
        .card { border:1px solid #ddd; border-radius:10px; padding:16px; }
        .btn { display:inline-block; padding:8px 12px; border:1px solid #333; border-radius:8px; text-decoration:none; }
        .btn-danger { border-color:#b00020; color:#b00020; }
        .btn-primary { border-color:#0b57d0; color:#0b57d0; }
        table { width:100%; border-collapse:collapse; }
        th, td { border-bottom:1px solid #eee; padding:10px; text-align:left; }
        input, select { padding:8px; border-radius:8px; border:1px solid #ccc; }
        .alert { padding:10px; border-radius:8px; margin: 12px 0; background:#f1f8ff; border:1px solid #cfe8ff; }
        .error { padding:10px; border-radius:8px; margin: 12px 0; background:#fff3f3; border:1px solid #ffd2d2; }
        img { max-width: 220px; border-radius: 10px; }
    </style>
</head>
<body>
<div class="container">
    <div class="row" style="justify-content:space-between; margin-bottom:16px;">
        <h2 style="margin:0;"><a href="{{ route('flowers.index') }}" style="text-decoration:none; color:inherit;">Flower Inventory</a></h2>
        <a class="btn btn-primary" href="{{ route('flowers.create') }}">+ Add Flower</a>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">
            <strong>Please fix:</strong>
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>
</body>
</html>