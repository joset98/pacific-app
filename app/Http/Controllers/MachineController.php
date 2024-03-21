<?php

namespace App\Http\Controllers;

use App\Http\Requests\Machine\StoreRequest;
use App\Repositories\Machines\MachineRepository;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    //
    public function __construct() {
        $this->repository = new MachineRepository();
    }

    public function index(Request $request){
        $machines = $this->repository->getMachines(
            $request->only('position', 'perpage', 'truePerpage')
        );
        abort_if( !$machines, 500 ,'Error del servidor');
        
        return response()->json($machines, 200);
    }

    public function machineList(Request $request){
        $machines = $this->repository->getList();
        abort_if( !$machines, 500 ,'Error del servidor');
        
        return response()->json($machines, 200);
    }


    public function store (StoreRequest $request){
        $machine = $this->repository->create($request->validated());

        return response()->json($machine , 200);
    }
    
    public function update (StoreRequest $request){
        $machine = $this->repository->update(
            $request->id,
            $request->only('name','desc'));

        return response()->json($machine , 200);
    }
}
