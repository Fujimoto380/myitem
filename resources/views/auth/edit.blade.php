@extends('layouts.app')
@section('title', 'ユーザー情報の編集')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="background-color: #9b894d;"><p class="card-header">ユーザー情報編集</p></div>
                <div class="card-body">
                    <form method="POST" action="{{ action('Auth\EditController@update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $auth->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pc" class="col-md-4 col-form-label text-md-right">パーソナルカラー</label>
                            <div class="col-md-6">
                                <select class="form-control @error('pc') is-invalid @enderror" style="width: auto;" name="pc" autocomplete="pc">
                                    <option value="sp" {{ $auth->pc =='sp' ? 'selected="selected"' : '' }}>イエローベース春</option>
                                    <option value="sm" {{ $auth->pc =='sm' ? 'selected="selected"' : '' }}>ブルーベース夏</option>
                                    <option value="au" {{ $auth->pc =='au' ? 'selected="selected"' : '' }}>イエローベース秋</option>
                                    <option value="wn" {{ $auth->pc =='wn' ? 'selected="selected"' : '' }}>ブルーベース冬</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    編集
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
