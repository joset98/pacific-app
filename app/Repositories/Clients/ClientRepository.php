<?php

namespace App\Repositories\Clients;

// Models

use App\Models\Client;

// Helpers
use Illuminate\Support\Facades\DB;


class ClientRepository
{

  public function create($data) {
    // Create Sale
    return Client::create($data);
  }

  public function associateSale($sale, $dataClient){
    $client = Client::create($dataClient);
    $sale->client()->associate($client);
    $sale->save();
    return $dataClient;
  }

  public function update( $id ,$data) {
    // update Sale
    return Client::where('id' , $id)->update($data);
  }

}
