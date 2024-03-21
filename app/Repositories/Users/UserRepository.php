<?php

namespace App\Repositories\Users;

// Laravel
use Illuminate\Support\Facades\Hash;

// Models
use App\Models\User;

// Helpers
use App\Helpers\MPage;

class UserRepository
{

  public function create($data) {
    // Encrypting password
    $data['password'] = Hash::make($data['password']);
    // Create user
    return User::create($data);
  }

  public function getUsers($params) {
    $pagination = MPage::paginate('users', $params);
    return $pagination;
  }

  public function update($id,$data) {
    // Create provider
    return User::where('id' , $id)->update($data);
  }

}
