<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Menu> $menus
 */
?>
<div class="menus index content">
    <!-- display for customer -->
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
        <div class="container text-center my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown"> Active Catering Menu</h1>
            <h4 class="text-white animated slideInDown"> *Only available for minimum order of 20 items*</h4>
            <div class="text-center">
            <?= $this->Html->link(__('View Basic Menu'), ['action' => 'index'], ['class' => 'btn btn-secondary float-right']) ?>
</div>

        </div>

    </div>
</div>

<div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($menus as $menu) : ?>
            <?php if ($menu->active === TRUE && $menu->catering === TRUE) : ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-center"><?= h($menu->name) ?></h3>
                            <p class="card-text text-center mb-4"><?= h($menu->description) ?></p>
                            <div class="text-center">
                                <?= $this->Html->link(__('VIEW'), ['action' => 'view', $menu->id], ['class' => 'btn btn-primary py-2 px-3 me-2']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<br>
<br>
</div>
