<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->script('/integrateideas/user/js/jquery-2.1.1.js') ?>
    <?= $this->Html->css('/integrateideas/user/css/style.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/bootstrap.min.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/plugins/metisMenu/dist/metisMenu.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/plugins/fontawesome/css/font-awesome.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/plugins/animate.css/animate.css') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/slimScroll/jquery.slimscroll.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/bootstrap/dist/js/bootstrap.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/inspinia.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/pace.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/jquery.metisMenu.js') ?>
    <?= $this->fetch('/integrateideas/user/js/meta') ?>
    <?= $this->fetch('/integrateideas/user/css') ?>
    <?= $this->fetch('/integrateideas/user/js/script') ?>
    <?= $this->Html->script('/integrateideas/user/js/super_admin') ?>

    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <?= $this->Html->script(['/integrateideas/user/js/toastr.min.js']) ?>
    <?= $this->Html->css('/integrateideas/user/css/toastr.min.css') ?>

    <?= $this->Html->script('/integrateideas/user/js/jquery-2.1.1.js') ?>
    <?= $this->Html->css('/integrateideas/user/css/style.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/bootstrap.min.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/plugins/metisMenu/dist/metisMenu.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/plugins/fontawesome/css/font-awesome.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/plugins/animate.css/animate.css') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/slimScroll/jquery.slimscroll.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/bootstrap/dist/js/bootstrap.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/inspinia.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/pace.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/jquery.metisMenu.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/super_admin') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery/dist/jquery.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery-ui/jquery-ui.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery-flot/jquery.flot.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery-flot/jquery.flot.resize.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery-flot/jquery.flot.pie.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/flot.curvedlines/curvedLines.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery.flot.spline/index.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/iCheck/icheck.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/peity/jquery.peity.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/sparkline/index.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/homer.js') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
    <?=  $this->Form->hidden('baseUrl',['id'=>'baseUrl','value'=>$this->Url->build('/', true)]); ?>
        <!-- <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul> -->
        <!-- <div class="top-bar-section">
            <ul class="right">
                <li><a target="_blank" href="http://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="http://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div> -->
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>