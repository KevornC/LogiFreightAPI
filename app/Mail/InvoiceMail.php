<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;
use Illuminate\Support\Facades\Storage;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $pdfname,$pdf;
    public function __construct($pdfname,$pdf)
    {
        //
        $this->pdfname=$pdfname;
        $this->pdf=$pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $pdfname=$this->pdfname;
        $pdf=$this->pdf;
        $path=Storage::put('public/storage/logifreightinvoices/'.$pdfname.'.pdf', $pdf->output());
        Storage::put($path,$pdf->output());
        // $pdfattachment=array($pdf->output(), $path,[
        //     'mime' => 'application/pdf',
        //     'as' => $pdfname.'.pdf ,
        // ]);
        return $this->subject('Member Invoice')
        ->view('LogiFreightMail.invoice')
        ->attachData($pdf->output(), $path,[
            'mime' => 'application/pdf',
            'as' => $pdfname.'.pdf',
        ]);
    }
}
