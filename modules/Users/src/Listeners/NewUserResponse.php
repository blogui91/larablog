<?php

namespace Modules\Users\Src\Listeners;

use Modules\Users\Src\Events\NewUserRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;

use Modules\Users\Src\Emails\NewUserCreatedByAdmin;

class NewUserResponse implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(NewUserRequest $event)
    {
        $user = $event->getUser();
        $params = $event->getParams();
        if($params['created_by_admin'] && $user->activated){
        	$user->pw_temp = $params['pw_temp'];
        	Mail::to($user->email)->send(new NewUserCreatedByAdmin($user));
        }
        
    }

    public function failed(NewUserRequest $event, $exception)
    {
        //
    }
}