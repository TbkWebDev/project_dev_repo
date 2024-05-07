<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function initialize(): void
    {
        parent::initialize();

        // Controller-level function/action whitelist for authentication
        $this->Authentication->allowUnauthenticated(['view', 'index', 'addToCart']);
    }

    public function index()
    {
        $query = $this->Products->find();
        $products = $this->paginate($query);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, contain: ['Images', 'Ingredients', 'Menus', 'Orders']);
        $this->set(compact('product'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $images = $this->Products->Images->find('list', limit: 200)->all();
        $ingredients = $this->Products->Ingredients->find('list', limit: 200)->all();
        $menus = $this->Products->Menus->find('list', limit: 200)->all();
        $orders = $this->Products->Orders->find('list', limit: 200)->all();
        $this->set(compact('product', 'images', 'ingredients', 'menus', 'orders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, contain: ['Images', 'Ingredients', 'Menus', 'Orders']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $images = $this->Products->Images->find('list', limit: 200)->all();
        $ingredients = $this->Products->Ingredients->find('list', limit: 200)->all();
        $menus = $this->Products->Menus->find('list', limit: 200)->all();
        $orders = $this->Products->Orders->find('list', limit: 200)->all();
        $this->set(compact('product', 'images', 'ingredients', 'menus', 'orders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Add to cart method
     * Responsible for storing product information into the session, which is then used to populate the shopping cart page
     */
    public function addToCart($id = null)
    {
        // Identify the product
        $product = $this->Products->get($id);

        // Initialise the cart in session if it doesn't exist
        if ($this->request->getSession()->read('cart') == null) {
            $arr = array();
            $this->request->getSession()->write('cart', $arr);
        }

        // read existing cart
        $arr = $this->request->getSession()->read('cart');

        // If the product is not already in the cart add it, else update quantity
        if (!in_array($product, array_column($arr, 'product'))) {
            $prodInfo = array(
                "product" => $product,
                "quantity" => 1,
            );
            $arr[] = $prodInfo;
        } else {
            $key = array_search($product, array_column($arr, 'product'));
            $arr[$key]['quantity'] += 1;
        }
        // add new product to existing cart


        // Overwrite previous cart in session
        $this->request->getSession()->write('cart', $arr);

        // Success message & Redirect to menus
        $this->Flash->success(__('Product added to cart.'));
        $refererUrl = $this->request->getQuery('return_to');
        if ($refererUrl) {
            return $this->redirect($refererUrl);
        } else {
            // If referer URL is not available, redirect to a default page
            return $this->redirect(['controller' => 'Menus', 'action' => 'index']);
        }
        // return $this->redirect($this->referer());
        // return $this->redirect(['Controller'=> 'Menus','action' => 'view']);

    }


}
