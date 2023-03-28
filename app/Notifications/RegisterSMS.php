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
        $response = Http::withBasicAuth(config('services.sms.login'), config('services.sms.password'))
            ->get(config('services.sms.api_url'), [
                'phone' => '+'.$this->phone,
                'text' => $this->smsText(),
            ]);
        return $response->status();
    }

    public function smsText(): string
    {
        return "Пароль: " . $this->password
            . PHP_EOL . "Это ваш пароль для сайта BuyBliss.ru"
            . PHP_EOL . "Запомните его и никому не показывайте!";
    }
}
