<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonRequest;
use App\Http\Resources\V1\PersonResource;
use App\Traits\HttpResponses;

class PersonController extends Controller
{
    use HttpResponses;

    public function index()
    {
        //Returns all the data from the table
        return PersonResource::collection(Person::all());

        //Return the data in pagination
        //return PersonResource::collection(Person::paginate(1));
    }

    public function show(Person $person)
    {
        //Returns all the column names of the table.
        //return $person;

        //Return spefic column names of the table. 
        return new PersonResource($person);
    }

    public function store(StorePersonRequest $request)
    {
        Person::create($request->validated());
        
        //return response()->json("Created Successfuly!");
        return $this->success();
    }

    public function update(StorePersonRequest $request, Person $person)
    {
        $person->update($request->validated());
        return response()->json("Updated Successfully!");
    }
    
    public function destroy(Person $person)
    {
        $person->delete();
        return response()->json("Deleted Successfully!");
    }
}
