<?php

namespace Modules\Tags\Src\Listeners;

use Modules\Tags\Src\Events\NewTagRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NewTagResponse implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(NewTagRequest $event)
    {
        $tag = $event->getTag();
        
    }

    public function failed(NewTagRequest $event, $exception)
    {
        //
    }
}