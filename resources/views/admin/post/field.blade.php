       <div class="card-body">
           <div class="mb-3">
               <label for="title" class="form-label"><strong>Title:</strong></label>
               <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                   placeholder="Title" value="{{ old('title', $post->title ?? '') }}">
               @error('title')
                   <div class="form-text text-danger">{{ $message }}</div>
               @enderror
           </div>

         <div class="mb-3">
    <label for="parent_id" class="form-label"><strong>Post Category:</strong></label>
    <select class="form-select @error('post_category_id') is-invalid @enderror" name="post_category_id" id="post_category_id">
        <option value="">Select Post Category</option>
        @foreach($parentCategoriesList as $id => $title)
            <option value="{{ $id }}" 
                {{ (isset($post) && $post->post_category_id == $id) ? 'selected' : '' }}>
                {{ $title }}
            </option>
        @endforeach
    </select>

    @error('post_category_id')
        <div class="form-text text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
        <label for="user_id" class="form-label"><strong>User:</strong></label>
        <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" 
                    {{ (isset($post) && $post->user_id == $user->id) ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('user_id')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="published_at" class="form-label"><strong>Published At:</strong></label>
        <input type="date" name="published_at" id="published_at" 
            class="form-control @error('published_at') is-invalid @enderror" 
            value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
        @error('published_at')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>
           <div class="mb-3">
               <label for="description" class="form-label"><strong>Description:</strong></label>
               <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                   rows="4" placeholder="Enter a description...">{{ old('description', $post->description ?? '') }}</textarea>
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

    @if(isset($post) && $post->image)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="img-thumbnail" width="150">
            <p>Current Image</p>
        </div>
    @endif
</div>

<div class="mb-3">
    <label for="status" class="form-label"><strong>Status:</strong></label>
    <div class="form-check form-switch">
        <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" role="switch"
               id="status" name="status" value="1" 
               {{ (isset($post) && $post->status) || old('status') ? 'checked' : '' }}
               onchange="toggleStatusLabel()">
        <label class="form-check-label" for="status" id="statusLabel">
            {{ (isset($post) && $post->status) || old('status') ? 'Active' : 'Inactive' }}
        </label>
    </div>
    @error('status')
        <div class="form-text text-danger">{{ $message }}</div>
    @enderror
</div>

