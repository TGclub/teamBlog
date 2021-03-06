@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>{{ env('Group_name', 'Group') }}&nbsp;--&nbsp;{{ $user }}</h1>
@stop

@section('content')
    <div class="container">
        <label for="posts"><h3>文章管理</h3></label>
        <div id="posts" class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>文章标题</th>
                        <th>标签</th>
                        <th>发布时间</th>
                        <th>浏览量</th>
                        <th>编辑</th>
                        <th>删除</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $eachPost)
                        <tr id="article{{ $eachPost->id }}">
                            <th>{{ $eachPost->name }}</th>
                            <th>{{ $eachPost->tag->name }}</th>
                            <th>{{ $eachPost->created_at }}</th>
                            <th>{{ $eachPost->view }}</th>
                            <th>
                                <a href="{{ route('article.edit', ['id' => $eachPost->id]) }}">
                                    <i class="fa fa-fw fa-pencil" style="color: #00a65a"></i>
                                </a>
                            </th>
                            <th>
                                <i class="fa fa-fw fa-remove" id="{{ $eachPost->id }} "
                                        style="color: #990000" onclick="post_remove(this.id)"></i>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function post_remove(id) {
            $.ajax({
                url:'{{ route('article.index') }}'+"/"+id,
                type:"DELETE",
                success:function (data) {
                    bootbox.alert("删除成功",function () {
                        $('#article'+id).remove();
                    })
                },
                error:function (e) {
                    bootbox.alert("删除失败");
                    console.log(e);
                }
            })
        }
    </script>
@endsection