<?php

namespace App\Http\Controllers;

use App\Http\Requests\Locations\CreateLocationRequest;
use App\Http\Requests\Locations\UpdateLocationRequest;
use App\Models\Location;
use Exception;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allLocations = Location::all();

        return $allLocations;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLocationRequest $request)
    {
        try {
            $createdLocation = Location::create($request->validated());

            return $createdLocation;
        }catch (Exception $e) {
            return response([
                'error' => true,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::find($id);

        if (!filled($location)) {
            return response([
                'error' => true,
                'message' => 'Localização não encontrada'
            ], 404);
        }

        return $location;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, string $id)
    {
        $dataForUpdate = $request->validated();

        if (!filled($dataForUpdate)) {
            return response([
                'error' => true,
                'message' => 'Não possui dados para atualizar'
            ], 404);
        }

        $location = Location::find($id);

        if (!filled($location)) {
            return response([
                'error' => true,
                'message' => 'Localização não encontrada'
            ], 404);
        }

        $location->update($dataForUpdate);

        return response([
            'error' => false,
            'message' => 'Localização atualizada com sucesso'
        ], 200);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::find($id);

        if (!filled($location)) {
            return response([
                'error' => true,
                'message' => 'Localização não encontrada'
            ], 404);
        }

        $location->delete();

        return response([
            'error' => false,
            'message' => 'Localização deletada'
        ], 200);
    }
}