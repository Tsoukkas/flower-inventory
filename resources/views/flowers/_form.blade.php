@php
    $isEdit = isset($flower);
@endphp

<div class="row">
    <div style="flex:1; min-width:240px;">
        <label>Category</label><br>
        <select name="category_id" required>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    @selected(old('category_id', $flower->category_id ?? '') == $cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div style="flex:1; min-width:240px;">
        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name', $flower->name ?? '') }}" required>
    </div>
</div>

<div class="row" style="margin-top:12px;">
    <div style="flex:1; min-width:240px;">
        <label>Type</label><br>
        <input type="text" name="type" value="{{ old('type', $flower->type ?? '') }}">
    </div>

    <div style="flex:1; min-width:240px;">
        <label>Price</label><br>
        <input type="number" step="0.01" name="price" value="{{ old('price', $flower->price ?? '0.00') }}" required>
    </div>

    <div style="flex:1; min-width:240px;">
        <label>Stock</label><br>
        <input type="number" name="stock" value="{{ old('stock', $flower->stock ?? 0) }}" required>
    </div>
</div>

<div style="margin-top:12px;">
    <label>Image (optional)</label><br>
    <input type="file" name="image" accept="image/*">

    @if($isEdit && ($flower->image_path ?? null))
        <div style="margin-top:10px;">
            <small>Current:</small><br>
            <img src="{{ asset('storage/' . $flower->image_path) }}" alt="Current image">
        </div>
    @endif
</div>