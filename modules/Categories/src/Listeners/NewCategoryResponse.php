<?php

namespace Modules\Categories\Src\Listeners;

use Modules\Categories\Src\Events\NewCategoryRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NewCategoryResponse implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(NewCategoryRequest $event)
    {
        $category = $event->getCategory();
        
    }

    public function failed(NewCategoryRequest $event, $exception)
    {
        //
    }
}