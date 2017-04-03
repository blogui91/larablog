@extends('Admin.layouts.app')

@section('header')
@endsection

@section('content')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Multimedia
            <a class="btn btn-success pull-right" href="{{ route('admin.post.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if($posts->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Publicado</th>
                            <th>Imagen destacada</th>
                            <th>Published by</th>
                            <th>Updated by</th>

                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->abstract}}</td>
                                <td>{{$post->published? 'Sí' : 'No'}}</td>
                                <td>
                                    <img src="{{$post->image}}" height="100" width="150" alt="">
                                </td>
                                <td>
                                    {{$post->publishedBy->fullname}}
                                </td>
                                  <td>
                                    {{$post->updatedBy->fullname}}
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-warning" href="{{ route('admin.post.update', $post->slug) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('admin.post.delete', $post->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $posts->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection