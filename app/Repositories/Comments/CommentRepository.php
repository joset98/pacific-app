<?php

namespace App\Repositories\Comments;

// Models
use App\Models\Comment;

// Helpers
use Illuminate\Support\Facades\DB;

class CommentRepository
{

  public function create($data) {
    // Create Sale
    return Comment::create($data);
  }

  public function fetchComments($sale_id){
    $comments = Comment::where('sale_id', $sale_id)->with('user')->get();
    info($comments);

    return $comments;

  }
  
}
