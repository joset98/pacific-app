<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MPage
{
  // Data of pages
  public $pages = null;
  public $perpage = null;
  public $truePerpage = null;
  public $position = null;
  public $model = null;
  public $items = null;

  // public $filters = null;
  // public $orders = null;

  function __construct($table, $position, $perpage, $truePerpage){
    $this->model      = DB::table($table);
    $this->position   = (int) $position;
    $this->perpage    = (int) $perpage;
    $this->truePerpage    = (int) $truePerpage;
  }


  function getItems($currentTable){
    // Calculate pages
    $this->pages = $this->model->count() / $this->truePerpage;
    if(!is_int($this->pages)) $this->pages = (int) $this->pages + 1;
    // Get items
    info(['pages'=> $this->pages,'total_data'=> $this->model->count(), 'trueperpages'=> $this->truePerpage,
          'postion' => $this->position]);
          
    //In case that the current table fetched is user table, take it the users without SoftDelete 
    $this->items = $this->model
    ->when($currentTable == 'users', function ($query) {
      $this->pages = $query->where('users.deleted_at', null)->count() / $this->truePerpage;
      if(!is_int($this->pages)) $this->pages = (int) $this->pages + 1;

      return $query->where('users.deleted_at', null);
    })    
    ->when($currentTable == 'sales', function ($query) {
      return $query->join('clients', 'clients.id','sales.client_id')
                    ->join('machines', 'machines.id','sales.machine_id')
                    ->join('sell_states', 'sell_states.id','sales.state_id')
                    ->select('machines.name as machine_name','clients.rut',
                    'clients.name as client_name','sales.id','sales.num_order','sell_states.name as sale_state');
    })    
    
    ->skip($this->position)->take($this->perpage)->get();

    return $this;
  }

  function getResult(){
    return [
      'items'       => $this->items,
      'pages'       => $this->pages,
      'perpage'     => $this->perpage,
      'position'    => $this->position
    ];
  }

  static function paginate($table, $params) {
    if(!$params['position']) $params['position'] = 0;
    if(!$params['perpage']) $params['perpage'] = 10;
    if($params['truePerpage'] == null) $params['truePerpage'] = $params['perpage'];

    $Paginator = new MPage($table, $params['position'], $params['perpage'], $params['truePerpage']);

    return $Paginator->getItems($table)
                     ->getResult();
  }

}
