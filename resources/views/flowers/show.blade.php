@extends('layouts.app')

@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between;">
        <h3 style="margin:0;">{{ $flower->name }}</h3>
        <div class="row">
            <a class="btn" href="{{ route('flowers.edit', $flower->id) }}">Edit</a>
            <a class="btn btn-danger" href="{{ route('flowers.delete', $flower->id) }}">Delete</a>
        </div>
    </div>

    <p><strong>Category:</strong> {{ $flower->category?->name }}</p>
    <p><strong>Type:</strong> {{ $flower->type ?? '-' }}</p>
    <p><strong>Price:</strong> {{ number_format((float)$flower->price, 2) }}</p>
    <p><strong>Stock:</strong> {{ $flower->stock }}</p>

    @if($flower->image_path)
        <p><strong>Image:</strong></p>
        <img src="{{ asset('storage/' . $flower->image_path) }}" alt="Flower image">
    @endif

    <div style="margin-top:12px;">
        <a class="btn" href="{{ route('flowers.index') }}">Back</a>
    </div>
</div>
@endsection