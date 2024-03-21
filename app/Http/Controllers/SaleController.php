<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Sale\StoreRequest;
use App\Repositories\Sales\SaleRepository;
use App\Events\SaleSaved;
use App\Repositories\Clients\ClientRepository;

class SaleController extends Controller
{
    //
        //
    public function __construct() {
        $this->repository = new SaleRepository();
    }

    public function index(Request $request){
        $sales = $this->repository->getSales(
            $request->only('position', 'perpage', 'truePerpage')
        );
        abort_if( !$sales, 500 ,'Error del servidor');
        // $sales = [];
        
        return response()->json($sales, 200);
    }

    public function store (StoreRequest $request){
        $sale = $this->repository->create($request->only('price', 'num_order','machine_detail',
                        'adition','machine_id','model','desc','provider_id')
                        + ['user_id' => auth()->user()->id, 'state_id' => 1]
                    );
        if ($request->hasFile('documentFile')) {
            $name = $request->file('documentFile')->getClientOriginalName();
            $path = $request->documentFile->storeAs('uploads/sales/'. $sale->id , $name );
            $this->repository->addFile( $sale, $path);
        }
        SaleSaved::dispatch( $sale, $request->only('name','rut','contact','business_name','address') );

        return response()->json($sale , 200);
    }

    public function update (StoreRequest $request){
        $client = json_decode($request->client, true);
        info($request->all());

        $sale = $this->repository->update(
            $request->id,
            $request->only('price', 'num_order','machine_detail',
                        'adition','machine_id','model','desc','provider_id','state_id'));
        info('sin errores');
        info($sale);
        (new ClientRepository())->update($client['id'], $client);

        if ($request->hasFile('documentFile')) {
            $name = $request->file('documentFile')->getClientOriginalName();
            $path = $request->documentFile->storeAs('uploads/sales/'.$request->id , 
                                    now()->format('Ymdhis'). $name );
            $this->repository->addFile( $sale, $path);
        }
        

        // return response()->json($sale , 200);
        return response()->json('nada' , 200);
    }

    public function show (Request $request, $sale){
        $saleData = $this->repository->show($sale);
        
        return response()->json($saleData , 200);
    }

    public function showEdit ($sale){
        $saleData = $this->repository->showEdit($sale);
        
        return response()->json($saleData , 200);
    }

}
