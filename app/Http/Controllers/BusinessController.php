<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;

use App\Models\User;
use Inertia\Inertia;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        if (!$user->isAdmin()) {
            return $user->nusinesses;
        }
        return Business::all();
    }

    /**
     *
     * Returns a new empty business instance
     */
    public function create()
    {
        $business = new Business();
        return response()->json($business);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBusinessRequest $request)
    {
        $validated = $request->validated();
        if ($validated) {
            $business = new Business($validated);
            return response()->json($business);
        }
        return response()
            ->json(
                [
                    'message' => 'Error',
                    'errors' => $validated->errors()
                ],
                500
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        return response()->json($business);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        return response()->json($business);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusinessRequest $request, Business $business)
    {
        $validated = $request->validated();
        if ($validated) {
            $business->update($validated);
            return response()->json($business);
        }
        return response()
            ->json(
                [
                    'message' => 'Error',
                    'errors' => $validated->errors()
                ],
                500
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        $business->delete();
        return response()->json([
            'message' => 'Business deleted successfully'
        ]);
    }
}
