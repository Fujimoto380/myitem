@extends('layouts.admin')
@section('title', 'あなたのアイテム一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2 style="padding-left: 0.5rem;">あなたのアイテム一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-7" style="margin-bottom: 0.5rem;">
                <a href="{{ action('Admin\ItemController@add') }}" role="button" class="btn btn-outline-primary">新規作成</a>
                <form style="display: inline-block;" action="{{ action('Admin\ItemController@index') }}" method="get">
                    <input type="submit" class="btn btn-primary" name="new" value="新着順">
                    <input type="submit" class="btn btn-primary" name="recommend" value="オススメ順">
                </form>
            </div>
            <div class="col-md-5">
                <form action="{{ action('Admin\ItemController@index') }}" method="get">
                    <div class="form-group row">
                        <div class="col-md-8" style="padding-bottom: 0.5rem;">
                            <input type="text" placeholder="アイテム名" class="form-control" name="cond_itemname" value="{{ $cond_itemname }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                		@foreach($posts as $item)
                			<div class="itembox">
                				<p class="itemimg" style="float: left; width: 250px;">
									@if($item->image_path)
                                        <img src="{{ $item->image_path }}">
                                    @endif
                                </p>
                                <div style="float: left; padding-left: 10px;">
                                    <p style="margin-bottom: 0; font-size: 12px;"><i class="far fa-clock mr-1"></i>{{ $item->created_at->format('Y.m.d') }}</p>
                                	<p style="border-bottom: 2px solid #9f8b52;"><i class="fas fa-user mr-1"></i>{{ \Str::limit($item->itemname, 100) }}</p>
                                    <p style="color: #fff; background-color: {{ $item->code }}; line-height: 1.5; width: 45%; margin-bottom: 0; text-align: center;">{{ $item->code }}</p>
                                    @if($item->colortype === 'sp')
                                        <p>イエローベース春
                                    @elseif($item->colortype === 'sm')
                                        <p>ブルーベース夏
                                    @elseif($item->colortype === 'au')
                                        <p>イエローベース秋
                                    @else
                                        <p>ブルーベース冬
                                    @endif
                                    @if($item->colortype === Auth::user()->pc)
                                        <span style="font-size: 10px">オススメ！</span>
                                    @endif
                                    </p>
                                    <p><a href="{{ action('Admin\ItemController@edit', ['id' => $item->id]) }}" class="btn btn-primary"><i class="fas fa-edit mr-1"></i>編集</a> <a class="btn btn-danger" data-toggle="modal" data-target="#testModal{{ $item->id }}" data-backdrop="true"><i class="fas fa-trash-alt mr-1"></i>削除</a></p>
                                </div>
                			</div>
						    <div class="modal fade" id="testModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
						        <div class="modal-dialog">
						            <div class="modal-content">
						                <div class="modal-header">
						                    <h4 class="modal-title" id="myModalLabel" style="color: #555;">削除確認</h4>
						                </div>
						                <div class="modal-body">
						                    <label style="color: #555;">{{ \Str::limit($item->itemname, 100) }}を削除しますか？</label>
						                </div>
						                <div class="modal-footer">
						                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
						                    <button type="button" class="btn btn-danger" onclick="location.href='{{ action('Admin\ItemController@delete', ['id' => $item->id]) }}'">削除</button>
						                </div>
						            </div>
						        </div>
						    </div>
                		@endforeach
                </div>
            </div>
        </div>
    </div>
@endsection