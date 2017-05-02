<div class="ibox-content">
<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-md-5 text-center" style="margin: 4px 0 0 84px;">

            <h2 class="font-bold m-t-lg text-muted">CAPview</h2>
            <h6><strong>The capability viewing software</strong></h6>
            <div class="profile-img-container m-t-lg">
                <div class="m-b-md m-t-lg">
          
                    <?= $this->Html->image('2017-04-03_1312.png', ['style' => 'width:150px; height:150px;', 'alt'=>'image'])?>
                    </div>
            </div>
            <p class="primary-desc">
                   <strong> CAPview is a customisable, web-based employee performance management service. Our solution allows business owners to align individual goals to those of the business. </strong> 
                </p>

                <p>
                    This easy-to-use software allows you to drive higher engagement in the performance management process and use this data to produce key insights into how your teams and people work together. 
                </p>
        </div>
        <div class="col-md-5" >
            <br><br><br>
            <br><br><br>

            <div class="ibox-content">
                <?= $this->Form->create(null, ['class' => 'm-t']); ?>
                <div class="form-group">
                    <?= $this->Form->Input('username', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Username', 'required'=>'required']); ?>
                </div>
                <?= $this->Form->Input('password', ['type' => 'password', 'class' => 'form-control', 'label' => false, 'placeholder' => 'Password', 'required'=>'required']) ?>
            <br>
            <?= $this->Form->button('Login', ['type' => 'submit', 'class' => 'btn btn-primary block full-width m-b col-sm-12']); ?>
            <br><br>
            <?= $this->Html->link(__('SignUp'), ['controller' => 'Users', 'action' => 'add'],['type' => 'submit', 'class' => 'btn btn-info block full-width m-b col-sm-12']) ?>
            <br><br>
            <div class="text-center">
            <strong><a href="<?= $this->Url->build(['action' => 'forgotPassword'])?>">Forgot password?</a></strong><br>
            </div>
            <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br>
<hr/>
            <div class="row">
                <div class="col-md-12 text-center">
                    &copy;<?php echo ' '.(date("Y")-1).'-'.date("Y").' '?>CAPview, LLC, All rights reserved.
                     <a href="mailto:hello@twinspark.co">Email Us For Help</a>
                </div>
            </div>
</div>
</div>