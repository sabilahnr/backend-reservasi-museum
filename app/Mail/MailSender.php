<?php

namespace App\Mail;

use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\CreateSmtpEmail;

class MailSender
{
    protected $apiInstance;

    public function __construct()
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', config('services.sendinblue.api_key'));
        $this->apiInstance = new TransactionalEmailsApi(null, $config);
    }

    public function sendEmail($to, $subject, $content)
    {
        $email = new CreateSmtpEmail();
        $email['to'] = [['email' => $to]];
        $email['subject'] = $subject;
        $email['htmlContent'] = $content;

        try {
            $result = $this->apiInstance->sendTransacEmail($email);
            return true;
        } catch (\Exception $e) {
            // Tangani kesalahan pengiriman email
            return false;
        }
    }
}
