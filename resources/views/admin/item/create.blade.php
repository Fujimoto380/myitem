{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'アイテムの新規登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <h2>アイテム新規登録</h2>
                <form action="{{ action('Admin\ItemController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3">アイテム名</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="itemname" value="{{ old('itemname') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">カラーコード</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="code" value="{{ old('code') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                    <button class="btn btn-primary" type="button" onclick="history.back()">戻る</button>
                </form>
            </div>
        </div>
    </div>
@endsection