<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div>
    <div class="row">
        <h3><?= __('Users') ?>
            <span class="pull-right">
                <?=$this->Html->link('Add New User', ['controller' => 'users', 'action' => 'add'], ['class' => ['btn', 'btn-primary']])?>
            </span>
        </h3>
    </div>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Status</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->role->label) ?></td>
                <td><?= h($user->status ? 'Enabled' : 'Disabled') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?php if($user->id != 1 && $user->id != $loggedInUser['id']){
                            echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]); 
                        }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
