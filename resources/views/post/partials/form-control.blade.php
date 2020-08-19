<div class="from-group">
    <input type="file" name="thumbnail" id="thumbnail" class="@error('thumbnail') is-invalid @enderror">
    @error('thumbnail')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
<label for="title">Title</label>
    <input id="title" value=" {{ old('title') ?? $post->title}}" class="form-control @error('title') is-invalid @enderror" type="text" name="title"   autofocus>
    @error('title')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="form-group">
<label for="category">Category</label>
    <select id="category" class="form-control @error('category') is-invalid @enderror" name="category">
        <option disabled selected>Choose one!!</option>
            @foreach ($categories as $category)
            <option {{$category->id == $post->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
    </select>
    @error('category')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="form-group">
<label for="tags">Tag</label>
    <select id="tags" class="form-control select2 @error('tags') is-invalid @enderror" name="tags[]" multiple>
        @foreach ($post->tags as $tag)
            <option  selected value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach    
        @foreach ($tags as $tag)
            <option  value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach
    </select>
    @error('tags')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="body">Description</label>
    <textarea id="body"  class="form-control @error('body') is-invalid @enderror" type="text" name="body">{{old('body') ?? $post->body}}</textarea>
    @error('body')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">{{ $submit ?? 'Update' }}</button>