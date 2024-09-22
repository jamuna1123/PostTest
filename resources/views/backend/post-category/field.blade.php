<div class="card-body">
    <div class="row">
        <!-- Category Name -->
        <div class="mb-3 col-md-6">
            <label for="title" class="form-label"><strong>Category Name: @if (true)
                    <span class="text-danger">*</span>
                @endif
            </strong></label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                placeholder="Category Name" value="{{ old('title', $postcategory->title ?? '') }}">
            @error('title')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Slug -->
        <div class="mb-3 col-md-6">
            <label for="slug" class="form-label"><strong>Slug: @if (true)
                    <span class="text-danger">*</span>
                @endif
            </strong></label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                placeholder="Slug will be auto generated if left empty" value="{{ old('slug', $postcategory->slug ?? '') }}">
            @error('slug')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

   
    
<div class="row">
       
         <!-- Image -->
        <div class="mb-3 col-md-6">
            <label for="image" class="form-label"><strong>Image: @if (false)
                    <span class="text-danger">*</span>
                @endif
            </strong></label>
         <input type="hidden" name="image" id="image" value="{{ old('image')}}">
            @error('image')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-3 col-md-6">
            <label for="description" class="form-label"><strong>Description: @if (false)
                    <span class="text-danger">*</span>
                @endif
            </strong></label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter description here...">{{ old('description', isset($postcategory->description) ? strip_tags($postcategory->description) : '') }}</textarea>
            @error('description')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
</div>
<div class="row">
        <!-- Status -->
        <div class="mb-3 col-md-6">
            <label for="status" class="form-label"><strong>Status: @if (false)
                    <span class="text-danger">*</span>
                @endif
            </strong></label>
            <div class="form-check form-switch">
                <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" role="switch"
                    id="status" name="status" value="1"
                    {{ (isset($postcategory) && $postcategory->status) || old('status') ? 'checked' : '' }}
                    onchange="toggleStatusLabel()">
                <label class="form-check-label" for="status" id="statusLabel">
                    {{ (isset($postcategory) && $postcategory->status) || old('status') ? 'Active' : 'Inactive' }}
                </label>
            </div>
               

            @error('status')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
</div>
</div>
