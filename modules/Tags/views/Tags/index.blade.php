@extends('Admin.layouts.app')

@section('header')
@endsection

@section('content')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Tags
            <a class="btn btn-success pull-right" href="{{ route('admin.tag.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            @if($tags->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Slug</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{$tag->id}}</td>
                                <td>{{$tag->name}}</td>
                                <td>{{$tag->slug}}</td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-warning" href="{{ route('admin.tag.update', $tag->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('admin.tag.delete', $tag->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $tags->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection