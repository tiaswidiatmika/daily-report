<?php

namespace Database\Factories;

use App\Models\Shift;
use App\Models\Report;
use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $shift = array_rand(Shift::all()->keyBy('id')->toArray());
        $division = array_rand( Division::all()->keyBy('id')->toArray() );
        // protected $fillable = ['shift_id', 'date', 'is_complete', 'division_id'];
        return [
            'shift_id' => $shift,
            'date' => $this->faker->date('l, d F Y'),
            'is_complete' => array_rand([0,1]),
            'division_id' => $division
        ];
    }
}
