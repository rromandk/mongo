<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\BienvenidaMail;

class EnviarBienvenidaJob implements ShouldQueue
{
    use Queueable;
    public $user;
    public $tries = 3;      // 👈 número de intentos  del Job es específico y tiene prioridad del --tries del worker en .yml
    ///public $backoff = 10;   // 👈 segundos entre intentos

    public function backoff()
    {
        /*
        intento 1 → retry en 10s
        intento 2 → retry en 30s
        intento 3 → retry en 60s
        */
        return [10, 30, 60];
    }

  
    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         \Log::info('Enviando bienvenida a ' . $this->user->email);
         Mail::to($this->user->email)
            ->send(new BienvenidaMail($this->user));
    }

 
    public function failed(\Throwable $exception)
    {
        \Log::error('Fallo el job: ' . $exception->getMessage());
    }
}
