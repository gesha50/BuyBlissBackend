<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class RegisterSMS extends Notification
{
    use Queueable;

    protected $user_login = 't79175432501';
    protected $user_password = '610731';
    protected $api_sms = 'http://api.prostor-sms.ru/messages/v2/send';
    private $password;
    private $phone;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($phone, $password)
    {
        $this->phone = $phone;
        $this->password = $password;
    }

    public function sendSMS(): int
    {
//            https://prostor-sms.ru/smsapi/
        $response = Http::withBasicAuth($this->user_login, $this->user_password)
            ->get($this->api_sms, [
                'phone' => '+'.$this->phone,
                'text' => 'Пароль: ' . $this->password . '
Это ваш пароль для сайта BuyBliss.ru
Запомните его и никому не показывайте!',
            ]);
        return $response->status();
    }
}
