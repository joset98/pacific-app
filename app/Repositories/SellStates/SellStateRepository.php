<?php

namespace App\Repositories\SellStates;

// Models
use App\Models\SellState;

// Helpers
use App\Helpers\MPage;

class SellStateRepository
{

  public function create($data) {
    // Create sell_state
    return SellState::create($data);
  }

  public function getSellStates($params) {
    $pagination = MPage::paginate('sell_states', $params);
    return $pagination;
  }

  public function getList() {
    $itemList = SellState::all();
    return $itemList;
  }


  public function update($id,$data) {
    // Create provider
    return SellState::where('id' , $id)->update($data);
  }

}
