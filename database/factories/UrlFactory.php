<?php

namespace Database\Factories;

use App\Models\Url;
use App\Models\Name;
use App\Models\Email;
use App\Models\Image;
use App\Models\Phone;
use App\Models\Surname;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Url>
 */
class UrlFactory extends Factory
{
    protected $model = Url::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_id' => Name::factory(),
            'surname_id' => Surname::factory(),
            'phone_id' => Phone::factory(),
            'email_id' => Email::factory(),
            'image_id' => Image::factory(),
        ];
    }
}
