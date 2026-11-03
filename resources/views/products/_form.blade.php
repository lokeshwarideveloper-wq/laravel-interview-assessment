<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Product name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $product->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" maxlength="255" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="price" class="form-label">Price</label>
        <input id="price" name="price" type="number" value="{{ old('price', $product->price ?? '') }}" class="form-control @error('price') is-invalid @enderror" min="0" max="99999999.99" step="0.01" required>
        @error('price')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">Email ID</label>
        <input id="email" name="email" type="email" value="{{ old('email', $product->email ?? '') }}" class="form-control @error('email') is-invalid @enderror" maxlength="255" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="category_id" class="form-label">Category</label>
        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
            <option value="">Choose a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="branch_id" class="form-label">Branch</label>
        <select id="branch_id" name="branch_id" class="form-select @error('branch_id') is-invalid @enderror" required>
            <option value="">Choose a branch</option>
            @foreach ($branches as $branch)
                <option value="{{ $branch->id }}" @selected(old('branch_id', $product->branch_id ?? '') == $branch->id)>{{ $branch->name }}</option>
            @endforeach
        </select>
        @error('branch_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="image" class="form-label">Product image</label>
        <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp" class="form-control @error('image') is-invalid @enderror" @required($imageRequired)>
        <div class="form-text">JPG, PNG, or WebP; maximum 2 MB. {{ $imageRequired ? 'Required.' : 'Leave empty to keep the current image.' }}</div>
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if (isset($product))
            <div class="mt-2"><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path) }}" alt="{{ $product->name }}" class="product-thumb"></div>
        @endif
    </div>
</div>
