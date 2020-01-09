@extends('layouts.admin')
@section('title', 'アイテムの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <h2>アイテム編集</h2>
                <form action="{{ action('Admin\ItemController@update') }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="itemname" value="{{ $item_form->itemname }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">カラーコード</label>
                        <div class="col-md-7">
                        	<input type="text" class="form-control" name="code" value="{{ $item_form->code }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">画像</label>
                        <div class="col-md-7">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $item_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $item_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="編集">
                            <button class="btn btn-primary" type="button" onclick="history.back()">戻る</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection