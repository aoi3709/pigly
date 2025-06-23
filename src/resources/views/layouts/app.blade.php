<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                PiGLy
            </a>
            <nav class="header-nav">
                <ul class="header-nav__list">
                    @if (Auth::check())
                    <li class="header-nav__item">
                        <a class="header-nav__link button--header-secondary" href="/weight_logs/goal_setting">
                            <span class="icon">⚙️</span> 目標体重設定
                        </a>
                    </li>
                    <li class="header-nav__item">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="header-nav__button button--header-secondary"> {{-- クラス名を変更 --}}
                                <span class="icon">➡️</span> ログアウト
                            </button>
                        </form>
                    </li>
                    @else
                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/register">新規登録</a>
                    </li>
                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/login">ログイン</a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')
</body>
</html>