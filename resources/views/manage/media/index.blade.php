@extends('layouts.admin')

@section('admin.title', '图片管理')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            <blockquote>
                <b>图片总数: {{ $media->total() }}</b>
            </blockquote>
        </div>
        <div class="col-sm-12">
            <form action="{{ url('upload') }}" class="dropzone" id="uploader">
                {!! csrf_field() !!}
            </form>
        </div>
        <div class="col-sm-12">
            <table class="media-table table table-responsive table-hover Table" action-url="{{ url('manage/media') }}">
                <thead>
                <tr>
                    <th>#</th>
                    <th>预览</th>
                    <th>上传人</th>
                    <th>发布于</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($media as $picture)
                    <tr data-id="{{ $picture->id }}">
                        <td>
                            {{ $picture->id }}
                        </td>
                        <td>
                            <img src="{{ url('uploads/' . $picture->path) }}" alt="图片" class="img-thumbnail" style="max-width: 500px">
                        </td>
                        <td>
                            {{ str_limit($picture->user->name, 10) }}
                        </td>
                        <td>
                            {{ $picture->created_at->diffForHumans() }}
                        </td>
                        <td class="text-center">
                            <a href="#" class="delete-btn">
                                <i class="icon-close"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center row">
                {!! $media->links() !!}
            </div>
        </div>
    </div>
@stop