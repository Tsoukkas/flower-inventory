@extends('layouts.app')

@section('content')
<div class="card">
    <h3>Delete Flower</h3>
    <p>Are you sure you want to delete <strong>{{ $flower->name }}</strong>?</p>

    <form method="POST" action="{{ route('flowers.destroy', $flower->id) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Yes, delete</button>
        <a class="btn" href="{{ route('flowers.show', $flower->id) }}">Cancel</a>
    </form>
</div>
@endsection