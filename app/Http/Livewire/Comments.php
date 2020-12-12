<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
//    public $comments;
    public $newComment;

    public function mount(){
//        $intialComments = Comment::with('user')->get();
//        dd($intialComments);
//        $this->comments = $intialComments;
    }

    protected $rules = [
        'newComment' => 'required|max:255',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addComment(){
        $this->validate();
        $createdComment = Comment::create(['body' => $this->newComment, 'user_id' => 3]);
//        dd($comment);
//        $createdComment->loadMissing('user');
//        $this->comments->prepend($createdComment->latest()->first());
        $this->newComment = '';
        session()->flash('message', 'Comment Added Successfully! ✌');
    }

    public function remove($commentId){
        $comment = Comment::find($commentId);
        $comment->delete();
//        $this->comments = $this->comments->except($commentId);
        session()->flash('delete', 'Comment Deleted Successfully! 😒');
    }

    public function render()
    {
        return view('livewire.comments',
            ['comments'=> Comment::with('user')->latest()->paginate(3)] );
    }
}
