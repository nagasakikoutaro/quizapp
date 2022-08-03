@extends('welcome')

@section('title', 'クイズ')

@section('content') 
   <!--パラメーターから値を取得-->
     <h1>第{{$no}}問</h1>
    <!--取得したデータを行で分ける-->
     @foreach ($file as $line ) 
    <!--パラメーターの値とあっていたらそのページの問題を表示する-->
    @if ($no == $line[0])
    <!--問題タイトルの表示-->
       {{$line[1];}}
<!--     <form action="/vote"method="post"> -->
     <form action="/quiz/{{$no +1}}" enctype="multipart/form-data"method="post">
     @csrf
     <input type="hidden" name="number" value={{$line[0];}}>
    <p><input name="choice" type="radio" value="1">{{$line[2];}}</p>
    <p><input name="choice" type="radio" value="2">{{$line[3];}}</p>
    <p><input name="choice" type="radio" value="3">{{$line[4];}}</p>
    <p><input name="choice" type="radio" value="4">{{$line[5];}}</p>
    <input type="hidden" name="answer" value={{$line[6];}}>
    @endif
    @endforeach
<input type="submit" value="次へ" >
</form> 
@endsection