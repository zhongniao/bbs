@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card">

      <div class="card-body">
        <h2 class="">
          <i class="far fa-edit"></i>
          @if($topic->id)
          编辑话题
          @else
          新建话题
          @endif
        </h2>

        <hr>

        @if($topic->id)
        <form action="{{ route('topics.update', $topic) }}" method="POST">
          <input type="hidden" name="_method" value="PUT">
          @else
          <form action="{{ route('topics.store') }}" method="POST">
            @endif

            @csrf

            @include('shared._error')

            <div class="form-group">
              <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title) }}"
                placeholder="请填写标题" required />
            </div>

            <div class="form-group">
              <select class="form-control" name="category_id" required>
                <option value="" hidden disabled selected>请选择分类</option>
                @foreach ($categories as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              {{-- <textarea name="body" class="form-control" id="editor" rows="6" placeholder="请填入至少三个字符的内容。" --}}
              {{-- required>{{ old('body', $topic->body) }}</textarea> --}}
              <div id="editor">
                <p>Here goes the initial content of the editor.</p>
              </div>
            </div>

            <div class="well well-sm">
              <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i>
                保存</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>

@stop

@section('scripts')

<script src="{{ asset('js/ckeditor.js') }}"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script> --}}
<script>
  ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
</script>
@stop
