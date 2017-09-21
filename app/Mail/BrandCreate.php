<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Brand;

class BrandCreate extends Mailable
{
    use Queueable, SerializesModels;

    protected $brand;
    protected $image;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
        $this->image = 'images/brands/'.$brand->image;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.brandCreated')->
            from('komlikov.r@gmail.com', 'Brand Created')->
            with([
                'brandName'=>$this->brand->name,
                'brandDesc'=>$this->brand->description,
                'created'=>$this->brand->created_at,
                'image'=>$this->image,
        ])->attach($this->image);
    }
}
