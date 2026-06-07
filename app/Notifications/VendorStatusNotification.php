<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\VendorProfile;

class VendorStatusNotification extends Notification
{
    use Queueable;

    protected $profile;

    public function __construct(VendorProfile $profile)
    {
        $this->profile = $profile;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $status = $this->profile->status;
        $title = 'Vendor Application Update';
        $message = 'Your vendor account is currently in ' . $status . ' status.';
        $icon = '🤝';

        if ($status === 'approved') {
            $title = 'Vendor Node Activated';
            $message = 'Congratulations! Your application for "' . $this->profile->store_name . '" was approved.';
            $icon = '✨';
        } elseif ($status === 'suspended') {
            $title = 'Vendor Account Suspended';
            $message = 'Notice: Your vendor node "' . $this->profile->store_name . '" has been suspended.';
            $icon = '🛑';
        } elseif ($status === 'rejected') {
            $title = 'Vendor Application Rejected';
            $message = 'Your application for "' . $this->profile->store_name . '" was rejected by administration.';
            $icon = '❌';
        }

        return [
            'title' => $title,
            'message' => $message,
            'url' => $status === 'approved' ? '/vendor/dashboard' : '/dashboard',
            'icon' => $icon
        ];
    }
}
