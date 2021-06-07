<ul class="nav nav-tabs nav-justified mb-3">
    {{-- ユーザ詳細タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
            MyList
            <span class="badge badge-secondary">{{ $user->shoppinglists_count }}</span>
        </a>
    </li>
    {{-- 購入済一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.boughts', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.boughts') ? 'active' : '' }}">
            Boughts
            <span class="badge badge-secondary">{{ $user->boughts_count }}</span>
        </a>
    </li>
    {{-- 保留一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.stays', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.stays') ? 'active' : '' }}">
            Stays
            <span class="badge badge-secondary">{{ $user->stays_count }}</span>
        </a>
    </li>
</ul