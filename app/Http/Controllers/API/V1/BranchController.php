<?php

namespace App\Http\Controllers\API\V1;

use App\Models\tblBranch;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Resources\V1\BranchResource;

class BranchController extends Controller
{
    use HttpResponses;

    public function index()
    {
        try {
            return BranchResource::collection(tblBranch::all());
        }
        catch(Exception $ex) {
            throw new Exception($this->error('', $ex->getMessage(), 500));
        }
    }

    public function show(tblBranch $branch)
    {
        try {
            return new BranchResource($branch);
        }
        catch(Exception $ex) {
            throw new Exception($this->error('', $ex->getMessage(), 500));
        }
    }

    public function store(StoreBranchRequest $request)
    {
        try {
            tblBranch::create($request->validated());
            return $this->success();
        }
        catch(Exception $ex) {
            throw new Exception($this->error('', $ex->getMessage(), 500));
        }
    }

    public function update(StoreBranchRequest $request, tblBranch $branch)
    {
        try {
            $branch->update($request->validated());

            // return response()->json("Updated Successfully!");
            return $this->success();
        }
        catch(Exception $ex) {
            throw new Exception($this->error('', $ex->getMessage(), 500));
        }
    }
    
    public function destroy(tblBranch $branch)
    {
        try {
            $branch->delete();

            // return response()->json("Deleted Successfully!");
            return $this->success();
        }
        catch(Exception $ex) {
            throw new Exception($this->error('', $ex->getMessage(), 500));
        }
    }
}
