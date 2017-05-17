<div class="row">
    <div class="col-md-12">
        <div class="row">
            <h4><?= __('Password complexity:') ?></h4>
            <ul>
                <li>Must not contain three or more contiguous characters of your account name or full name.<br></li>
                <li>The password needs to be set six times before it can be reused.</li>
            </ul>
        </div>
        <div class="row">
            <?= $this->Form->create(null, []) ?>
                <div class="col-lg-12">
                    <h4><?= __('New Password') ?></h4>
                    <div class="form-group">
                        <div class = "row">
                            <?= $this->Form->input("new_pwd", array(
                                "label" => false,
                                'required' => true,
                                'id'=>'new_pwd',
                                "type"=>"password",
                                "class" => "form-control",
                                'data-minlength'=>8,
                                'placeholder'=>"Enter Password"));
                            ?>
                        </div>
                    </div>
                    <?= $this->Form->hidden('reset-token',['value' => $resetToken]);?>
                    <h4><?= __('Confrirm Password') ?></h4>
                    <div class="form-group">
                        <div class = "row">
                            <?= $this->Form->input("cnf_new_pwd", array(
                                "label" => false,
                                'required' => true,
                                "class" => "form-control",
                                'id'=>'cnf_new_pwd',
                                'data-minlength'=>8,
                                "type"=>"password",
                                'placeholder'=>"Confirm Password"));
                            ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>