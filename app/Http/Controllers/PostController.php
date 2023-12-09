<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost(Post $post) {
        if(auth()->user()->id === $post['user_id']) {
            $post->delete();
        }
        return redirect('/');
    }

    public function actuallyUpdatePost(Post $post, Request $request) {
        if(auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        $incomingfields = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);        

        $incomingfields['title'] = strip_tags($incomingfields['title']);
        $incomingfields['content'] = strip_tags($incomingfields['content']);

        $post->update($incomingfields);
        return redirect('/');
    }

    public function showEditScreen(Post $post) {
        if(auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

    public function makePost(Request $request) {
        $incomingfields = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $incomingfields['title'] = strip_tags($incomingfields['title']);
        $incomingfields['content'] = strip_tags($incomingfields['content']);
        $incomingfields['user_id'] = auth()->id();

        Post::create($incomingfields);

        return redirect('/');

    }
}
