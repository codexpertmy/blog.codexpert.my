@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <a href="{{ route('post.manage.create') }}" class="btn btn-primary" style="margin: 10px;"> Create</a>
                   <table class="table table-bordered table-hover">
                       <tr>
                           <th>&nbsp;</th>
                           <th>Title</th>
                           <th>Status</th>
                           <th>Total Visits</th>
                           <th>Manage</th>
                       </tr>

                       @foreach($posts as $post)
                            <tr>
                                <td><input type="checkbox" name=""/></td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <label class="label label-{{ $post->published ? 'success' : 'warning' }}">
                                        {{ $post->published ? 'published' : 'draft' }}
                                    </label>
                                </td>
                                <td></td>
                                <td>
                                    <a href="{{ route('post.manage.edit',$post->hash_id) }}" type="button" class="btn btn-info btn-sm"> Edit</a>
                                     <a href="{{ route('post.manage.delete',$post->hash_id) }}" type="button" class="btn btn-danger btn-sm"> Delete</a>
                                </td>
                            </tr>
                       @endforeach
                   </table>


                   {!! $posts->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
