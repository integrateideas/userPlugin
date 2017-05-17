<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($role) ?>
    <h3><u><?= __('Add Role') ?></u></h3>
            <div class="form-group">
              <label for="name">Name:</label>
              <?= $this->Form->input('name', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Name', 'required'=>'required']); ?>
            </div>
            <div class="form-group">
              <label for="label">Label:</label>
              <?= $this->Form->input('label', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Label', 'required'=>'required']); ?>
            </div>
            <div class="form-group">
              <label for="login_redirect_url">Login Redirect Url:</label>
              <?= $this->Form->input('login_redirect_url', ['class' => 'form-control', 'label' => false, 'placeholder' => 'users/dashboard']); ?>
            </div>
            <div class="form-group">   
                <label>
                    <?= $this->Form->checkbox('status', ['label' => false]); ?> Active
                </label>
            </div>
    <div class="text-center"> 
        <?= $this->Form->button(__('Submit'), ['class' => ['btn', 'btn-primary']]) ?>
        <?= $this->Html->link('Back', $this->request->referer(),['class' => ['btn', 'btn-warning']]);?>
    </div>
    <?= $this->Form->end() ?>
</div>
