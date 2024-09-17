       <div class="card-body">
           <div class="mb-3">
               <label for="title" class="form-label"><strong>Category Name: @if (true)
                           <!-- Replace 'false' with your condition for the required field if any -->
                           <span class="text-danger">*</span>
                       @endif
                   </strong>
               </label>
               <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                   placeholder="Category Name" value="{{ old('title', $postcategory->title ?? '') }}">
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
                   id="slug" placeholder="Slug will be auto generate" value="{{ old('slug', $postcategory->slug ?? '') }}">
               @error('slug')
                   <div class="form-text text-danger">{{ $message }}</div>
               @enderror
           </div>


           <div class="mb-3">
               <label for="description" class="form-label"><strong>Description: @if (false)
                           <!-- Replace 'false' with your condition for the required field if any -->
                           <span class="text-danger">*</span>
                       @endif
                   </strong>
               </label>
              <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter a description...">{{ old('description', isset($postcategory->description) ? strip_tags($postcategory->description) : '') }}</textarea>
@error('description')
    <div class="form-text text-danger">{{ $message }}</div>
@enderror
           </div>
           <!-- Image Input -->
     <div class="mb-3">
    <label for="image" class="form-label"><strong>Image:@if (false)
                           <!-- Replace 'false' with your condition for the required field if any -->
                           <span class="text-danger">*</span>
                       @endif</strong></label>
    <input type="file" name="image" id="image" class="form-control">
    
    @error('image')
        <div class="form-text text-danger">{{ $message }}</div>
    @enderror

   
</div>

           <div class="mb-3">
               <label for="status" class="form-label"><strong>Status:
                       @if (false)
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
