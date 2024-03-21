<?php

namespace App\Repositories\Providers;

// Models
use App\Models\Provider;

// Helpers
use App\Helpers\MPage;

class ProviderRepository
{

  public function create($data) {
    // Create provider
    return Provider::create($data);
  }

  public function getProviders($params) {
    $pagination = MPage::paginate('providers', $params);
    return $pagination;
  }

  public function getList() {
    $itemList = Provider::all();
    return $itemList;
  }

  public function update($id,$data) {
    // Create provider
    return Provider::where('id' , $id)->update($data);
  }


}
