<div class="top-line"></div>
<div class="slim-header">
    <div class="container">
        <div class="slim-header-left">
            <h2 class="slim-logo">
                <a href="/">
                    <img src="/img/mcud-logo.png" alt="">
                </a>
            </h2>
        </div>

        <div class="slim-header-right">
            <div class="nav">
                <ul>
                    <li>
                        <a class="{{ Request::is('/') ? 'active' : '' }}" href="/">Судалгаа</a>
                    </li>
                    <li>
                        <a class="{{ Request::is('tosk') ? 'active' : '' }}" href="/tosk">ТОСК хүсэлт</a>
                    </li>
                </ul>

                <ul>
                    <li>
                        <a class="{{ Request::is('list') ? 'active' : '' }}" href="/list">Орон сууцны жагсаалт</a>
                    </li>
                    <li>
                        <a class="{{ Request::is('legal') ? 'active' : '' }}" href="/legal">Дүрэм журам</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a class="{{ Request::is('news') ? 'active' : '' }}" href="/news">Мэдээ, мэдээлэл</a>
                    </li>
                    <li>
                        <a class="{{ Request::is('plan') ? 'active' : '' }}" href="/plan">Зураг төсөл</a>
                    </li>
                </ul>
            </div>

            @if(session()->get('auth'))
                @php
                    $user = session()->get('auth');
                @endphp
                <div class="auth">
                    <div class="dropdown dropdown-c">
                        <a href="#" class="logged-user" data-toggle="dropdown">
                            <img src="{{ $user->thumb or '/images/avatar.jpg' }}" alt="">
                            <span>{{ $user->first_name or $user->login }}</span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <nav class="nav">
                                <a href="/profile" class="nav-link"><i class="icon ion-person"></i>Хувийн мэдээлэл</a>
                                <a href="/customer/logout" class="nav-link"><i class="icon ion-forward"></i>Гарах</a>
                            </nav>
                        </div>
                    </div>
                </div>
            @else
                <div class="auth">
                    <a class="btn btn-outline-primary mg-b-10" href="/login">
                        <i class="ti ti-unlock"></i>
                        Нэвтрэх
                    </a>
                </div>
            @endif


            {{--<div class="demo-btn-list">--}}
                {{--<a href="#" class="btn btn-primary btn-icon rounded-circle">--}}
                    {{--<div><i class="ti ti-facebook"></i></div>--}}
                {{--</a>--}}
                {{--<a href="#" class="btn btn-info btn-icon rounded-circle">--}}
                    {{--<div><i class="ti ti-twitter"></i></div>--}}
                {{--</a>--}}
                {{--<a href="#" class="btn btn-danger btn-icon rounded-circle">--}}
                    {{--<div><i class="ti ti-google"></i></div>--}}
                {{--</a>--}}
            {{--</div>--}}


        </div>
    </div>
</div>
