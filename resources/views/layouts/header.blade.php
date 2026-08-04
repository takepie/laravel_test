
<header class="header">
    <div class="header-container">
        <div class="logo">
            <a href="{{ url('/') }}">Cytech EC</a>
        </div>

        <nav class="menu">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/mypage') }}">マイページ</a>

            <span class="user-name">
                ログインユーザー：TTUU
            </span>

            <a href="{{ route('logout') }}"
               class="logout-btn"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </nav>
    </div>
</header>