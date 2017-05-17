<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="row">
    <h3><?= h($role->name) ?></h3>
    <table class="table table-bordered">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($role->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Label') ?></th>
            <td><?= h($role->label) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login Redirect Url') ?></th>
            <td><?= h($role->login_redirect_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($role->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($role->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $role->status ? __('Enabled') : __('Disabled'); ?></td>
        </tr>
    </table>
    <br>
    <div class="text-center"> 
        <?= $this->Html->link('Back',$this->request->referer(),['class' => ['btn', 'btn-warning']]);?>
    </div>
</div>
