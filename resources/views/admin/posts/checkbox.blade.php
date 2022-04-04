@php
    $value = isset($value) ? $value : [];
@endphp
@if ($data)
    @foreach ($data as $item)
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="category[]" value="{{ $item->id }}" id="checkbox-{{ $item->id }}" {{ in_array($item->id, array_column($value, 'id')) ? "checked" : NULL }}>
            <label class="form-check-label" for="checkbox-{{ $item->id }}">
                {{ $item->name }}
            </label>
            @include('admin.posts.checkbox', ['data' => $item->child_cats, 'value' => $value])
        </div>
    @endforeach
@endif

