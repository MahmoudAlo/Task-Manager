<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{


  
    public function store(ProfileRequest $request)
    {
       $profile =Profile::create($request->validated());
        if ($request->hasFile('image')){
            $path=$request->file('image')->store('the profile photos','public');
            $profile['image']=$path;
        }
        return response()->json($profile,201);
    }

  
    public function show($id )
    {
        $profile = Profile::findOrFail($id);
        return response()->json($profile,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, $id)
    {
        $profile=Profile::findOrFail($id);
        $profile->update($request->only('phone','email','pio'));
        return response()->json($profile,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $profile=Profile::findOrFail($id);
       $profile->delete();
       return response()->json('deleted successfully');

    }
}
