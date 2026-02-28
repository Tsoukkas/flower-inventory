@extends('layouts.app')

@section('content')
<div class="card">
    <h3>Edit Flower</h3>

    <form method="POST" action="{{ route('flowers.update', $flower->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('flowers._form', ['flower' => $flower, 'categories' => $categories])

        <div style="margin-top:12px;">
            <button class="btn btn-primary" type="submit">Save</button>
            <a class="btn" href="{{ route('flowers.show', $flower->id) }}">Cancel</a>
        </div>
    </form>
</div>
@endsection