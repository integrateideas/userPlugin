<div class="row">
<div class="col-lg-12">
    <div class="hpanel">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <?= $this->Form->create($user, ['data-toggle'=>'validator','class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) ?>
               <!--  <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= $this->Form->label('name', __('Roles'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                       <?= $this->Form->input('role_id', ['label' => false, 'required' => true, 'class' => ['form-control']]); ?>
                    </div>
                </div> -->
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('first_name', __('First Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('first_name', ['label' => false,'required' => true,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('last_name', __('Last Name'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('last_name', ['label' => false,'required' => true,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('email', __('Email'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('email', ['label' => false,'required' => true,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('phone', __('Phone'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('phone', ['label' => false,'required' => true,"placeholder" => "1(800)233-2742",'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('username', __('Username'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('username', ['label' => false,'required' => true,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('password', __('Password'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('password', ['label' => false,'data-minlength' => 8, 'required' => true,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <?= $this->Form->label('status', __('Status'), ['class' => ['col-sm-2', 'control-label']]); ?>
                    <div class="col-sm-10">
                        <?= $this->Form->input('status', ['label' => false,'class' => ['form-control m-b']]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                    <?= $this->Form->button(__('Submit'), ['class' => ['btn', 'btn-primary']]) ?>
                    <?= $this->Html->link('Cancel', $this->request->referer(),['class' => ['btn', 'btn-danger']]);?>
                    </div>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>