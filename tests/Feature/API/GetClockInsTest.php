<?php

namespace Tests\Feature\API;

use App\Models\Worker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetClockInsTest extends TestCase
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
     * test_worker_can_get_his_clock_ins
     *
     * @return void
     */
    public function test_worker_can_get_his_clock_ins(): void
    {
        $this->get(route('api.worker.getClockIns', [
            'worker_id' => 1,
        ]))->assertStatus(200);
    }

    /**
     * test_worker_id_parameter_must_be_valid
     *
     * @return void
     */
    public function test_worker_id_parameter_must_be_valid(): void
    {
        $this->get(route('api.worker.getClockIns'))->assertStatus(422);

        $this->get(route('api.worker.getClockIns', [
            'worker_id' => 999,
        ]))->assertStatus(422);

        $this->get(route('api.worker.getClockIns', [
            'worker_id' => 'invalid-worker-id',
        ]))->assertStatus(422);
    }

}
