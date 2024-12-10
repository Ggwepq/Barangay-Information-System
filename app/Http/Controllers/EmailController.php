<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreatedMail;
use App\Mail\AccountUpdatedMail;
use App\Mail\AnnouncementMail;
use App\Mail\DocumentActionedMail;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendAnnouncementMail($recipientEmail, $title, $content)
    {
        $subject = 'New Barangay Announcement';

        Mail::to($recipientEmail)->send(new AnnouncementMail($subject, $title, $content));
    }

    public function sendDocumentMail($recipientEmail, $docType, $actioned)
    {
        $subject = 'Document Request Actioned';

        Mail::to($recipientEmail)->send(new DocumentActionedMail($subject, $docType, $actioned));
    }

    public function sendAccountUpdatedMail($recipientEmail, $recipientName, $email, $password)
    {
        $password = $password ?? 'UNCHANGED';

        $subject = 'Your Barangay Information System Account Has Been Updated';

        Mail::to($recipientEmail)->send(new AccountUpdatedMail($subject, $recipientName, $email, $password));
    }

    public function sendAccountCreatedMail($recipientEmail, $recipientName, $email, $password)
    {
        $subject = 'Your Barangay Information System Account Has Been Created';

        Mail::to($recipientEmail)->send(new AccountCreatedMail($subject, $recipientName, $email, $password));
    }
}
