@extends('layouts.app')

@section('content')
<div class="card">
    <h3>Add Flower</h3>

    <form method="POST" action="{{ route('flowers.store') }}" enctype="multipart/form-data">
        @csrf
        @include('flowers._form', ['categories' => $categories])
        <div style="margin-top:12px;">
            <button class="btn btn-primary" type="submit">Create</button>
            <a class="btn" href="{{ route('flowers.index') }}">Cancel</a>
        </div>
    </form>
</div>
@endsection