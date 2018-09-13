<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repos\RoleRepo;
use Illuminate\Http\Request;
use Validator;

class RoleController extends BaseController
{
    /**
     * @param \App\Repos\RoleRepo $repo
     */
    public function __construct(RoleRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param $limit
     * @param $offset
     * @return \Illuminate\Http\Response
     */
    public function index($limit, $offset)
    {
        $items = $this->repo->findAll([], $limit, $offset);

        return response()->json(['data' => $items->toArray(), 'message' => null, 'error' => false], 200);
    }

    public function show($id)
    {
        $item = $this->repo->findOneBy($id);
        if ($item['notFounded']) {
            return response()->json(['data' => null, 'message' => 'Not Founded', 'error' => false], 404);
        }
        return response()->json(['data' => $item['data'], 'message' => '', 'error' => false], 200);

    }


    /**
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $item = $this->repo->create($data);
        if (!$item['valid']) {
            return response()->json(['data' => null, 'message' => $item['data'], 'error' => true], 405);
        }

        return response()->json(['data' => $item['data'], 'message' => 'Created Successfully', 'error' => false], 200);

    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = $this->repo->update($id, $data);
        if (!$item['valid']) {
            return response()->json(['data' => null, 'message' => $item['data'], 'error' => true], 405);
        }

        return response()->json(['data' => $item['data'], 'message' => 'Created Successfully', 'error' => false], 200);
    }

    public function storeUserRole(Request $request,$user_id)
    {
        $user = User::findOrFail($user_id);
        $data = $request->all();

        $Validator = Validator::make($data, [
            'role' => 'required|numeric'
        ]);

        if ($Validator->fails()) {
            return response()->json(['data' => null,'message' => $Validator->errors(),'error' => true], 405);
        }

        $role = $user->SetUserRole($data['role']);
        if($role){
            $user = User::with('roles')->findOrFail($user_id);
            return response()->json(['data' => $user->toArray(),'message' => 'Created Successfully','error' => false], 200);
        }else{
            return response()->json(['data' => null,'message' => 'something went wrong','error' => true], 405);
        }

    }
}
