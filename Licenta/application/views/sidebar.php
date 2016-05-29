<div id="sidebar">
	<?php 
		$user = $this->session->userdata('user');
	?>

<ul>
	<a href="<?php echo base_url(); ?>"><li>Home</li></a>
	<?php if (!$user) { ?>
		<a href="<?php echo base_url('login'); ?>"><li>Login</li></a>
		<a href="<?php echo base_url('register'); ?>"><li>Register</li></a>
	<?php } else { ?>
		<!--<a href="<?php echo base_url('newPost'); ?>"><li>Post</li></a>
		<a href="<?php echo base_url('allFriends'); ?>"><li>Toti prietenii</li></a>
		<a href="<?php echo base_url('recommandedFriends'); ?>"><li>Prieteni recomandati</li></a> -->
		<a href="<?php echo base_url('logout'); ?>"><li>Logout</li></a>
	<?php 
		  if($user['type'] == 1) { ?>
		  	<a href="<?php echo base_url('adminPanel'); ?>"><li>Admin Panel</li></a>
	<?php  } }	?>
</ul>
</div>