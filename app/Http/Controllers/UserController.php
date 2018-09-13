<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Repos\UserRepo;
use Illuminate\Http\Request;
use Validator;

class UserController extends BaseController
{
    /**
     * @param \App\Repos\UserRepo $repo
     */
    public function __construct(UserRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param $limit
     * @param $offset
     * @return \Illuminate\Http\Response
     */
    public function index($limit,$offset)
    {
        $items = $this->repo->findAll(['teams'],$limit,$offset );

        return response()->json(['data' => $items->toArray(), 'message' => null, 'error' => false], 200);
    }

    public function show($id)
    {
        $item = $this->repo->findOneBy($id,['teams']);
        if($item['notFounded']){
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

        $item = $this->repo->update($id,$data);
        if (!$item['valid']) {
            return response()->json(['data' => null, 'message' => $item['data'], 'error' => true], 405);
        }

        return response()->json(['data' => $item['data'], 'message' => 'Created Successfully', 'error' => false], 200);
    }

    public function storeUserTeam(Request $request,$user_id)
    {
        $user = User::with('teams')->findOrFail($user_id);
        $data = $request->all();
        $Validator = Validator::make($data, [
            'teams' => 'required|array'
        ]);
        if ($Validator->fails()) {
            return response()->json(['data' => null,'message' => $Validator->errors(),'error' => true], 405);
        }
        if(count($data['teams']) > 0){
            $user->setTeams($data['teams']);
        }
        $user = User::with('teams')->findOrFail($user_id);
        return response()->json(['data' => $user->toArray(),'message' => 'Created Successfully','error' => false], 200);

    }

    public function SetTeamOwner(Request $request,$user_id)
    {
        $user = User::findOrFail($user_id);
        $data = $request->all();

        $Validator = Validator::make($data, [
            'team' => 'required|numeric'
        ]);

        if ($Validator->fails()) {
            return response()->json(['data' => null,'message' => $Validator->errors(),'error' => true], 405);
        }

        $owner = $user->SetUserTeamOwner($data['team']);
        if($owner){
            $user = User::with('teams')->findOrFail($user_id);
            return response()->json(['data' => $user->toArray(),'message' => 'Created Successfully','error' => false], 200);
        }else{
            return response()->json(['data' => null,'message' => 'something went wrong','error' => true], 405);
        }

    }


}