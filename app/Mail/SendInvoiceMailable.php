<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendInvoiceMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $client;
     public $request;

    public function __construct($client, $request)
    {
        $this->client = $client;
        $this->request = $request;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('factura@hibridosv.com', $this->client->nombre_comercial),
            subject: 'Comprobante de Documento Tributario Electrónico',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: formatView('emails', $this->client->nit, 'invoice'),
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $codigo = $this->request['identificacion']['codigoGeneracion'];
        return [
            Attachment::fromPath(storage_path('/app/documentos/'. $codigo .'.pdf'))
                                ->as($codigo .'.pdf')->withMime('application/pdf'),
            
            Attachment::fromPath(storage_path('/app/documentos/'. $codigo .'.json'))
                                ->as($codigo .'.json')->withMime('application/json'),
        ];
    }
}
