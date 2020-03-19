<?php

namespace Tests\Unit;

use App\Participation;
use PHPUnit\Framework\TestCase;

class ParticipationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_create_participation() {

        $data = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'value' => rand(1, 20)
        ];

        $this->post(route('participation.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }


    public function test_can_list_participation() {
        $parts = factory(Participation::class, 2)->create()->map(function ($part) {
            return $part->only(['id', 'first_name', 'value']);
        });

        $this->get(route('participation.index'))
            ->assertStatus(200)
            ->assertJson($parts->toArray())
            ->assertJsonStructure([
                '*' => [ 'id', 'first_name', 'value' ],
            ]);
    }
}
