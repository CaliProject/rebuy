@extends('layouts.admin')

@section('admin.title', '文章管理')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            <blockquote>
                <b>文章总数: {{ $posts->total() }}</b>
                <a class="pull-right" href="{{ url('manage/posts/create') }}"><i class="icon-plus fa-2x"></i></a>
            </blockquote>
        </div>
        <div class="col-sm-12">
            <table class="posts-table table table-responsive table-hover Table" action-url="{{ url('manage/posts') }}">
                <thead>
                <tr>
                    <th>标题</th>
                    <th>作者</th>
                    <th>更新时间</th>
                    <th>置顶</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr data-id="{{ $post->id }}">
                        <td>
                            <a href="{{ $post->link() }}" target="_blank">{{ $post->shortTitle() }}</a>
                            <span class="post-type" post-type="{{ $type = $post->readableType() }}">{{ $type }}</span>
                        </td>
                        <td>{{ $post->author->name }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td>{{ $post->sticky ? '是' : '否' }}</td>
                        <td class="text-center">
                            <a href="#" class="edit-btn">
                                <i class="icon-pencil"></i>
                            </a>
                            <a href="#" class="delete-btn">
                                <i class="icon-close"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center row">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@stop