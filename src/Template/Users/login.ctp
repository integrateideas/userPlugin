<div class="users form">
<?= $this->Flash->render() ?>
<h4><?= __('Please enter your username and password') ?></h4>
<?= $this->Form->create(null, ['class' => 'm-t']); ?>
<div class="form-group">
  <?= $this->Form->Input('username', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Username', 'required'=>'required']); ?>
</div>
<div class="form-group">
<?= $this->Form->Input('password', ['type' => 'password', 'class' => 'form-control', 'label' => false, 'placeholder' => 'Password', 'required'=>'required']) ?>
</div>

<div class="form-group">
    <?= $this->Form->button(__('Login'), ['class' => ['btn', 'btn-primary']]); ?>
    <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#forgotPassword">Forgot Password</button>
    <!-- <strong><span class="btn btn-warning" id="forgotPassword">Forgot password?</span></strong><br> -->
</div>

<?= $this->Form->end() ?>
</div>


<div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <?= $this->Form->create(null, ['class' => 'form-horizontal','data-toggle'=>"validator"]) ?>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><?= __('FORGOT PASSWORD')?></h4>
        </div>

        <div class="modal-body">
          <div class="alert" id="rsp_msg" style=''></div>
          <div class="form-group">
            <?= $this->Form->label('forgotUsername', __('Please enter your username'), ['class' => ['col-sm-4', 'control-label']]); ?>
            <div class="col-sm-8">
              <?= $this->Form->input("forgotUsername", array(
                  "label" => false,
                  'required' => true,
                  'id'=>'forgotUsername',
                  "type"=>"text",
                  "class" => "form-control",'data-minlength'=>8,
                  'placeholder'=>"Enter Username"));
              ?>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
          <?= $this->Form->button(__('Submit'), ['class' => ['btn', 'btn-primary'], 'type' => 'button','id'=>"forgotUserPassword"]) ?>
        </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>