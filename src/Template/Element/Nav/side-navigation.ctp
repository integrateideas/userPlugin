<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('User Management'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    </ul>
</nav>


 -->


  <?= $this->Html->css(['/integrateideas/user/css/sidenav']) ?>

 <div id="mySidenav" class="sidenav">
  <?= $this->Html->link(__('User Management'), ['controller' => 'Users', 'action' => 'index']) ?>
  <?= $this->Html->link(__('User Roles Management'), ['controller' => 'Roles', 'action' => 'index']) ?>
  <?= $this->Html->link(__('Settings'), ['controller' => 'Users', 'action' => 'index'] /*['controller' => 'Roles', 'action' => 'add']*/) ?>
  <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?>
 </div>

<!-- Use any element to open the sidenav -->
<span onclick="openNav()">open</span>

<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
 <?= $this->Html->script(['/integrateideas/user/js/sidenav']) ?>