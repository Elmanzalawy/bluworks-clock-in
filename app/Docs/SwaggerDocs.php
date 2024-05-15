<?php
namespace App\Docs;

/**
 * @OA\Post(
 *      path="/api/worker/clock-in",
 *      operationId="clockInWorker",
 *      tags={"Clock-in"},
 *      summary="Clock-in worker based on current coordinates and timestamp",
 *      description="Clock-in worker based on current coordinates and timestamp. Workers must be within 2 km distance to the target coordinates to be able to clock-in.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="JSON representation of the resource",
 *         @OA\JsonContent(
 *             required={"worker_id", "timestamp", "latitute", "longitude"},
 *             @OA\Property(
 *                  property="worker_id",
 *                  type="integer",
 *                  example="1",
 *                  description="ID of worker to clock-in"
 *             ),
 *             @OA\Property(
 *                  property="timestamp",
 *                  type="integer",
 *                  example=1715792159,
 *                  description="Current UNIX timestamp"
 *             ),
 *             @OA\Property(
 *                  property="latitude",
 *                  type="float",
 *                  example=30.0475552,
 *             ),
 *             @OA\Property(
 *                  property="longitude",
 *                  type="float",
 *                  example=31.2346024,
 *             )
 *         )
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(property="worker_id",      type="integer",     example="1"),
 *              @OA\Property(property="timestamp",      type="string",      example="2006-06-27T23:12:59.000000Z"),
 *              @OA\Property(property="latitude",       type="number",      example="32.01556"),
 *              @OA\Property(property="longitude",      type="number",      example="31.01556"),
 *          )
 *       ),
 *      @OA\Response(
 *          response=422,
 *          description="Validation error",
 *          @OA\JsonContent(
 *              @OA\Property(property="message",        type="string",      example="The worker id field is required."),
 *              @OA\Property(property="errors",         type="object",      example={"worker_id": "The worker id field is required", "timestamp": "The timestamp id field is required", "latitude": "The latitude id field is required", "longitude": "The longitude id field is required"}
*              ),
 *          )
 *      )
 *     )
 *
 *
 * @OA\Get(
 *      path="/api/worker/clock-ins",
 *      operationId="getClockIns",
 *      tags={"Clock-in"},
 *      summary="Get clock-ins associated with the worker_id",
 *      description="Returns list of clock-ins associated with a specific worker.",
 *     @OA\Parameter(
 *         in="query",
 *         name="worker_id",
 *         example=1,
 *         required=true,
 *         @OA\Schema(type="integer"),
 *     ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(property="worker_id",      type="integer",     example="1"),
 *              @OA\Property(property="timestamp",      type="string",      example="2006-06-27T23:12:59.000000Z"),
 *              @OA\Property(property="latitude",       type="number",      example="32.01556"),
 *              @OA\Property(property="longitude",      type="number",      example="31.01556"),
 *          )
 *       ),
 *      @OA\Response(
 *          response=422,
 *          description="Validation error",
 *          @OA\JsonContent(
 *              @OA\Property(property="message",        type="string",      example="The worker id field is required."),
 *              @OA\Property(property="errors",         type="object",      example={"worker_id": "The worker id field is required"}
 *              ),
 *          )
 *      )
 *     )
 */

class SwaggerDocs
{

}
