<?php

namespace App\Repositories\Sales;

// Models
use App\Models\Sale;

// Helpers
use App\Helpers\MPage;
use Illuminate\Support\Facades\DB;

class SaleRepository
{

  public function create($data) {
    // Create Sale
    return Sale::create($data);
  }

	public function getSales($params) {
		$pagination = MPage::paginate('sales', $params);
		return $pagination;
  	}

  	public function update( $id ,$data) {
		// update Sale
		$saleUpdated = Sale::find( $id );
		abort_if( !$saleUpdated->update($data) , 500 ,'Hubo un error al tratar de actualizar');

		return  $saleUpdated;
	}
  
	public function show($id) {
		// find Sale
		$sale = Sale::with('documents')->find($id); 
		$sale->documents->each(function ( $item, $key ){
			$item->document = asset( $item->document);
			$item->created_date =  $item->created_at->format('Y-m-d');

		});
		return $sale;
	}

	public function showEdit($id) {
		// find Sale
		$sale = Sale::find($id); 
		return 
		[
			'id' => $sale->id,
			'price' => $sale->price,
			'num_order' => $sale->num_order,
			'provider_id' => $sale->provider_id,
			'machine_id' => $sale->machine_id,
			'model' => $sale->model,
			'adition' => $sale->adition,
			'machine_detail' => $sale->machine_detail,
			'desc' => $sale->desc,
			'state_id' => $sale->state_id,
			'client' => $sale->client,
		];
	}

	public function addFile(Sale $sale , $path){
		$doc = $sale->documents()->create([
		'document' => $path
		]);
		return $doc;

	} 

}
