@extends('layouts.guest')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}"> {{-- 既存のregister.cssを使用 --}}
@endsection

@section('content')
<div class="register__content">
    <div class="register-form__heading">
        <h1 class="logo">PiGLy</h1>
        <h2>新規会員登録</h2>
        <h3>STEP1 アカウント情報の登録</h3>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form class="form" action="{{ route('register.processStep1') }}" method="post" novalidate>
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="名前を入力" />
                </div>
                <div class="form__error">
                    @error('name')
                        @foreach ($errors->get('name') as $message)
                            <div>{{ $message }}</div>
                        @endforeach
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力" />
                </div>
                @error('email')
                    <div class="form__error">
                        @foreach ($errors->get('email') as $message)
                            <div>{{ $message }}</div>
                        @endforeach
                    </div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" name="password" placeholder="パスワードを入力" />
                </div>
                <div class="form__error">
                    @error('password')
                        @foreach ($errors->get('password') as $message)
                            <div>{{ $message }}</div>
                        @endforeach
                    </div>
                @enderror
            </div>
        </div>
        
        <div class="form__button">
            <button class="form__button-submit" type="submit">次に進む</button>
        </div>
    </form>
    <div class="login-link">
        <a href="{{ route('login') }}">ログインはこちら</a>
    </div>
</div>
@endsection