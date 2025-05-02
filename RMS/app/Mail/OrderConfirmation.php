<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $greeting;
    public $introLines;
    public $actionText;
    public $actionUrl;
    public $outroLines;
    public $salutation;
    public $displayableActionUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->greeting = 'Order Confirmation';
        $this->introLines = [
            'Dear Customer,',
            'Thank you for your order! Your order has been confirmed and will be ready for pickup at your selected time.',
        ];
        $this->actionText = 'Track Your Order';
        $this->actionUrl = route('plate.track', ['order_number' => $order->order_number]);
        $this->displayableActionUrl = $this->actionUrl;
        $this->outroLines = [
            'If you have any questions about your order, please contact us.',
        ];
        $this->salutation = 'Thanks,';
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Order Confirmation - ' . $this->order->order_number,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.orders.confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
