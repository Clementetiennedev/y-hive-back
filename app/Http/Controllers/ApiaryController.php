<?php

namespace App\Http\Controllers;

use App\Models\Apiary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiaryController extends Controller
{
    public function index(): JsonResponse
    {
        $apiaries = Apiary::all();

        $apiaries->load('hives');

        return response()->json($apiaries);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            /**
             * @example rucher des abeilles
             */
            'name' => 'required|string|max:255',
            /**
             * @example 123 rue des abeilles
             */
            'location' => 'required|string|max:255',
            /**
             * @example rucher des abeilles
             */
            'description' => 'nullable|string',
        ]);

        $user = auth()->user();
        $apiary = $user->apiaries()->create($validated);

        return response()->json($apiary, 201);
    }

    public function show(Apiary $apiary): JsonResponse
    {
        return response()->json($apiary);
    }

    public function update(Request $request, Apiary $apiary): JsonResponse
    {
        $validated = $request->validate([
            /**
             * @example rucher des abeilles
             */
            'name' => 'sometimes|string|max:255',
            /**
             * @example 123 rue des abeilles
             */
            'location' => 'sometimes|string|max:255',
            /**
             * @example rucher des abeilles
             */
            'description' => 'nullable|string',
        ]);

        $apiary->update($validated);

        return response()->json($apiary);
    }

    public function destroy(Apiary $apiary): JsonResponse
    {
        $apiary->delete();

        return response()->json(['message' => 'Apiary deleted successfully']);
    }

    // hives

    public function storeHive(Request $request, Apiary $apiary): JsonResponse
    {
        $validated = $request->validate([
            /**
             * @example super ruche
             */
            'name' => 'required|string|max:255',
            /**
             * @example ruche
             */
            'type' => 'required|string|max:255',
            /**
             * @example 2025-01-01
             */
            'installation_date' => 'required|date',
        ]);

        $hive = $apiary->hives()->create($validated);

        return response()->json($hive, 201);
    }
}
