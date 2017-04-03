<?php

namespace Modules\Tags\Src\Listeners;

use Modules\Tags\Src\Events\UpdatedTagRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;

class UpdatedTagResponse implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UpdatedTagRequest $event)
    {
        $tag = $event->getTag();
    }

    public function failed(UpdatedTagRequest $event, $exception)
    {
        //
    }
}