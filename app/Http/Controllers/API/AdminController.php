<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\API\CreateAdminRequest;
use App\Http\Requests\API\UpdateAdminRequest;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use ApiResponseHelpers;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->perPage ? $request->perPage : 10;

        $admins = User::where('role_id', 2)->with('createdBy')->paginate($perPage);
        $responseData = [
            "message" => "Successfully fetch admins",
            "results" => $admins,
            "links" => [
                "user" => "/admins/{id}"
            ]
        ];

        return $this->respondWithSuccess($responseData);
    }


    public function create(CreateAdminRequest $request): JsonResponse
    {
        $new_admin = new User();
        $new_admin->name = $request->name;
        $new_admin->email = $request->email;
        $new_admin->password = Hash::make($request->password);
        $new_admin->role_id = 2;
        $new_admin->created_by = Auth::guard('api')->id();
        $new_admin->save();

        $responseData = [
            "message" => "Successfully create a new admin",
            "results" => $new_admin,
            "links" => [
                "user" => "/admins/" . $new_admin->id
            ]
        ];

        return $this->respondWithSuccess($responseData);
    }

    public function update(UpdateAdminRequest $request, $id): JsonResponse
    {
        $update_admin = User::find($id);


        if (!$update_admin) {
            $responseData = [
                "message" => "Admin not found",
                "results" => null,
                "links" => [
                    "user" => "/admins/"
                ]
            ];

            return $this->respondWithSuccess($responseData);
        }

        $update_admin->name = $request->name;
        $update_admin->email = $request->email;
        $update_admin->password = Hash::make($request->password);
        $update_admin->update();

        $responseData = [
            "message" => "Successfully update an admin",
            "results" => $update_admin,
            "links" => [
                "user" => "/admins/" . $update_admin->id
            ]
        ];

        return $this->respondWithSuccess($responseData);
    }
}
