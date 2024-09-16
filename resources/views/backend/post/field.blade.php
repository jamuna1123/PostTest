<div class="card-body">
    <!-- Title Field -->
    <div class="mb-3">
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
    <div class="mb-3">
        <label for="slug" class="form-label">
            <strong>Slug:
                @if (true)
                    <!-- Replace 'true' with your condition for the required field -->
                    <span class="text-danger">*</span>
                @endif
            </strong>
        </label>
        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
            placeholder="Slug" value="{{ old('slug', $post->slug ?? '') }}">
        @error('slug')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Post Category Field -->
    <div class="mb-3">
        <label for="post_category_id" class="form-label">
            <strong>Post Category:
                @if (true)
                    <span class="text-danger">*</span>
                @endif
            </strong>
        </label>
        <select class="form-select @error('post_category_id') is-invalid @enderror" name="post_category_id"
            id="post_category_id">
            <option value="">Select Post Category</option>
            @foreach ($parentCategoriesList as $category)
                <option value="{{$category->id }}"
                    {{ isset($post) && $post->post_category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
        @error('post_category_id')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- User Field -->
    <div class="mb-3">
        <label for="user_id" class="form-label">
            <strong>User:
                @if (true)
                    <span class="text-danger">*</span>
                @endif
            </strong>
        </label>
        <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
            <option value="">Select User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ isset($post) && $post->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('user_id')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Publish Date Field -->
    <div class="mb-3">
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

    <!-- Description Field -->
    <div class="mb-3">
        <label for="description" class="form-label">
            <strong>Description:
                @if (true)
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

    <!-- Image Input -->
    <div class="mb-3">
        <label for="image" class="form-label"><strong>Image:@if (true)
                    <!-- Replace 'false' with your condition for the required field if any -->
                    <span class="text-danger">*</span>
                @endif
            </strong></label>
        <input type="file" name="image" id="image" class="form-control">

        @error('image')
            <div class="form-text text-danger">{{ $message }}</div>
        @enderror

    </div>

    <!-- Status Field -->
    <div class="mb-3">
        <label for="status" class="form-label">
            <strong>Status:@if (true)
                    <!-- Replace 'false' with your condition for the required field if any -->
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
