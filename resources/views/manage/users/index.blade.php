@extends('layouts.admin')

@section('admin.title', '用户管理')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            <blockquote>
                <b>用户总数: {{ $users->total() }}</b>
                <a class="pull-right" href="{{ url('manage/users/create') }}"><i class="icon-plus fa-2x"></i></a>
            </blockquote>
        </div>
        <div class="col-sm-12">
            <table class="users-table table table-responsive table-hover Table" action-url="{{ url('manage/users') }}">
                <thead>
                <tr>
                    <th>昵称</th>
                    <th>邮箱</th>
                    <th>注册于</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr data-id="{{ $user->id }}">
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->created_at->diffForHumans() }}
                        </td>
                        <td class="text-center">
                            <a href="#" class="edit-btn">
                                <i class="icon-pencil"></i>
                            </a>
                            @unless(Auth::id() === $user->id)
                            <a href="#" class="delete-btn">
                                <i class="icon-close"></i>
                            </a>
                            @endunless
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center row">
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@stop