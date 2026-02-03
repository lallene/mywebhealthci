<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Insertion_massive extends Mailable
{
    use Queueable, SerializesModels;
    public  $nbreCollaborateur,  $dateInsertion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $nbreCollaborateur, $dateInsertion)
    {


        $this->dateInsertion = $dateInsertion;
        $this->nbreCollaborateur =  $nbreCollaborateur;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('emails.insertion_massive')
        ->subject("My Webhealth CI -Insertion du $this->dateInsertion Notification de l'insertion reussite.")
        ->with([
            'nbreColllaborateur'=>$this->nbreCollaborateur,
            'dateInsertion'=>$this->dateInsertion,
        ]);

return redirect()->route('projet.index')->with('success','le rapport selectionné a été envoyé aux superviseurs');
    }
}
