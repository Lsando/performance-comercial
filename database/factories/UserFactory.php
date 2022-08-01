<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuario::class;
    static $id;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'u_id' => $id + 1,
            'no_usuario' => $this->faker->name,
            'no_email' => $this->faker->unique()->safeEmail,
            'nu_matricula' => $this->faker->sentences(6, true),
            'nu_telefone' => null,
            'co_usuario_autorizacao' =>  0,
            'dt_alteracao' => null,
            'dt_nascimento' => date('Y-m-d'),
            'dt_admissao_empresa' => date('Y-m-d'),
            'dt_expiracao' => date('Y-m-d'),

        ];
    }
}
