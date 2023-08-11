<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Kumi\Jinzai\Jobs\InitializeMonthlyPayoutsJob;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->everyMinute();

        $schedule
            ->job(new InitializeMonthlyPayoutsJob())
            ->monthlyOn(1, '10:00')
            ->withoutOverlapping()
        ;

        $schedule
            ->job(new \Kumi\Sousa\Jobs\VesselPro\InitializeSynchronizeVesselTracksJob())
            ->hourly()
            ->withoutOverlapping()
        ;

        $schedule
            ->job(new \Kumi\Sousa\Jobs\GeoTrack\InitializeSynchronizeVesselTracksJob())
            ->hourly()
            ->withoutOverlapping()
        ;

        $schedule
            ->job(new \Kumi\Sousa\Jobs\ArgosMonitoring\InitializeSynchronizeVesselTracksJob())
            ->hourly()
            ->withoutOverlapping()
        ;

        $schedule
            ->job(new \Kumi\Norikumi\Jobs\SendExpiringCrewContractNotificationJob())
            ->daily()
        ;

        $schedule
            ->job(new \Kumi\Norikumi\Jobs\SendExpiringDocumentNotificationJob())
            ->daily()
        ;

        $schedule
            ->job(new \Kumi\Jinzai\Jobs\SendExpiringEmployeeContractNotificationJob())
            ->daily()
        ;
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return null|\DateTimeZone|string
     */
    protected function scheduleTimezone()
    {
        return 'Asia/Jakarta';
    }
}
