@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12et-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                   <form action="{{ route('post.manage.update',$post->hash_id) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('put') }}
                       <div class="form-group">
                            <label for="">Article itle</label>
                            <input type="text" name="title" class="form-control" placeholder="Article title" value="{{ $post->title ?? null }}"/>
                            @if($errors->any()) <p class="text-danger">{{ $errors->first('title')}}</p> @endif
                       </div>

                         <div class="form-group">
                            <label for="">Sub title</label>
                            <input type="text" name="sub_title" class="form-control" placeholder="Article Sub title" value="{{ $post->sub_title ?? null }}" />
                             @if($errors->any()) <p class="text-danger">{{ $errors->first('sub_title')}}</p> @endif
                       </div>

                       <div class="form-group">
                           <label for="">Category</label>
                           <select name="category_id" class="form-control" id="">
                               @foreach(get_category_items() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                           </select>
                       </div>


                       <div class="form-group">
                           <label for="">Category</label>
                           <select name="published" class="form-control" id="">
                             <option value="0">Draft</option>
                             <option value="1">Published</option>
                           </select>
                       </div>

                         <div class="form-group">
                            <label for="">Seo keywords</label>
                            <input type="text" name="seo_keywords" class="form-control" placeholder="Comma separated" value="{{ isset($post) ? implode(' ',$post->seo_keywords) : null}}"/>
                       </div>

                       <div class="form-group">
                            <label for="">Article</label>
                            <textarea name="body" id="" class="form-control" cols="30" rows="10" style="resize: none; height: 400px;">{{ $post->body ?? null }}</textarea>
                             @if($errors->any()) <p class="text-danger">{{ $errors->first('body')}}</p> @endif
                       </div>

                       <div class="form-group">
                           <input type="submit" value="Update Article" class="btn btn-primary" />
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
