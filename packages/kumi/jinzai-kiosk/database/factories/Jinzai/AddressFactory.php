<?php

namespace Kumi\Jinzai\Database\Factories;

use Illuminate\Support\Str;
use Kumi\Jinzai\Models\Address;
use Kumi\Jinzai\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::factory(),

            'label' => $this->faker->randomElement(['Home', 'Work']),
            'country_code_3' => strtolower($this->faker->countryISOAlpha3()),
            'state' => $this->faker->randomElement([
                'Aceh',
                'Sumatra Utara',
                'Sumatra Barat',
                'Riau',
                'Jambi',
                'Kepulauan Riau',
                'Bengkulu',
                'Sumatra Selatan',
                'Kepulauan Bangka Belitung',
                'Lampung',
                'Banten',
                'Daerah Khusus Ibukota Jakarta',
                'Jawa Barat',
                'Jawa Tengah',
                'Daerah Istimewa Yogyakarta',
                'Jawa Timur',
                'Bali',
                'Nusa Tenggara Barat',
                'Nusa Tenggara Timur',
                'Kalimantan Barat',
                'Kalimantan Tengah',
                'Kalimantan Selatan',
                'Kalimantan Timur',
                'Kalimantan Utara',
                'Sulawesi Barat',
                'Sulawesi Selatan',
                'Sulawesi Tenggara',
                'Sulawesi Tengah',
                'Gorontalo',
                'Sulawesi Utara',
                'Maluku Utara',
                'Maluku',
                'Papua Barat',
                'Papua',
            ]),
            'city' => $this->faker->city(),
            'zip_code' => Str::before($this->faker->postcode(), '-'),
            'street_line_1' => $this->faker->streetAddress(),
        ];
    }
}
