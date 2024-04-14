<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php if($this->Identity->get('type') != "emp") : ?>
    <div class="alert alert-danger">You do not have privileges to view this page.</div>
<?php else : ?>
    <div class="row">
        <aside class="column">
            <div class="side-nav">
                <h4 class="heading"><?= __('Actions') ?></h4>
                <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
                <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            </div>
        </aside>
        <div class="column column-80">
            <div class="users view content">
                <h3><?= h($user->type) ?></h3>
                <table>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= h($user->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Type') ?></th>
                        <td><?= h($user->type) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('First Name') ?></th>
                        <td><?= h($user->first_name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Last Name') ?></th>
                        <td><?= h($user->last_name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Email') ?></th>
                        <td><?= h($user->email) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Address') ?></th>
                        <td><?= h($user->address) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Phone Number') ?></th>
                        <td><?= h($user->phone_number) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Nonce') ?></th>
                        <td><?= h($user->nonce) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Nonce Expiry') ?></th>
                        <td><?= h($user->nonce_expiry) ?></td>
                    </tr>
                </table>
                <div class="related">
                    <h4><?= __('Related Payments') ?></h4>
                    <?php if (!empty($user->payments)) : ?>
                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('User Id') ?></th>
                                    <th><?= __('Amount') ?></th>
                                    <th><?= __('Method') ?></th>
                                    <th><?= __('Date') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                                <?php foreach ($user->payments as $payment) : ?>
                                    <tr>
                                        <td><?= h($payment->id) ?></td>
                                        <td><?= h($payment->user_id) ?></td>
                                        <td><?= h($payment->amount) ?></td>
                                        <td><?= h($payment->method) ?></td>
                                        <td><?= h($payment->date) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('View'), ['controller' => 'Payments', 'action' => 'view', $payment->id]) ?>
                                            <?= $this->Html->link(__('Edit'), ['controller' => 'Payments', 'action' => 'edit', $payment->id]) ?>
                                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Payments', 'action' => 'delete', $payment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id)]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
