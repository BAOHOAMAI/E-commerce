<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCountry()
    {
        $country = new Country();

        $countryData = $country -> getCountry();

        return view('admin.country.country' , compact('countryData'));
    }


    public function getAddCountry()
    {
        return view('admin.country.addCountry');
    }

    public function uploadCountry(Request $request)
    {
        $country = new Country();

        $data = [$request -> country];

        $countryData = $country -> addCountry($data);

        return redirect()->route('country');
    }

    /**
     * Display the specified resource.
     */
    public function deleteCountry($id)
    {
        $country = new Country();

        $countryData = $country -> deleteCountry($id);

        return redirect()->route('country');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
