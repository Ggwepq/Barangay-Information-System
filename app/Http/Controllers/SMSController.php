<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\ApiException;
use Infobip\Configuration;

class SMSController extends Controller
{
    public function accountCreated($number, $account)
    {
        $name = $account['residentName'];
        $email = $account['email'];
        $password = $account['password'];

        $message = "Hi $name,

        Your account for the Barangay Information System has been created successfully.

        Here is your login details: Email: $email,Password:$password
";
        $this->send($number, $message);
    }

    public function accountUpdated($number, $account)
    {
        $name = $account['residentName'];
        $email = $account['email'];
        $password = $account['password'] ? $account['password'] : 'Still the old one';

        $message = "Hi $name,

        Your account for the Barangay Information System has been updated successfully.

        Here is your new login details: Email: $email,Password:$password
";
        $this->send($number, $message);
    }

    public function notifyAnnouncement($number, $announcement)
    {
        $message = "ANNOUNCEMENT: $announcement. Stay updated via the Barangay Information System.";
        $this->send($number, $message);
    }

    public function documentActioned($number, $docType, $action)
    {
        $message = "Your $docType has been $action by the Barangay office. Please check the system for updates.";
        $this->send($number, $message);
    }

    protected function send($number, $text)
    {
        $number = $this->formatNumber($number);

        $configuration = new Configuration(
            host: env('INFOBIP_BASE_URL'),
            apiKey: env('INFOBIP_API_KEY'),
        );

        $sendSmsApi = new SmsApi(config: $configuration);

        $message = new SmsTextualMessage(
            destinations: [
                new SmsDestination(to: $number)
            ],
            from: 'Barangay',
            text: $text
        );

        $request = new SmsAdvancedTextualRequest(messages: [$message]);

        try {
            $smsResponse = $sendSmsApi->sendSmsMessage($request);
        } catch (ApiException $apiException) {
        }
    }

    protected function formatNumber($number)
    {
        // If the number starts with "0", replace it with "63"
        if (substr($number, 0, 1) === '0') {
            $number = '63' . substr($number, 1);
        }
        // If the number already starts with "63", return it as is
        elseif (substr($number, 0, 2) === '63') {
            return $number;
        }
        return $number;
    }
}
