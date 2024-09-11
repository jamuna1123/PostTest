       <div class="card-body">
           <div class="mb-3">
               <label for="title" class="form-label"><strong>Title: @if (true)
                           <!-- Replace 'false' with your condition for the required field if any -->
                           <span class="text-danger">*</span>
                       @endif
                   </strong>
               </label>
               <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                   placeholder="Title" value="{{ old('title', $postcategory->title ?? '') }}">
               @error('title')
                   <div class="form-text text-danger">{{ $message }}</div>
               @enderror
           </div>
           <div class="mb-3">
               <label for="slug" class="form-label"><strong>Slug: @if (true)
                           <span class="text-danger">*</span>
                       @endif
                   </strong>
               </label>
               <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                   id="slug" placeholder="Slug" value="{{ old('slug', $postcategory->slug ?? '') }}">
               @error('slug')
                   <div class="form-text text-danger">{{ $message }}</div>
               @enderror
           </div>


           <div class="mb-3">
               <label for="description" class="form-label"><strong>Description: @if (true)
                           <!-- Replace 'false' with your condition for the required field if any -->
                           <span class="text-danger">*</span>
                       @endif
                   </strong>
               </label>
               <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                   rows="4" placeholder="Enter a description...">{{ old('description', $postcategory->description ?? '') }}</textarea>
               @error('description')
                   <div class="form-text text-danger">{{ $message }}</div>
               @enderror
           </div>
           <!-- Image Input -->
           <div class="mb-3">
               <label for="image" class="form-label">
                   <strong>Image:
                       @if (true)
                           <span class="text-danger">*</span>
                       @endif
                   </strong>
               </label>

               <input type="file" id="input-file-now" name="image"
                   class="dropify @error('image') is-invalid @enderror"
                   data-default-file="{{ isset($postcategory->image) ? asset('storage/images/original/' . $postcategory->image) : asset('storage/images/default-image.png') }}">
               @error('image')
                   <div class="form-text text-danger">{{ $message }}</div>
               @enderror

               {{-- @if (isset($postcategory) && $postcategory->image)
        <div class="mt-2">
            <img src="{{ asset('storage/images/original/' . $postcategory->image) }}" alt="Current Image" class="img-thumbnail" width="150">
        </div>
    @endif --}}
           </div>


           <div class="mb-3">
               <label for="status" class="form-label"><strong>Status:
                       @if (true)
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
