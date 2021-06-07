@if (count($shoppinglists) > 0)
    <ul class="list-unstyled">
        @foreach ($shoppinglists as $shoppinglist)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($shoppinglist->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザページへのリンク --}}
                        {!! link_to_route('users.show', $shoppinglist->user->name, ['user' => $shoppinglist->user->id]) !!}
                        <span class="text-muted">posted at {{ $shoppinglist->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($shoppinglist->content)) !!}</p>
                    </div>
                    <div>
                        @if (Auth::id() == $shoppinglist->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['shoppinglists.destroy', $shoppinglist->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $shoppinglists->links() }}
@endif