<?php

namespace App\Http\Controllers;

use App\Models\Mypage;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ⭐️追加
    $tweets = Tweet::with('user')->latest()->get();
    return view('tweets.index', compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mypage $mypage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mypage $mypage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mypage $mypage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mypage $mypage)
    {
        //
    }
}
