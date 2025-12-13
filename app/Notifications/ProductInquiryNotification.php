<?php

namespace App\Notifications;

// app/Notifications/ProductInquiryNotification.php

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProductInquiryNotification extends Notification
{
    protected $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    public function via($notifiable)
    {
        return ['mail'];
        // return ['mail', 'database']; // or just 'mail', or add 'slack', etc.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Product Inquiry')
            ->line("Customer {$this->customer->name} has inquired about {$this->customer->product_name}.")
            ->action('View Product', url("/product/{$this->customer->product_id}"))
            ->line('Please follow up promptly.');
    }

    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'message' => "Customer {$this->customer->name} inquired about {$this->product->name}.",
    //         'product_id' => $this->product->id,
    //         'customer_id' => $this->customer->id,
    //     ];
    // }
}
