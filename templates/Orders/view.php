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
<?php if ($this->Identity->get('type') != "emp") : ?>
    <div class="alert alert-danger">You do not have privileges to view this page.</div>
<?php else : ?>

    <?php $this->layout = 'admin_default'; ?>
    <div class="products manage content">
        <?= $this->Html->link(__('Back To All Orders'), ['action' => 'index'], ['class' => 'btn btn-primary float-right']) ?>
        <br />
        <br />
        <div class="row">
            <aside class="column">
                <div class="side-nav">
                    <h4 class="heading"><?= __('Order ID') ?></h4>
                    <td><?= h($order->id) ?></td>

                    <h4 class="heading"><?= __('Order Status') ?></h4>
                    <tr>
                        <td> Current Status: <?= h($order->status) ?> </td>
                    </tr>
                    <table>
                        <tr>
                            <th><?= __('Product Name') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Quantity') ?></th>
                        </tr>
                        <h4 class="heading"><?= __('Products in order') ?></h4>

                        <?php if (!empty($orderProducts)) {
                            foreach($orderProducts as $ordersProduct) : ?>
                                <tr>
                                    <td><?= h($ordersProduct->product_name) ?></td>
                                    <td><?= h($ordersProduct->product_price) ?></td>
                                    <td><?= h($ordersProduct->product_description) ?></td>
                                    <td class="actions">
                                        <?= $this->Form->create(null, ['url' => ['controller' => 'OrdersProducts', 'action' => 'edit', $ordersProduct->id]]) ?>
                                        <?php echo $this->Form->control('quantity', [
                                            'class' => 'form-control',
                                            'type' => 'number',
                                            'step' => '1',
                                            'min' => '1',
                                            'max' => '100',
                                            'readonly',
                                            'label' => false,
                                            'default' => $ordersProduct->quantity,
                                        ]); ?>
                                    </td>
                                </tr>
                            <?php endforeach;
                        } ?>
                    </table>
                </div>
            </aside>
        </div>
    </div>
<?php endif; ?>
