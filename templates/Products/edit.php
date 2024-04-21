<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var string[]|\Cake\Collection\CollectionInterface $images
 * @var string[]|\Cake\Collection\CollectionInterface $ingredients
 * @var string[]|\Cake\Collection\CollectionInterface $menus
 * @var string[]|\Cake\Collection\CollectionInterface $orders
 */
?>
<?php if ($this->Identity->get('type') != "emp") : ?>
    <div class="alert alert-danger">You do not have privileges to view this page.</div>
<?php else : ?>
    <?php $this->layout = 'admin_default'; ?>

    <div class="row">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <legend><?= __('Edit Product') ?></legend>
                    <?= $this->Html->link(__('Go Back to All Products'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Form->postLink(
                        __('Delete Product'),
                        ['action' => 'delete', $product->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $product->id), 'class' => 'btn btn-danger']
                    ) ?>
                    <div class="products form content">

                        <?= $this->Form->create($product) ?>
                        <fieldset>

                            <div class="row">
                                <div class="col">
                                    <br />
                                    <h6 class="d-flex border-bottom">
                                        <span>Name *</span>
                                    </h6>
                                    <?php echo $this->Form->control('name', [
                                        'class' => 'form-control',
                                        'label' => false,
                                        'placeholder' => 'Product Name'
                                    ]); ?>
                                </div>
                                <div class="col">
                                    <br />
                                    <h6 class="d-flex justify-content-between border-bottom pb-1">
                                        <span>Price *</span>
                                    </h6>
                                    <?php echo $this->Form->control('price', [
                                        'class' => 'form-control',
                                        'label' => false,
                                        'type' => 'number',
                                        'step' => '0.01', // Allows entering cents
                                        'min' => '0',    // Ensures the price is not negative
                                        'default' => '0', // Sets initial value to 0
                                        'placeholder' => 'Product Price'
                                    ]); ?>
                                </div>
                            </div>
                            <br />
                            <h6 class="d-flex justify-content-between border-bottom pb-1">
                                <span>Description *</span>
                            </h6>
                            <?php echo $this->Form->control('description', [
                                'class' => 'form-control',
                                'label' => false,
                                'placeholder' => 'Product Description',
                                'rows' => 5
                            ]); ?>
                            <br />
                            <div class="row">
                                <div class="col">

                                    <table>
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h6 class="d-flex justify-content-between border-bottom pb-1">
                                                        <span>Images</span>
                                                    </h6>
                                                    <div class="row">
                                                        <?php echo $this->Form->control('images._ids', ['options' => $images, 'label' => false, 'class' => 'd-flex flex form-select']); ?>
                                                    </div>
                                                    <br />
                                                    <div class="row">
                                                        <?= $this->Html->link(__('Edit Images'), ['action' => '../Images/index'], ['class' => 'btn btn-primary']) ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col">
                                    <table style="width: 90%; margin: 0 auto;">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"></th>
                                                <td>
                                                    <h6 class="d-flex justify-content-between border-bottom pb-1">
                                                        <span>Menus</span>
                                                    </h6>
                                                    <?php echo $this->Form->control('menus._ids', ['options' => $menus, 'label' => false, 'class' => 'd-flex flex form-select']); ?>
                                                    <br />
                                                    <div class="row">
                                                        <?= $this->Html->link(__('Edit Menus'), ['action' => '../Menus/admin_index'], ['class' => 'btn btn-primary']) ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="row">
                                <table>
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="d-flex justify-content-between border-bottom pb-1">
                                                <span>Images</span>
                                            </h6>
                                            <div class="row">
                                                <?php echo $this->Form->control('images._ids', ['options' => $images, 'label' => false, 'class' => 'd-flex flex form-select']); ?>
                                            </div>
                                            <br />
                                            <div class="row">
                                                <?= $this->Html->link(__('Edit Images'), ['action' => '../Images/index'], ['class' => 'btn btn-primary']) ?>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <br />
                            <div class="row">
                                <table>
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>
                                            <h6 class="d-flex justify-content-between border-bottom pb-1">
                                                <span>Ingredients</span>
                                            </h6>
                                            <?php echo $this->Form->control('ingredients._ids', ['options' => $ingredients, 'label' => false, 'class' => 'd-flex flex form-select']); ?>
                                            <br />
                                            <div class="row">
                                                <?= $this->Html->link(__('Edit Ingredients'), ['action' => '../Ingredients/index'], ['class' => 'btn btn-primary']) ?>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div> -->
                <div class="d-grid">
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
                        </fieldset>
                        <br />

                    </div>
                </div>
                <div class="col">
                    <fieldset>
                        <legend><?= __('Current View') ?></legend>
                        <div class="row">
                            <div class="d-flex align-items-center">
                                <!-- If there are images, display them -->
                                <?php if (!empty($product->images)) : ?>
                                    <div class="carousel-inner">
                                        <?php foreach ($product->images as $image) : ?>
                                            <img class="img-fluid" src="<?= $image->file_location ?>" alt="">
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                                        <span><?= h($product->name) ?></span>
                                        <span class="text-primary"><?= $this->Number->format($product->price) ?></span>
                                    </h5>
                                    <small class="fst-italic"><?= h($product->description) ?></small>
                                    <br />
                                    <h6 class="d-flex justify-content-between border-bottom pb-1">
                                        <span>Ingredients</span>
                                    </h6>
                                    <?php if (!empty($product->ingredients)) : ?>
                                        <?php foreach ($product->ingredients as $ingredient) : ?>
                                            <small class="fst-normal"><?= h($ingredient->name) ?></small>
                                        <?php endforeach; ?>
                                        <br />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <br />
<?php endif; ?>