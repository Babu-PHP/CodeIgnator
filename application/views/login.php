<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">
		* {box-sizing: border-box}

		/* Add padding to containers */
		.container {
		  padding: 16px;
		}

		/* Full-width input fields */
		input[type=text], input[type=password] {
		  width: 100%;
		  padding: 15px;
		  margin: 5px 0 22px 0;
		  display: inline-block;
		  border: none;
		  background: #f1f1f1;
		}

		input[type=text]:focus, input[type=password]:focus {
		  background-color: #ddd;
		  outline: none;
		}

		/* Overwrite default styles of hr */
		hr {
		  border: 1px solid #f1f1f1;
		  margin-bottom: 25px;
		}

		/* Set a style for the submit/register button */
		.registerbtn {
		  background-color: #4CAF50;
		  color: white;
		  padding: 16px 20px;
		  margin: 8px 0;
		  border: none;
		  cursor: pointer;
		  width: 100%;
		  opacity: 0.9;
		}

		.registerbtn:hover {
		  opacity:1;
		}

		/* Add a blue text color to links */
		a {
		  color: dodgerblue;
		}

		/* Set a grey background color and center the text of the "sign in" section */
		.signin {
		  background-color: #f1f1f1;
		  text-align: center;
		}
	
	</style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<?php if($this->session->flashdata('success')): ?>
    <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
<?php endif; ?>
<?php if($this->session->flashdata('error')): ?>
    <div style="color: red;"><?php echo $this->session->flashdata('error'); ?></div>
<?php endif; ?>
<div style="color: red;"><?php echo validation_errors(); ?></div>
<form name="regform" id="regform" action="<?php echo site_url('user/login') ?>" method="post">
  <div class="container">
    <h1>Login</h1>
    <p>Please fill in this form to access your account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw">
    <hr>
    <button type="submit" class="registerbtn">Login</button>
  </div>

  <div class="container signin">
    <p>Are you New User? <a href="<?php echo site_url('user/register') ?>">Sign Up</a>.</p>
  </div>
</form>

</body>
</html>