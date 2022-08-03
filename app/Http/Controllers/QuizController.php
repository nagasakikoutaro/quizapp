<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    public function top()
    {
        //回答の保存データを初期化する
        $file = new \SplFileObject(storage_path('answer.csv'));
        $file->setFlags(\SplFileObject::READ_CSV | 
                       \SplFileObject::READ_AHEAD | 
                       \SplFileObject::SKIP_EMPTY | 
                       \SplFileObject::DROP_NEW_LINE);

     $result = new \SplFileObject(storage_path('answer.csv'), 'w');
     $answer=[];
     $result->fputcsv($answer);
        return view('top');
    }
    public function quiz($no)
    {
    //csvを読み込む
    $file = new \SplFileObject(storage_path('quiz.csv'));
    $file->setFlags(\SplFileObject::READ_CSV | 
                   \SplFileObject::READ_AHEAD | 
                   \SplFileObject::SKIP_EMPTY | 
                   \SplFileObject::DROP_NEW_LINE);
    
    $date = ['no'=>$no,'file'=>$file];
        return view('quiz',$date);
    }

    public function vote($no,Request $request)
    {
         //問題内容をcsvファイルから読み込む
        $file = new \SplFileObject(storage_path('quiz.csv'));
        $file->setFlags(\SplFileObject::READ_CSV | 
                    \SplFileObject::READ_AHEAD |
                    \SplFileObject::SKIP_EMPTY | 
                    \SplFileObject::DROP_NEW_LINE);
                   
        //csvファイルに書き込み
        $result = new \SplFileObject(storage_path('answer.csv'), 'a+');
        //送信した内容を読み取る
        $answer = [
                    $request->input('number'),
                    $request->input('choice'),
                    $request->input('answer'),
                  ];
        $result->fputcsv($answer);
        //quiz.blade.phpへ変数の受け渡し
        $date = ['no'=>$no,'file'=>$file];
        //全部で何行あるか数える
        $c=0;
        foreach ($file as $d ) {
            $c++;
        }
        //最終ページだったら結果へそれ以外は次の問題へ
        if ($no==$c){
            return redirect('/result');
        }
        else{
        return view('quiz',$date);
        }
    }
    public function result()
    {
        //csvファイルを読み込む
        $file = new \SplFileObject(storage_path('answer.csv'));
        $file->setFlags(\SplFileObject::READ_CSV | 
                    \SplFileObject::READ_AHEAD |
                    \SplFileObject::SKIP_EMPTY | 
                    \SplFileObject::DROP_NEW_LINE);
        //問題数と正解数をカウントする
        $count=0;
        $true=0;
        foreach ($file as $line ) {
        $count++;
        if($line[1]==$line[2]){
        $true++;
        }
        }
        $date=['count'=>$count,'true'=>$true];
        return view('result',$date);
    }
}
