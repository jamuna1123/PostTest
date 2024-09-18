<div class="card-body">
    <div class="row">
        <!-- Title Field -->
        <div class="mb-3 col-md-6">
            <label for="title" class="form-label">
                <strong>Title:
                    @if (true)
                        <span class="text-danger">*</span>
                    @endif
                </strong>
            </label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                placeholder="Title" value="{{ old('title', $post->title ?? '') }}">
            @error('title')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Slug Field -->
        <div class="mb-3 col-md-6">
            <label for="slug" class="form-label">
                <strong>Slug:
                    @if (true)
                        <span class="text-danger">*</span>
                    @endif
                </strong>
            </label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                placeholder="Slug will be auto generated" value="{{ old('slug', $post->slug ?? '') }}">
            @error('slug')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">


      

        <!-- Post Category Field -->
        <div class="mb-3 col-md-6">
            <label for="post_category_id" class="form-label">
                <strong>Post Category:
                    @if (true)
                        <span class="text-danger">*</span>
                    @endif
                </strong>
            </label>
            <select class="form-select @error('post_category_id') is-invalid @enderror" name="post_category_id" id="post_category_id">
                <option value="">Select Post Category</option>
                @foreach ($categories as $category)
            <option value="{{ $category->id }}" 
                {{ $post->post_category_id == $category->id ? 'selected' : '' }}>
                {{ $category->title }}
            </option>
        @endforeach
            </select>
            @error('post_category_id')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image Input -->
        <div class="mb-3 col-md-6">
            <label for="image" class="form-label"><strong>Image:@if (false)
                        <span class="text-danger">*</span>
                    @endif
                </strong></label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <!-- Description Field -->
        <div class="mb-3 col-md-12">
            <label for="description" class="form-label">
                <strong>Description:
                    @if (false)
                        <span class="text-danger">*</span>
                    @endif
                </strong>
            </label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                rows="4" placeholder="Enter a description...">{{ old('description', $post->description ?? '') }}</textarea>
            @error('description')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">

        <!-- Publish Date Field -->
        <div class="mb-3 col-md-6">
            <label for="published_at" class="form-label">
                <strong>Publish Date:
                    @if (true)
                        <span class="text-danger">*</span>
                    @endif
                </strong>
            </label>
            <input type="datetime-local" name="published_at" id="published_at"
                class="form-control @error('published_at') is-invalid @enderror"
                value="{{ old('published_at', isset($post->published_at) ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
            @error('published_at')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        

        <!-- Status Field -->
        <div class="mb-3 col-md-6">
            <label for="status" class="form-label">
                <strong>Status:@if (false)
                        <span class="text-danger">*</span>
                    @endif</strong>
            </label>
            <div class="form-check form-switch">
                <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" role="switch"
                    id="status" name="status" value="1"
                    {{ (isset($post) && $post->status) || old('status') ? 'checked' : '' }} onchange="toggleStatusLabel()">
                <label class="form-check-label" for="status" id="statusLabel">
                    {{ (isset($post) && $post->status) || old('status') ? 'Active' : 'Inactive' }}
                </label>
            </div>
            @error('status')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
