       <div class="card-body">
           <div class="mb-3">
               <label for="title" class="form-label"><strong>Title:</strong></label>
               <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                   placeholder="Title" value="{{ old('title', $postcategory->title ?? '') }}">
               @error('title')
                   <div class="form-text text-danger">{{ $message }}</div>
               @enderror
           </div>

           <div class="mb-3">
               <label for="parent_id" class="form-label"><strong>Parent Category:</strong></label>
               <select class="form-select @error('parent_id') is-invalid @enderror" name="parent_id" id="parent_id">
                     <option value="">Select Parent Category</option>
        @foreach($parentCategoriesList as $parentCategory)
            <option value="{{ $parentCategory->id }}" 
                {{ (isset($postcategory) && $postcategory->parent_id == $parentCategory->id) ? 'selected' : '' }}>
                {{ $parentCategory->title }}
            </option>
        @endforeach
               </select>



               @error('parent_id')
                   <div class="form-text text-danger">{{ $message }}</div>
               @enderror
           </div>

           <div class="mb-3">
               <label for="description" class="form-label"><strong>Description:</strong></label>
               <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                   rows="4" placeholder="Enter a description...">{{ old('description', $postcategory->description ?? '') }}</textarea>
               @error('description')
                   <div class="form-text text-danger">{{ $message }}</div>
               @enderror
           </div>
           <!-- Image Input -->
        <div class="mb-3">
    <label for="image" class="form-label"><strong>Image:</strong></label>
    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
    @error('image')
        <div class="form-text text-danger">{{ $message }}</div>
    @enderror

    @if(isset($postcategory) && $postcategory->image)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $postcategory->image) }}" alt="Current Image" class="img-thumbnail" width="150">
            <p>Current Image</p>
        </div>
    @endif
</div>

<div class="mb-3">
    <label for="status" class="form-label"><strong>Status:</strong></label>
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

