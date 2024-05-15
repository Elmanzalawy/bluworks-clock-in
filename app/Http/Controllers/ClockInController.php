<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClockInWorkerRequest;
use App\Models\ClockIn;
use App\Models\Worker;
use App\Services\GeolocationService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ClockInController extends Controller
{
    protected $geolocationService;

    public function __construct()
    {
        $this->geolocationService = new GeolocationService;
    }

    /**
     * Add clock-in to worker
     * Worker must be within 2km, otherwise clock-in will be rejected.
     *
     * @param  mixed $request
     * @throws HttpResponseException
     * @return JsonResponse
     */
    public function clockInWorker(ClockInWorkerRequest $request): JsonResponse
    {
        $worker = Worker::find($request->worker_id);

        // Get linear distance in kilometers between the worker and the default clock-in location:
        $linearDistanceKm = $this->geolocationService->getLinearDistance(
            $request->latitude,
            $request->longitude,
            ClockIn::TARGET_CLOCK_IN_LOCATION['lat'],
            ClockIn::TARGET_CLOCK_IN_LOCATION['lng']
        );

        // Return error if worker is outside the maximum clock-in distance:
        if ($linearDistanceKm > ClockIn::MAXIMUM_CLOCK_IN_DISTANCE_KM) {
            return response()->json([
                'error' => sprintf('You must be within %s kilometers to be able to clock-in', ClockIn::MAXIMUM_CLOCK_IN_DISTANCE_KM)
            ], 422);
        }

        // Save clock-in to database after validation:
        $worker->clockIns()->create($request->validated());

        // Return successful response:
        return response()->json($worker->clockIns()->latest()->first());
    }
}
