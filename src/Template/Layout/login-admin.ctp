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

$cakeDescription = 'CAPview';
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

    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/plugins/fontawesome/css/font-awesome.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/plugins/metisMenu/dist/metisMenu.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/plugins/animate.css/animate.css') ?>
    <?= $this->Html->css('/integrateideas/user/css/plugins/bootstrap/dist/css/bootstrap.css') ?>

    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery/dist/jquery.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery-ui/jquery-ui.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/slimScroll/jquery.slimscroll.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/bootstrap/dist/js/bootstrap.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery-flot/jquery.flot.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery-flot/jquery.flot.resize.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery-flot/jquery.flot.pie.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/flot.curvedlines/curvedLines.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/jquery.flot.spline/index.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/metisMenu/dist/metisMenu.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/iCheck/icheck.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/peity/jquery.peity.min.js') ?>
    <?= $this->Html->script('/integrateideas/user/js/plugins/sparkline/index.js') ?>
    
    <?= $this->Html->script('homer.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="blank">

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Upwardly - Admin Section</h1><p>Please wait while we are loading </p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<?=  $this->Form->hidden('baseUrl',['id'=>'baseUrl','value'=>$this->Url->build('/', true)]); ?>

<div class="color-line"></div>
  <?= $this->Flash->render() ?>
  <?= $this->Flash->render('auth', ['element' => 'Flash/error']) ?>
    <?= $this->fetch('content'); ?>
       
</body>

</html>