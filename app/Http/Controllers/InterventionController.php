<?php

namespace App\Http\Controllers;

use App\Models\Apiary;
use App\Models\Hive;
use App\Models\Intervention;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterventionController extends Controller
{
    /**
     * Display a listing of the interventions.
     */
    public function index(): JsonResponse
    {
        $interventions = Intervention::all();

        return response()->json($interventions);
    }

    /**
     * Store a newly created intervention in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $userId = Auth::user()->id;

        $validated = $request->validate([
            'model_type' => 'required|string|in:hive,apiary|max:255',
            'model_id' => 'required|integer',
            'type' => 'required|string|max:255',
            'amount' => 'sometimes|numeric',
            'date' => 'required|date',
            'observations' => 'sometimes|string',
            'attachment_path' => 'sometimes|string',
        ]);

        $modelType = $validated['model_type'];
        $modelId = $validated['model_id'];

        $modelExists = match ($modelType) {
            'hive' => Hive::where('id', $modelId)->exists(),
            'apiary' => Apiary::where('id', $modelId)->exists(),
            default => false,
        };

        if (! $modelExists) {
            return response()->json(['error' => 'Model ID does not exist'], 400);
        }

        $validated['user_id'] = $userId;

        $intervention = Intervention::create($validated);

        return response()->json($intervention, 201);
    }

    /**
     * Display the specified intervention.
     */
    public function show(Intervention $intervention): JsonResponse
    {
        return response()->json($intervention);
    }

    /**
     * Update the specified intervention in storage.
     */
    public function update(Request $request, Intervention $intervention): JsonResponse
    {
        $validated = $request->validate([
            'model_type' => 'sometimes|string|in:hive,apiary|max:255',
            'model_id' => 'sometimes|integer',
            'type' => 'sometimes|string|max:255',
            'amount' => 'sometimes|numeric',
            'date' => 'sometimes|date',
            'observations' => 'sometimes|string',
            'attachment_path' => 'sometimes|string',
        ]);

        $modelType = $validated['model_type'];
        $modelId = $validated['model_id'];

        $modelExists = match ($modelType) {
            'hive' => Hive::where('id', $modelId)->exists(),
            'apiary' => Apiary::where('id', $modelId)->exists(),
            default => false,
        };

        if (! $modelExists) {
            return response()->json(['error' => 'Model ID does not exist'], 400);
        }

        $intervention->update($validated);

        return response()->json($intervention);
    }

    /**
     * Remove the specified intervention from storage.
     */
    public function destroy(Intervention $intervention): JsonResponse
    {
        echo $intervention;
        $intervention->delete();

        return response()->json(['message' => 'Intervention deleted successfully']);
    }
}
