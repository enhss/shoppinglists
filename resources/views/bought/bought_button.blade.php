@if (Auth::user()->is_bought($shoppinglist->id))
    {{-- 未購入ボタンのフォーム --}}
    {!! Form::open(['route' => ['boughts.notbought', $shoppinglist->id], 'method' => 'delete']) !!}
        {!! Form::submit('Notbought', ['class' => "btn btn-secondary btn-sm"]) !!}
    {!! Form::close() !!}
@else
    {{-- 購入済ボタンのフォーム --}}
    {!! Form::open(['route' => ['boughts.bought', $shoppinglist->id]]) !!}
        {!! Form::submit('Bought', ['class' => "btn btn-primary btn-sm"]) !!}
    {!! Form::close() !!}
@endif