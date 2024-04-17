<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Payment> $payments
 */
?>
<?php if ($this->Identity->get('type') != "emp"): ?>
    <div class="alert alert-danger">You do not have privileges to view this page.</div>
<?php else: ?>
    <div class="payments index content">
      <div class="header" style="display: flex; justify-content: space-between; align-items: center;">
        <h1 class="section-title"><?= __('Payments') ?></h1>
        <?= $this->Html->link(__('New Payment'), ['action' => 'add'], ['class' => 'btn btn-primary fw-semi-bold float-right']) ?>
    </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('method') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?= h($payment->id) ?></td>
                        <td><?= $payment->has('user') ? $this->Html->link($payment->user->type, ['controller' => 'Users', 'action' => 'view', $payment->user->id]) : '' ?></td>
                        <td><?= $this->Number->format($payment->amount) ?></td>
                         <td><?= h($payment->method) ?></td>
                        <td><?= h($payment->date) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $payment->id], ['class' => 'btn btn-sm-square btn-primary mr-2']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $payment->id], ['class' => 'btn btn-sm-square btn-secondary mr-2']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $payment->id], ['class' => 'btn btn-sm-square btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $payment->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
<?php endif; ?>