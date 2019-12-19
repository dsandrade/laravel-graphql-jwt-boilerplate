<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Traits\DispatchesTactician;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class BaseJob implements ShouldQueue
{
    use Queueable,
        Dispatchable,
        SerializesModels,
        DispatchesTactician,
        InteractsWithQueue;
}
