<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    const PAGINATION = 15;

    /**
     * post 一覧ページ
     * @param  Request $request
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $posts = Post::search($request)->paginate(self::PAGINATION);
        return view('post.index', compact('posts'));
    }

    /**
     * post 新規登録ページ
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('post.edit');
    }

    /**
     * post 新規登録保存処理
     * @param  ClientRequest $request
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        //ここに保存処理を追記

        return redirect()->route('post.show', compact('post'))->with('success', __('message.success'));
    }

    /**
     * post 詳細ページ
     * @param  Client $client
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * post 編集ページ
     * @param  Client $client
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * post 更新処理
     * @param  ClientRequest $request
     * @param  Client $client
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        //ここに保存処理を追記
        return back()->with('success', __('message.success'));
    }

    /**
     * post 削除処理
     * @param  Client $client
     * @return  \Illuminate\Http\RedirectResponse
     * @throws  \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', __('message.success'));
    }
}
