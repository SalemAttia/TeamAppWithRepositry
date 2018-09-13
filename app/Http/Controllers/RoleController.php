<?php

namespace App\Http\Controllers;

use App\Repos\RoleRepo;
use Illuminate\Http\Request;

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
        $items = $this->repo->findAll(['users'], $limit, $offset);

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
}
