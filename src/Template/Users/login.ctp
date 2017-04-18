<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-md-6 text-center">

            <h2 class="font-bold m-t-lg text-muted">Progress Monitoring</h2>
            <!-- <div class="profile-img-container m-t-lg">
                <div class="m-b-md m-t-lg">
          
                    <?= $this->Html->image('icon-low-rez.png', ['style' => 'width:150px; height:150px;', 'alt'=>'image'])?>
                    </div>
            </div> -->
            <h3>Employees Assessment</h3>
        </div>
        <div class="col-md-6">
            <br><br><br>
            <div class="ibox-content">
                <?= $this->Form->create(null, ['class' => 'm-t']); ?>
                <div class="form-group">
                    <?= $this->Form->Input('username', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Username', 'required'=>'required']); ?>
                </div>
                <?= $this->Form->Input('password', ['type' => 'password', 'class' => 'form-control', 'label' => false, 'placeholder' => 'Password', 'required'=>'required']) ?>
            </div>
            <br>
            <?= $this->Form->button('Login', ['type' => 'submit', 'class' => 'btn btn-primary block full-width m-b']); ?>
            <?= $this->Html->link(__('SignUp'), ['controller' => 'Users', 'action' => 'add']) ?>
            <div class="row">
                <div class="text-center">
                    <strong><a href="<?= $this->Url->build(['action' => 'forgotPassword'])?>">Forgot password?</a></strong><br>
                    &copy;<?php echo ' '.(date("Y")-1).'-'.date("Y").' '?>CAPview, LLC, All rights reserved.<br>
                    888.696.4753 | <a href="mailto:help@buzzydoc.com">Email Us For Help</a>
                </div>
            </div>
            
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<hr/>
</div>

<!-- <h1>Login</h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?> -->