<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\DoctorSetTime;

class DeleteDoctorAppointments extends Command
{
    protected $signature = 'appointments:delete';

    protected $description = 'Delete "not set" appointments for doctors at the end of the day';

    public function handle()
    {
        // Get the current date
        $date = Carbon::now()->toDateString();

        // Delete "not set" appointments for doctors
        DoctorSetTime::where('status', 'not set')->whereDate('date', $date)->delete();

        $this->info('Doctor appointments deleted successfully.');
    }
}
