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

        $message = " Hello👋$name,\n\nYour account for the Barangay Information System has been created.\n\nLogin Details:\nEmail: $email\nPassword: $password";

        // dd(mb_substr($message, 0, 160), strlen($message));

        $this->send($number, $message);
    }

    public function accountUpdated($number, $account)
    {
        $name = $account['residentName'];
        $email = $account['email'];
        $password = count($account) != 3 ? 'UNCHANGED' : $account['password'];

        $message = "Hello👋 $name,\n\nYour account has been updated successfully.\n\nLogin Details:\nEmail: $email\nPassword: $password";

        // dd(mb_substr($message, 0, 160), strlen($message));

        $this->send($number, $message);
    }

    public function notifyAnnouncement($number, $announcement)
    {
        $title = strip_tags($announcement['title']);

        $message = "📢 ANNOUNCEMENT 📢\n\n$title\n\nCheck your account to see the full announcement.\nStay updated via the Barangay Information System!";

        // dd(mb_substr($message, 0, 160), strlen($message));

        $this->send($number, $message);
    }

    public function documentActioned($number, $docType, $action)
    {
        $message = "📄 Document Update:\n\nYour request for '$docType' has been $action by the Barangay Office.\n\nPlease check the system for more details.";
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
