@extends('layouts.app')

@section('content')
<div class="card">
    <form method="GET" action="{{ route('flowers.index') }}" class="row">
        <input type="text" name="q" value="{{ $q }}" placeholder="Search by name/type...">

        <select name="category_id">
            <option value="">All categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected((string)$categoryId === (string)$cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>

        <select name="sort">
            <option value="name_asc" @selected($sort==='name_asc')>Name (A-Z)</option>
            <option value="name_desc" @selected($sort==='name_desc')>Name (Z-A)</option>
            <option value="price_asc" @selected($sort==='price_asc')>Price (low-high)</option>
            <option value="price_desc" @selected($sort==='price_desc')>Price (high-low)</option>
            <option value="stock_asc" @selected($sort==='stock_asc')>Stock (low-high)</option>
            <option value="stock_desc" @selected($sort==='stock_desc')>Stock (high-low)</option>
        </select>

        <button class="btn btn-primary" type="submit">Apply</button>
        <a class="btn" href="{{ route('flowers.index') }}">Reset</a>
    </form>
</div>

<div class="card" style="margin-top:12px;">
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Type</th>
            <th>Price</th>
            <th>Stock</th>
            <th style="width:240px;">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($flowers as $f)
            <tr>
                <td>{{ $f->name }}</td>
                <td>{{ $f->category?->name }}</td>
                <td>{{ $f->type ?? '-' }}</td>
                <td>{{ number_format((float)$f->price, 2) }}</td>
                <td>{{ $f->stock }}</td>
                <td>
                    <a class="btn" href="{{ route('flowers.show', $f->id) }}">Details</a>
                    <a class="btn" href="{{ route('flowers.edit', $f->id) }}">Edit</a>
                    <a class="btn btn-danger" href="{{ route('flowers.delete', $f->id) }}">Delete</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No results.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top:12px;">
        {{ $flowers->links() }}
    </div>
</div>
@endsection