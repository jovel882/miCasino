<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Url;
use App\Models\Name;
use App\Models\Email;
use App\Models\Image;
use App\Models\Phone;
use App\Events\NewData;
use App\Models\Surname;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ValidateIsNew implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $data)
    {
        //
    }

    /**
     * The unique ID of the job.
     */
    public function uniqueId(): string
    {
        return hash('sha256', implode(';', $this->data));
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [
            'name_id' => Name::firstOrCreate(['name' => $this->data['nombre']])->id,
            'surname_id' => Surname::firstOrCreate(['surname' => $this->data['apellidos']])->id,
            'phone_id' => Phone::firstOrCreate(['phone' => $this->data['telefono']])->id,
            'email_id' => Email::firstOrCreate(['email' => $this->data['correo']])->id,
            'image_id' => Image::firstOrCreate(['url' => $this->data['imagen']])->id
        ];
        
        if (count(array_filter($data)) === count($data) && !Url::where($data)->first()) {
            Url::create($data);
            NewData::dispatch($this->data);
        }
    }
}
