@extends('welcome')

@section('title', 'クイズ')

@section('content')

<h1>結果発表</h1>

<p>{{$count}}問中{{$true}}問正解でした。</p>
 
<a href="/">トップページに戻る。 </a>
@endsection