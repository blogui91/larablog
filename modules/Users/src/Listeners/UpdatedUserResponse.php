<?php

namespace Modules\Users\Src\Listeners;

use Modules\Users\Src\Events\UpdatedUserRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;

use Modules\Users\Src\Emails\NewUserCreatedByAdmin;

use Modules\Users\Src\Repositories\ActivationRepository;

class UpdatedUserResponse implements ShouldQueue
{
    use InteractsWithQueue;

    public $repository;

    public function __construct(ActivationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(UpdatedUserRequest $event)
    {
        $user = $event->getUser();
        $params = $event->getParams();

        if($params['email_hasChanged']){
            $user->activated = 0;
            $user->save();
            $this->repository->emailChanged($user);
        }
        
    }

    public function failed(UpdatedUserRequest $event, $exception)
    {
        //
    }
}