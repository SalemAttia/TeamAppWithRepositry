<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemException;
use App\Repos\AbstractRepo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * @var AbstractRepo
     */
    public $repo;



    /**
     * @param Request $request
     * @param null $item_id
     *
     * @return \Illuminate\View\View
     */
    public function delete(Request $request, $item_id = null)
    {
        try {
            $this->repo->delete($item_id);
        } catch (SystemException $e) {
            return response([
                'data' => null,
                'message' => $e->getMessage(),
                'error' => true
            ], 400);
        } catch (\Exception $e) {
            return response([
                'data' => null,
                'message' => app()->environment('production') ? 'Item cannot be deleted!' : $e->getMessage(),
                'error' => true,
            ], 500);
        }

        return response(['data' => null,'message' => 'Item deleted successfully!', 'error' => false], 200);
    }
}
