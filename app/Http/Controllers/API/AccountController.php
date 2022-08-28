<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateAccountRequest;
use App\Http\Requests\API\UpdateAccountRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AccountController extends Controller
{
    use ApiResponseHelpers;

    private $role_route;

    public function __construct()
    {
        $this->role_route = Route::currentRouteName();
        $this->middleware('auth:api');
    }

    public function getRoleId()
    {
        $role = Role::where('slug', $this->getRoleFromRouteName())->first();
        return $role->id;
    }

    public function getRoleFromRouteName()
    {
        $name = explode('.', $this->role_route)[0];
        return $name;
    }



    public function index(Request $request): JsonResponse
    {
        $perPage = $request->perPage ? $request->perPage : 10;
        $accounts = User::where('role_id', $this->getRoleId())->with('createdBy')->paginate($perPage);
        $responseData = [
            "message" => "Successfully fetch the accounts",
            "results" => $accounts,
            "links" => [
                "account" => env('APP_URL'). "api/" . $this->getRoleFromRouteName() ."/{id}"
            ]
        ];

        return $this->respondWithSuccess($responseData);
    }


    public function create(CreateAccountRequest $request): JsonResponse
    {
        $new_account = new User();
        $new_account->name = $request->name;
        $new_account->email = $request->email;
        $new_account->password = Hash::make($request->password);
        $new_account->role_id = $this->getRoleId();
        $new_account->created_by = Auth::guard('api')->id();
        $new_account->save();

        $responseData = [
            "message" => "Successfully create a new account",
            "results" => $new_account,
            "links" => [
                "account" => env('APP_URL'). "api/" . $this->getRoleFromRouteName() . "/" . $new_account->id
            ]
        ];

        return $this->respondWithSuccess($responseData);
    }

    public function update(UpdateAccountRequest $request, $id): JsonResponse
    {
        $update_account = User::find($id);

        if (!$update_account) {
            $responseData = [
                "message" => "Account not found",
                "results" => null,
                "links" => [
                    "accounts" => env('APP_URL') . "api/" . $this->getRoleFromRouteName()
                ]
            ];

            return $this->respondWithSuccess($responseData);
        } else {
            $update_account->name = $request->name ? $request->name : $update_account->name;
            $update_account->email = $request->email ? $request->email : $update_account->email;
            $update_account->password = $request->password ? Hash::make($request->password) : $update_account->password;

            $update_account->update();

            $responseData = [
                "message" => "Successfully update the account",
                "results" => $update_account,
                "links" => [
                    "account" => env('APP_URL'). "api/" . $this->getRoleFromRouteName() . "/" . $update_account->id
                ]
            ];

            return $this->respondWithSuccess($responseData);
        }
    }

     public function edit($id): JsonResponse
     {
         $edit_account = User::find($id);
         if (!$edit_account) {
             return $this->respondNotFound("Account not found");
         } else {
             $responseData = [
                 "message" => "Account detail for edit",
                 "results" => $edit_account,
                 "links" => [
                     "accounts" => env('APP_URL'). "api/" . $this->getRoleFromRouteName()
                ]
             ];

             return $this->respondWithSuccess($responseData);
         }
     }

     public function delete($id)
     {
         $delete_account = User::find($id);
         if (!$delete_account) {
             return $this->respondNotFound("Account not found");
         } else {
             $delete_account->delete();
             $responseData = [
                 "message" => "Successfully delete the account",
                 "results" => null,
                 "links" => [
                     "accounts" => env('APP_URL'). "api/" . $this->getRoleFromRouteName()
                ]
             ];

             return $this->respondWithSuccess($responseData);
         }
     }
}
