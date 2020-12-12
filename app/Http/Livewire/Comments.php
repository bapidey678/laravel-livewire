<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments;
    public $newComment;

    public function mount(){
        $intialComments = Comment::with('user')->get();
//        dd($intialComments);
        $this->comments = $intialComments;
    }

    public function addComment(){

        $createdComment = Comment::create(['body' => $this->newComment, 'user_id' => 3]);
//        dd($comment);
//        $createdComment->loadMissing('user');
        $this->comments->prepend($createdComment->latest()->first());
        $this->newComment = '';
    }

    public function remove($commentId){
        $comment = Comment::find($commentId);
        $comment->delete();
        $this->comments = $this->comments->except($commentId);
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
