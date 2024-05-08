<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var string[]|\Cake\Collection\CollectionInterface $payments
 * @var string[]|\Cake\Collection\CollectionInterface $deliveries
 * @var string[]|\Cake\Collection\CollectionInterface $products
 * @var string[]|\Cake\Collection\CollectionInterface $ordersProduct
 */
?>
<?php if($this->Identity->get('type') != "emp") : ?>
    <div class="alert alert-danger">You do not have privileges to view this page.</div>
<?php else : ?>
    <div class="row">
        <aside class="column">
            <div class="side-nav">
                <h4 class="heading"><?= __('Actions') ?></h4>

<!--               Form for showing ordersProducts details -->
                <h5 class="heading"><?= __('Related OrderProducts') ?></h5>
                <table>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Product ID') ?></th>
                        <th><?= __('Order ID') ?></th>
                        <th><?= __('Quantity') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($order->ordersProduct as $orderProduct) : ?>
                        <tr>
                            <td><?= h($orderProduct->id) ?></td>
                            <td><?= h($orderProduct->product_id) ?></td>
                            <td><?= h($orderProduct->order_id) ?></td>
                            <td><?= h($orderProduct->quantity) ?></td>
                            <td class="actions">
                                <?= $this->Form->create(null, [['controller' => 'OrdersProducts', 'action' => 'updateQuant']]) ?>
                            <td><?= h($order->ordersProduct) ?></td>
                            <?= $this->Form->control('quantity', ['options' => $ordersProduct]) ?>
                            <?= $this->Form->end() ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>




                    <?php foreach ($order->products as $product) : ?>
                        <tr>
                            <td><?= h($product->id) ?></td>
                            <td><?= h($product->name) ?></td>
                            <td><?= h($product->price) ?></td>
                            <td><?= h($product->description) ?></td>
                            <td class="actions">
                                <?= $this->Form->create(null, [['controller' => 'OrdersProducts', 'action' => 'updateQuant']]) ?>
                                <?= h($ordersProduct->quantity) ?>
                                <?= $this->Form->control('quantity', ['options' => $ordersProduct]) ?>
                                <?= $this->Form->end() ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>



                <?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $order->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $order->id), 'class' => 'side-nav-item']
                ) ?>
                <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            </div>
        </aside>
        <div class="column column-80">
            <div class="orders form content">
                <?= $this->Form->create($order) ?>
                <fieldset>
                    <legend><?= __('Edit Order') ?></legend>
                    <?php
                    echo $this->Form->control('payment_id', ['options' => $payments]);
                    echo $this->Form->control('delivery_id', ['options' => $deliveries]);
                    echo $this->Form->control('products._ids', ['options' => $products]);
                    ?>

                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Description') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($order->products as $product) : ?>
                            <tr>
                                <td><?= h($product->id) ?></td>
                                <td><?= h($product->name) ?></td>
                                <td><?= h($product->price) ?></td>
                                <td><?= h($product->description) ?></td>
                                <td class="actions">
<!--                                    --><?php //= $this->Html->link(__('View Product'), ['controller' => 'Products', 'action' => 'view', $product->id]) ?>
                                    <?= $this->Html->link(__('View Product'), ['controller' => 'Products', 'action' => 'view', $product->id]) ?>
                                    <?= $this->Html->link(__('Edit Product'), ['controller' => 'Products', 'action' => 'edit', $product->id]) ?>
                                    <?= $this->Html->link(__('Remove'), ['controller' => 'OrdersProducts', 'action' => 'deleteRelation', $order->id, $product->id]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>


                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
<?php endif; ?>
