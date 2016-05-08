@extends('layouts.admin')

@section('admin.title', '评论管理')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            <blockquote>
                <b>评论总数: {{ $comments->total() }}</b>
            </blockquote>
        </div>
        <div class="col-sm-12">
            <table class="comments-table table table-responsive table-hover Table" action-url="{{ url('manage/comments') }}">
                <thead>
                <tr>
                    <th>内容</th>
                    <th>发布人</th>
                    <th>所属文章</th>
                    <th>发布于</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr data-id="{{ $comment->id }}">
                        <td>
                            {{ str_limit($comment->body, 45) }}
                        </td>
                        <td>
                            {{ str_limit($comment->author->name, 10) }}
                        </td>
                        <td>
                            <a href="{{ $comment->post->link() }}" target="_blank">
                                {{ str_limit($comment->post->title, 30) }}
                            </a>
                        </td>
                        <td>
                            {{ $comment->created_at->diffForHumans() }}
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
                {!! $comments->links() !!}
            </div>
        </div>
    </div>
@stop