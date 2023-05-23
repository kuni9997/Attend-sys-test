    <header class="">
        <div class='header-logo'>
            <h1 class="header-logo--title">Atte</h1>
            @auth
            <nav>
                <ul class="header-nav">
                    <li><a href="/">ホーム</a> </li>
                    <li><a href="/record">日付一覧</a></li>
                    <li>
                        <form action="{{ route('logout')}}" method="post">
                        @csrf
                            <a href="route('logout')" onclick="event.preventDefault(); 
                            this.closest('form').submit();">ログアウト</a>
                        </form>
                    </li>
                </ul>
            </nav>
            @endauth
        </div>
    </header>