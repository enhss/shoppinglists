@if (Auth::user()->is_stay($shoppinglist->id))
    {{-- 未保留ボタンのフォーム --}}
    {!! Form::open(['route' => ['stays.notstay', $shoppinglist->id], 'method' => 'delete']) !!}
        {!! Form::submit('Notstay', ['class' => "btn btn-secondary btn-sm"]) !!}
    {!! Form::close() !!}
@else
    {{-- 保留済ボタンのフォーム --}}
    {!! Form::open(['route' => ['stays.stay', $shoppinglist->id]]) !!}
        {!! Form::submit('Stay', ['class' => "btn btn-success btn-sm"]) !!}
    {!! Form::close() !!}
@endif