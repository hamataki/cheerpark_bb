<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
    // 🔽 liked のデータも合わせて取得するよう修正
    $tweets = Tweet::with(['user', 'liked'])->latest()->get();
    // dd($tweets);
    return view('tweets.index', compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //⭐️追加
    return view('tweets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['tweet' => 'required|max:255',]);
        
        $request->user()->tweets()->create($request->all());
        // $request->user()->tweets()->create($request->only('tweet')); // ←これでもok
        
        return redirect()->route('tweets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet)
    {
        return view('tweets.show', compact('tweet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet)
  {
    return view('tweets.edit', compact('tweet'));
  }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweet)
  {
    $request->validate([
      'tweet' => 'required|max:255',
    ]);

    $tweet->update($request->only('tweet'));

    return redirect()->route('tweets.show', $tweet);
  }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet)
  {
    $tweet->delete();

    return redirect()->route('tweets.index');
  }
  
  public function mypage()
    {
        //⭐️追加
    $tweets = Tweet::with('user')->where('user_id', auth()->id())->latest()->get();
    $user = Auth::user(); // 認証済みユーザーの取得
    // ビューに$tweetsと$userの両方を渡す
    return view('tweets.mypage', compact('tweets', 'user'));
    }
}
