<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailHelper
{
    public static function sendEmail(
        $data,
        $subject,
        $to = [],
        $formType = 'default-content',
        $fromAddress = null,
        $fromName = null,
        $bcc = []
    ) {
        if (is_null($to) || !count($to) || empty($to)) {
            $to = getEmailsToSendForm($formType);
        }

        $blade = 'emails.' . $formType;
        $fromAddress = $fromAddress ?? env('MAIL_FROM_ADDRESS');
        $fromName = $fromName ?? env('MAIL_FROM_NAME');
        $fromAddress = $fromAddress ?? env('MAIL_FROM_ADDRESS');
        $subject = $subject ?? env('MAIL_FROM_ADDRESS');
        $bcc = $bcc ?? env('MAIL_FROM_ADDRESS');

        $to = array_unique($to);

        try {
            Mail::send(
                $blade,
                ['data' => $data],
                function ($message) use ($fromAddress, $fromName, $subject, $bcc, $to) {
                    $message->from($fromAddress, $fromName);
                    $message->to($to);
                    $message->bcc($bcc);
                    $message->subject($subject);
                }
            );
            return 'success?';
            Log::channel('mail')->info("Mail sent" . PHP_EOL .
                "To: " . implode(', ', $to) . PHP_EOL .
                "Form Type: " . $formType . PHP_EOL .
                "At: " . Carbon::now()->format('d-m-Y H:i:s') . PHP_EOL);
        } catch (Exception $e) {
            throw $e;
            Log::channel('mail')->error("ERROR in mail send" . PHP_EOL .
                "To: " . implode(', ', $to) . PHP_EOL .
                "Form Type: " . $formType . PHP_EOL .
                "At: " . Carbon::now()->format('d-m-Y H:i:s') . PHP_EOL);
            return false;
        }
    }

    public static function sendEmailError($subject, $data)
    {
        $blade = 'emails.error';
        $to = env('APP_MAIL_TEST');
        $fromAddress = env('APP_MAIL_TEST');
        $fromName = "TITAN PLV";
        $subject = "TITAN PLV :: " . $subject ?? "Error Exception";

        try {
            Mail::send(
                $blade,
                ['data' => $data],
                function ($message) use ($fromAddress, $fromName, $subject, $to) {
                    $message->from($fromAddress, $fromName);
                    $message->to($to);
                    $message->subject($subject);
                }
            );
            Log::channel('mail')->info("Mail sent" . PHP_EOL .
                "To: " . $to . PHP_EOL .
                "Form Type: Error" . PHP_EOL .
                "At: " . Carbon::now()->format('d-m-Y H:i:s') . PHP_EOL);
            return 'success';
        } catch (Exception $e) {
            Log::channel('mail')->error("ERROR in mail send" . PHP_EOL .
                "To: " . $to . PHP_EOL .
                "Form Type: Error" . PHP_EOL .
                "At: " . Carbon::now()->format('d-m-Y H:i:s') . PHP_EOL);
            throw $e;
            return false;
        }
    }
}
