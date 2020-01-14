<?php
//为以类的方式定义控制台命令
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\FasterTool;

class Kernel extends ConsoleKernel
{
    /**
     * 正在提供服务的命令供应商
     *
     * @var array
     */
    protected $commands = [
        //
        FasterTool::class
    ];

    /**
     * 定义命令的时间表.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * 为应用注册基于闭包的命令.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
