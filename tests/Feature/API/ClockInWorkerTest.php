<?php

namespace Tests\Feature\API;

use App\Models\ClockIn;
use App\Models\Worker;
use Tests\TestCase;

class ClockInWorkerTest extends TestCase
{
    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Worker::factory(1)->create();
    }

    /**
     * test_worker_can_clock_in
     *
     * @return void
     */
    public function test_worker_can_clock_in(): void
    {
        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'timestamp' => 1715792159,
            'latitude' => 30.0475552,
            'longitude' => 31.2346024
        ]))->assertStatus(200);

        $this->assertEquals(1, ClockIn::count());
    }

    /**
     * test_worker_cannot_clock_in_outside_the_maximum_distance
     *
     * @return void
     */
    public function test_worker_cannot_clock_in_outside_the_maximum_distance(): void
    {
        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'timestamp' => 1715792159,
            'latitude' => 33.0475552,
            'longitude' => 35.2346024
        ]))->assertStatus(422);

        $this->assertEquals(0, ClockIn::count());
    }

    /**
     * test_worker_id_parameter_must_be_valid
     *
     * @return void
     */
    public function test_worker_id_parameter_must_be_valid(): void
    {
        $this->post(route('api.worker.clockInWorker', [
            'timestamp' => 1715792159,
            'latitude' => 30.0475552,
            'longitude' => 31.2346024
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('worker_id');

        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 'non-numeric-value',
            'timestamp' => 1715792159,
            'latitude' => 30.0475552,
            'longitude' => 31.2346024
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('worker_id');

        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 999,
            'timestamp' => 1715792159,
            'latitude' => 30.0475552,
            'longitude' => 31.2346024
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('worker_id');

        $this->assertEquals(0, ClockIn::count());
    }

    /**
     * test_timestamp_parameter_must_be_valid
     *
     * @return void
     */
    public function test_timestamp_parameter_must_be_valid(): void
    {
        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'timestamp' => '2024-05-15 17:00:00',
            'latitude' => 33.0475552,
            'longitude' => 35.2346024
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('timestamp');

        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'latitude' => 33.0475552,
            'longitude' => 35.2346024
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('timestamp');

        $this->assertEquals(0, ClockIn::count());
    }

    /**
     * test_latitude_parameter_must_be_valid
     *
     * @return void
     */
    public function test_latitude_parameter_must_be_valid(): void
    {
        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'timestamp' => 1715792159,
            'longitude' => 31.2346024
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('latitude');

        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'timestamp' => 1715792159,
            'latitude' => 'invalid-data-type',
            'longitude' => 31.2346024
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('latitude');

        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'timestamp' => 1715792159,
            'latitude' => -91,
            'longitude' => 31.2346024
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('latitude');

        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'timestamp' => 1715792159,
            'latitude' => 91,
            'longitude' => 31.2346024
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('latitude');

        $this->assertEquals(0, ClockIn::count());
    }

    /**
     * test_longitude_parameter_must_be_valid
     *
     * @return void
     */
    public function test_longitude_parameter_must_be_valid(): void
    {
        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'latitude' => 31.2346024,
            'timestamp' => 1715792159,
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('longitude');

        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'timestamp' => 1715792159,
            'latitude' => 31.2346024,
            'longitude' => 'invalid-data-type',
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('longitude');

        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'timestamp' => 1715792159,
            'latitude' => 31.2346024,
            'longitude' => -181,
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('longitude');

        $this->post(route('api.worker.clockInWorker', [
            'worker_id' => 1,
            'timestamp' => 1715792159,
            'latitude' => 31.2346024,
            'longitude' => 181,
        ]))->assertStatus(422)
            ->assertJsonValidationErrorFor('longitude');

        $this->assertEquals(0, ClockIn::count());
    }
}
