<?php

namespace Tests\Unit;

use App\Models\ClockIn;
use App\Services\GeolocationService;
use PHPUnit\Framework\TestCase;

class GetLinearDistanceTest extends TestCase
{
    protected $geolocationService;

    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->geolocationService = new GeolocationService;
    }

    /**
     * Test it returns correct value in km
     *
     * @return void
     */
    public function test_it_returns_correct_value(): void
    {
        $linearDistance = $this->geolocationService->getLinearDistance(
            32.1324,
            31.1234,
            ClockIn::TARGET_CLOCK_IN_COORDINATES['lat'],
            ClockIn::TARGET_CLOCK_IN_COORDINATES['lng'],
        );

        $this->assertEquals(231.89, round($linearDistance, 2));
    }

    /**
     * test it throws exception if any of the parameters is invalid
     *
     * @return void
     */
    public function test_it_throws_exception_if_any_of_the_parameters_is_invalid(): void
    {
        try{
            $linearDistance = $this->geolocationService->getLinearDistance(
                132.1324,
                231.1234,
                ClockIn::TARGET_CLOCK_IN_COORDINATES['lat'],
                ClockIn::TARGET_CLOCK_IN_COORDINATES['lng'],
            );
        }
        catch(\Exception $e)
        {
            $this->assertEquals('invalid coordinates', $e->getMessage());
        }
    }
}
