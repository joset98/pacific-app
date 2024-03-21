<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\StoreRequest;
use App\Repositories\Providers\ProviderRepository;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    //
    public function __construct() {
        $this->repository = new ProviderRepository();
    }

    public function index(Request $request){
        $providers = $this->repository->getProviders(
            $request->only('position', 'perpage', 'truePerpage')
        );
        abort_if( !$providers, 500 ,'Error del servidor');
        
        return response()->json($providers, 200);
    }

    public function providerList(Request $request){
        $providers = $this->repository->getList();
        abort_if( !$providers, 500 ,'Error del servidor');
        
        return response()->json($providers, 200);
    }


    public function store (StoreRequest $request){
        $provider = $this->repository->create($request->validated());

        return response()->json($provider , 200);
    }

    public function update (StoreRequest $request){
        $provider = $this->repository->update(
            $request->id,
            $request->only('name','desc'));

        return response()->json($provider , 200);
    }
}
