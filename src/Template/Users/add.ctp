<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <h3><u><?= __('Add User') ?></u></h3>
            <div class="form-group">
              <label for="first_name">First Name:</label>
              <?= $this->Form->input('first_name', ['class' => 'form-control', 'label' => false, 'placeholder' => 'first name', 'required'=>'required']); ?>
            </div>
            <div class="form-group">
              <label for="last_name">Last Name:</label>
              <?= $this->Form->input('last_name', ['class' => 'form-control', 'label' => false, 'placeholder' => 'last name', 'required'=>'required']); ?>
            </div>
            <div class="form-group">
              <label for="email">Email address:</label>
              <?= $this->Form->input('email', ['class' => 'form-control', 'label' => false, 'placeholder' => 'email', 'required'=>'required']); ?>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <?= $this->Form->input('password', ['class' => 'form-control', 'label' => false, 'placeholder' => 'password', 'required'=>'required']); ?>
            </div>
            <div class="form-group">
              <label for="phone">Primary Contact:</label>
              <?= $this->Form->input('phone', ['class' => 'form-control', 'label' => false, 'placeholder' => '9876543210', 'required'=>'required']); ?>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <?= $this->Form->input('role_id', ['label' => false, 'required' => true, 'class' => ['form-control']]); ?>
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