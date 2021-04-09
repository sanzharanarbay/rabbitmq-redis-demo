<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\TestJob;
use App\Jobs\TestJobTwo;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{

    public function index(){
        $articles = Article::all();
        return response()->json($articles, 200);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|max:255',
            'author' => 'required',
            'description' => 'required|max:4000',
            'page_amount' => 'required|integer',
        ]);

        $model = Article::create($request->all());

        return response()->json(['message' => 'Article created successfully!'], 200);

    }

    public function queue(Request $request){
        $json = json_encode($request->all());
        TestJob::dispatch($json)->onConnection('rabbitmq');
        TestJobTwo::dispatch('Hello')->onConnection('rabbitmq');
    }

    public function redis(){
        Redis::hSet('hello', 'key1', 'hello');
        Redis::hmSet('hello', 'key1', 'hello','key2', 'world');
//       Cache::forever( 'cachekey', 'I am in the cache baby!' );
//        Cache::put('foo', 'bar', 600);
        Redis::set('name', 'Taylor');
//        Redis::del('name');
        $exist = Redis::hExists('hello', 'key1');
        $all = Redis::hGetall('hello');
        $value = Redis::hGet('hello', 'key1');
        $values = Redis::hmGet('hello', 'key1');
        $len = Redis::hLen('hello');
        $strlen = Redis::hStrlen('hello', 'key1');
        $keys = Redis::hKeys('hello');
        Redis::set('surname', 'Ivanov');
        $get = Redis::get('name');
        $time = Redis::expire('surname', 180);
        return response()->json($time, 200);
    }

}
