<?php

namespace Modules\Categories\Src\Listeners;

use Modules\Categories\Src\Events\UpdatedCategoryRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;

class UpdatedCategoryResponse implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UpdatedCategoryRequest $event)
    {
        $category = $event->getCategory();
    }

    public function failed(UpdatedCategoryRequest $event, $exception)
    {
        //
    }
}