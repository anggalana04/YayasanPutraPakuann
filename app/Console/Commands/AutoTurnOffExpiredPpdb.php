<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PpdbManagementPhase;
use Carbon\Carbon;

class AutoTurnOffExpiredPpdb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ppdb:auto-turnoff-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically turn off PPDB for periods that have ended';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Find all phases marked as live where end_date has passed
        $expiredPhases = PpdbManagementPhase::where('is_live', true)
            ->where('end_date', '<', $now)
            ->get();

        if ($expiredPhases->isEmpty()) {
            $this->info('No expired PPDB periods found. All PPDB settings are current.');
            return 0;
        }

        $count = 0;
        foreach ($expiredPhases as $phase) {
            $phase->is_live = false;
            $phase->save();
            $count++;
            $this->warn("✓ Turned off: {$phase->phase_name} (Period ended: {$phase->end_date->format('d M Y H:i')})");
        }

        $this->info("\n✓ Successfully turned off {$count} expired PPDB period(s).");
        return 0;
    }
