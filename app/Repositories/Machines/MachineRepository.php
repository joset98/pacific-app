<?php

namespace App\Repositories\Machines;

// Models
use App\Models\Machine;

// Helpers
use App\Helpers\MPage;

class MachineRepository
{

  public function create($data) {
    // Create machine
    return Machine::create($data);
  }

  public function getMachines($params) {
    $pagination = MPage::paginate('machines', $params);
    return $pagination;
  }

  public function getList() {
    $itemList = Machine::all();
    return $itemList;
  }


  public function update($id,$data) {
    // Create provider
    return Machine::where('id' , $id)->update($data);
  }

}
