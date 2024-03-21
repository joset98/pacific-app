<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellState\StoreRequest;
use App\Repositories\SellStates\SellStateRepository;
use Illuminate\Http\Request;

class SellStateController extends Controller
{
    //

    public function __construct() {
        $this->repository = new SellStateRepository();
    }

    public function index(Request $request){
        $sellStates = $this->repository->getSellStates(
            $request->only('position', 'perpage', 'truePerpage')
        );
        abort_if( !$sellStates, 500 ,'Error del servidor');
        return response()->json($sellStates, 200);
    }

    public function sellStateList(Request $request){
        $sellStates = $this->repository->getList();
        abort_if( !$sellStates, 500 ,'Error del servidor');
        
        return response()->json($sellStates, 200);
    }

    public function store (StoreRequest $request){
        $sellState = $this->repository->create($request->only('name', 'desc'));

        return response()->json($sellState, 200);
    }
    
    public function update (StoreRequest $request){
        $sellState = $this->repository->update(
            $request->id,
            $request->only('name','desc'));

        return response()->json($sellState , 200);
    }
}
