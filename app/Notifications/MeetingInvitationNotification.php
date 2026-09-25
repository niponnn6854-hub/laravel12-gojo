<?php

namespace App\Notifications;

use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingInvitationNotification extends Notification
{
    use Queueable;

    public function __construct(public Meeting $meeting)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('คุณได้รับเชิญเข้าร่วมประชุม: ' . $this->meeting->title)
            ->greeting('สวัสดีครับ/ค่ะ ' . $notifiable->name)
            ->line('คุณได้รับเชิญให้เข้าร่วมการประชุม "' . $this->meeting->title . '"')
            ->line('ห้อง: ' . $this->meeting->room->name)
            ->line('เวลาเริ่ม: ' . $this->meeting->start_time->format('d/m/Y H:i'))
            ->line('เวลาสิ้นสุด: ' . $this->meeting->end_time->format('d/m/Y H:i'))
            ->when($this->meeting->description, function ($mail) {
                return $mail->line('รายละเอียด: ' . $this->meeting->description);
            })
            ->action('ดูรายละเอียดการประชุม', url('/meetings/' . $this->meeting->id))
            ->line('กรุณายืนยันการเข้าร่วมของคุณในระบบ');
    }
}