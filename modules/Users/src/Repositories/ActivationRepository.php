<?php namespace Modules\Users\Src\Repositories;

use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Mail;
use Modules\Users\Src\Emails\UserEmailChanged;
class ActivationRepository
{

    protected $mailer;
    protected $repository;
    protected $resendAfter = 24;
    protected $db;
    protected $table = 'user_activations';

    public function __construct(Mailer $mailer, Connection $db)
    {
        $this->mailer = $mailer;
        $this->db = $db;
    }


    public function emailChanged($user)
    {
        if (!$this->shouldSend($user)) {
            $token = $this->createActivation($user);
        }else{
            $token = $this->regenerateToken($user);           
        }

        $link = route('user.activate', $token);

        $user->activation_url = $link;

        Mail::to($user->email)->send(new UserEmailChanged($user));
    }

    public function sendActivationMail($user)
    {

        if ($user->activated || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->createActivation($user);

        $link = route('user.activate', $token);
        $message = sprintf('Activate account <a href="%s">%s</a>', $link, $link);

        $this->mailer->raw($message, function (Message $m) use ($user) {
            $m->to($user->email)->subject('Activation mail');
        });


    }

    public function activateUser($token)
    {
        $activation = $this->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->activated = true;

        $user->save();

        $this->deleteActivation($token);

        return $user;

    }

    public function resendEmail($user)
    {
        $activation = $this->getActivation($user);
        if($activation){
            $new_token = $this->regenerateToken($user);
            $link = route('user.activate', $new_token);
            $message = sprintf('Activate account <a href="%s">%s</a>', $link, $link);

            $this->mailer->raw($message, function (Message $m) use ($user) {
                $m->to($user->email)->subject('Activation mail');
            });
            return true;
        }

        return false;
    }

    private function shouldSend($user)
    {
        $activation = $this->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }


    //Repository
    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function createActivation($user)
    {

        $activation = $this->getActivation($user);

        if (!$activation) {
            return $this->createToken($user);
        }
        return $this->regenerateToken($user);

    }

    private function regenerateToken($user)
    {

        $token = $this->getToken();
        $this->db->table($this->table)->where('user_id', $user->id)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    private function createToken($user)
    {
        $token = $this->getToken();
        $this->db->table($this->table)->insert([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    public function getActivation($user)
    {
        return $this->db->table($this->table)->where('user_id', $user->id)->first();
    }


    public function getActivationByToken($token)
    {
        return $this->db->table($this->table)->where('token', $token)->first();
    }

    public function deleteActivation($token)
    {
        $this->db->table($this->table)->where('token', $token)->delete();
    }
}