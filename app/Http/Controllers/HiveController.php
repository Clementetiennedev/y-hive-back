<?php

namespace App\Http\Controllers;

use App\Models\Hive;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HiveController extends Controller
{
    public function index(): JsonResponse
    {
        $hives = Hive::all();

        return response()->json($hives);
    }

    public function show(Hive $hive): JsonResponse
    {
        return response()->json($hive);
    }

    public function update(Request $request, Hive $hive): JsonResponse
    {
        $validated = $request->validate([
            'apiairy_id' => 'sometimes|integer|exists:apiaries,id',
            /**
             * @example super ruche
             */
            'name' => 'sometimes|string|max:255',
            /**
             * @example ruche
             */
            'type' => 'sometimes|string|max:255',
            /**
             * @example 2025-01-01
             */
            'installation_date' => 'sometimes|date',
        ]);

        $hive->update($validated);

        return response()->json($hive);
    }

    public function destroy(Hive $hive): JsonResponse
    {
        $hive->delete();

        return response()->json(['message' => 'Hive deleted successfully']);
    }
}
