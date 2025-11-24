<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://api-e-office-desa.tabalongkab.go.id/villages/dashboard');

        if ($response->successful()) {
            $this->info("Output API Smartdesa: " . $response->body());
        } else {
            $this->error("Gagal ambil IP");
        }
    }
}
