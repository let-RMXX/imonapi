<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(): View
    {
        $comments = Comment::latest()->paginate(5);

        return view('comments.index', compact('comments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('comments.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $input = $request->all();

        Comment::create($input);

        return redirect()->route('comments.index')->with('success', 'Comment created successfully.');
    }

    public function show(Comment $comment): View
    {
        return view('comments.show', compact('comment'));
    }

    public function edit(Comment $comment): View
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment): RedirectResponse
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $input = $request->all();

        $comment->update($input);

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully');
    }
}

