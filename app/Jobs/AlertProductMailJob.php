<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Mail\AlertProductMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AlertProductMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $gestionnaires = (object) User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'GESTIONNAIRE_DE_STOCK');
            }
        )->pluck('email');

        foreach ($gestionnaires as $key => $value) {
            if (!is_null($value->email)) {
                Mail::to($value->email)->send(new AlertProductMail($this->data));
            }
        }
    }
}
