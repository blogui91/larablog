<?php

namespace Modules\Roles\Src\Listeners;

use Modules\Roles\Src\Events\UpdatedRoleRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;

class UpdatedRoleResponse implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UpdatedRoleRequest $event)
    {
        $user = $event->getRole();
    }

    public function failed(UpdatedRoleRequest $event, $exception)
    {
        //
    }
}