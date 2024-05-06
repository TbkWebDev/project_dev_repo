<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Product;
use App\Model\Table\ProductsTable;
/**
 * Carts Controller
 *
 *  @property \App\Model\Table\ProductsTable $Products
 */
class CartsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        // By default, CakePHP will (sensibly) default to preventing users from accessing any actions on a controller.
        // These actions, however, are typically required for users who have not yet logged in.
        $this->Authentication->allowUnauthenticated(['index','delete','clear','checkoutClear', 'checkout']);
    }

    public $modelClass = '';


    public function index()
    {
   }


    public function view($id = null)
    {

    }


    public function update($id = null, $quantity = null)
    {
        $arr = $this->request->getSession()->read('cart');


//        $this->Flash->success(__($quantity));


        foreach ($arr as $key => $value) {
            if ($value['product']['id'] == $id) {
                $this->Flash->success(__($value['product']['name']));
                $arr[$key]['quantity'] = $quantity;
                $arr = array_values($arr);
                $this->request->getSession()->write('cart', $arr);

                $this->Flash->success(__('Product quantity updated'));
                return $this->redirect(['controller' => 'Carts', 'action' => 'index']);

            }
        }

        $this->Flash->error(__('Failed to update item quantity.'));
        return $this->redirect(['controller' => 'Carts', 'action' => 'index']);



    }

    public function delete($id = null)
    {
        $arr = $this->request->getSession()->read('cart');

        foreach ($arr as $key => $value) {
            if ($value['product']['id'] == $id) {
                unset($arr[$key]);
                $arr = array_values($arr);
                $this->request->getSession()->write('cart', $arr);

                $this->Flash->success(__('Product removed from cart.'));
                return $this->redirect(['controller' => 'Carts', 'action' => 'index']);

            }
        }

        $this->Flash->error(__('Failed to remove product from cart.'));
        return $this->redirect(['controller' => 'Carts', 'action' => 'index']);

    }


    public function clear()
    {
        $arr = $this->request->getSession()->read('cart');

        foreach ($arr as $key => $value) {
            unset($arr[$key]);
            $this->request->getSession()->write('cart', $arr);
            $this->Flash->success(__('Cart cleared.'));
        }
        return $this->redirect(['controller' => 'Carts', 'action' => 'index']);
    }

    public function checkout(){
        require_once '../vendor/autoload.php';
        require_once '../config/secrets.php';
        \Stripe\Stripe::setApiKey($stripeSecretKey);

//      Build empty array
        $cartarr = array();
//      Build cart in Stripe form
        foreach ($this->request->getSession()->read('cart') as $value) {
            $product = $value['product'];
            $quantity = $value['quantity'];
            $cost = ($product->price) * 100;
            $name = ($product->name);
            $description = ($product->description);

            $cart_item = [
                'price_data' => [
                    'currency' => 'aud',
                    'unit_amount' => $cost,
                    'product_data' => [
                        'name' => $name,
                        'description' => $description,
                    ],
                ],
                'quantity' => $quantity,
            ];

            array_push($cartarr, $cart_item);
        }

        header('Content-Type: application/json');
        $YOUR_DOMAIN = \Cake\Routing\url('/', true);

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [$cartarr],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN,
            'cancel_url' => $YOUR_DOMAIN . "Carts",
        ]);

        header("HTTP/1.1 303 See Other");
        return $this->redirect($checkout_session->url);
    }


}
