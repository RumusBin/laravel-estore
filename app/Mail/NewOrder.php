<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;
use Carbon\Carbon;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $image;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $newOrder = $this->order;
        $user = $newOrder->user;
        $data = [];
        $data['order'] = $newOrder;

        $cartItems = unserialize($newOrder->cart);

        $data['user'] = $user;
        $data['city'] = $newOrder->city;
        $data['warhouse'] = $newOrder->warhouse;
        $data['date'] = $newOrder->created_at;

      foreach ($cartItems as $items){
          $data['cart_items'][] = $items;
      }


   //TODO create view for new order mail
      foreach ($data['cart_items'] as $item){
              $data['product'][] = $item;
      }
      $data['totalQty'] = $data['product'][1];
        $data['totalPrice'] = $data['product'][2];
        $data['arr_products'] = array_get($data['product'], 0);

        return $this->view('mails.newOrderAdmin')->
        from('komlikov.r@gmail.com', 'Новый заказ.')->with($data);
    }
}
