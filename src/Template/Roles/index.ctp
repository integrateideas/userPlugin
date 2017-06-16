<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div>
    <div class="row">
        <h3><?= __('Roles') ?>
            <span class="pull-right">
                <?=$this->Html->link('Add New Role', ['controller' => 'roles', 'action' => 'add'], ['class' => ['btn', 'btn-primary']])?>
            </span>
        </h3>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Created</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?>
            <tr>
                <td><?= $this->Number->format($role->id) ?></td>
                <td><?= h($role->label) ?></td>
                <td><?= h($role->status ? 'Enabled' : 'Disabled') ?></td>
                <td><?= h($role->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $role->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $role->id]) ?>
                    <?php if($role->id != 1){
                            echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]);
                          }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
