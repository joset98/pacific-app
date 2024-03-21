<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

// Models
use app\Models\User;
// Repositories and Rules
use App\Repositories\Users\UserRepository;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
  public function __construct() {
    $this->repository = new UserRepository();
  }

  public function index(Request $request){
    $users = $this->repository->getUsers($request->only('position', 'perpage', 'truePerpage'));

    if(!$users) return response()->json('Error del servidor', 500);

    return response()->json($users, 200);
  }

  public function store(StoreRequest $request){
     $user = $this->repository->create($request->only('name','last_name', 'rut','email','password') + 
     ['username'=> $request->email] );
     return response()->json($user, 200);
  }
  
  public function update (UpdateRequest $request){
    $user = $this->repository->update(
        $request->id,
        $request->only('name','last_name', 'rut','email','password'));

    return response()->json($user , 200);
  }
  
  public function destroy(Request $request, $user_id){
    $userDeleted = User::where('id', $user_id)->delete();
    abort_if(!$userDeleted, 500 ,'Hubo un error, No fue posible eliminar el usuario');

    return response()->json($userDeleted, 200);
  }

  public function getMe(Request $request){
    abort_if(!Auth::user(), 500 ,'No fue posible eliminar el usuario');
    $user = User::find(Auth::user()->id);

    return response()->json($user, 200);
  }
  
}
