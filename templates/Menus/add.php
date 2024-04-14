<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 * @var \Cake\Collection\CollectionInterface|string[] $products
 */
?>
<?php if($this->Identity->get('type') != "emp") : ?>
    <div class="alert alert-danger">You do not have privileges to view this page.</div>
<?php else : ?>
    <div class="row">
        <div class="column column-80">
            <div class="menus form content">
                <?= $this->Form->create($menu) ?>
                <fieldset>
                    <legend><?= __('Add Menu') ?></legend>
                    <h6 class="d-flex border-bottom">
                        <span>Name</span>
                    </h6>
                    <?php echo $this->Form->control('name', ['label' => '', 'class' => 'd-flex flex-column']); ?>
                    <br />
                    <h6 class="d-flex border-bottom">
                        <span>Description</span>
                    </h6>
                    <?php echo $this->Form->control('description', ['label' => '', 'class' => 'd-flex flex-column', 'rows' => '5']); ?>
                    <br />
                    <h6 class="d-flex border-bottom">
                        <span>Active</span>
                    </h6>
                    <?php echo $this->Form->control('active', ['label' => '', 'class' => 'd-flex flex-column']); ?>
                </fieldset>
                <br />
                <div class="col">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success'] ) ?>
                    <?= $this->Form->end() ?>
                    <?= $this->Html->link(__('Go Back to All Menus'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
                </div>
                <br />
            </div>
        </div>
    </div>
<?php endif; ?>
