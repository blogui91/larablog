<?php

namespace Modules\Roles\Src\Listeners;

use Modules\Roles\Src\Events\NewRoleRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NewRoleResponse implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(NewRoleRequest $event)
    {
        $role = $event->getRole();
        
    }

    public function failed(NewRoleRequest $event, $exception)
    {
        //
    }
}