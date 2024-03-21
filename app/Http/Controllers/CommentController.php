<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Comments\CommentRepository;


class CommentController extends Controller
{
    public function __construct() {
        $this->repository = new CommentRepository();
    }

    public function store ( Request $request){
        info($request->all());
        $comment = $this->repository->create($request->only('sale_id','comment')
                        + ['user_id' => auth()->user()->id]
                    );

        return response()->json($comment , 200);
    }

    public function showSaleComments($sale_id){
        info($sale_id);
        $comments = $this->repository->fetchComments($sale_id);        
        return response()->json($comments , 200);

    }
}
