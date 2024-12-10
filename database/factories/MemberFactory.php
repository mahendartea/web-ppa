<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique()->numerify('################'),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nickname' => $this->faker->firstName(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'gol_darah' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'provinsi' => $this->faker->state(),
            'kotakab' => $this->faker->city(),
            'kecamatan' => $this->faker->city(),
            'desa' => $this->faker->city(),
            'alamat' => $this->faker->address(),
            'alamat_saat_ini' => $this->faker->address(),
            'lokasi' => $this->faker->city(),
            'negara' => 'Indonesia',
            'agama' => $this->faker->randomElement(['islam', 'kristen', 'katolik', 'hindu', 'budha']),
            'pekerjaan' => $this->faker->jobTitle(),
            'telp' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement(['1', '0']),
        ];
    }
}
