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
		input[type=text], input[type=password], select, textarea {
		  width: 100%;
		  padding: 15px;
		  margin: 5px 0 22px 0;
		  display: inline-block;
		  border: none;
		  background: #f1f1f1;
		}

		input[type=text]:focus, input[type=password]:focus, select:focus, textarea:focus {
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
<?php
//print_r($countries);
$countries_data = json_decode($countries, TRUE);
?>
<form name="regform" id="regform">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="first_name" required>

    <label for="email"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="last_name" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

    <label for="email"><b>Mobile Number</b></label>
    <input type="text" placeholder="Enter Email" name="mobileno" required>

    <label for="email"><b>Address</b></label>
    <textarea name="address" cols="30" rows="2" required></textarea>

    <label for="email"><b>Country</b></label>
    <select name="country" id="country">
    	<option value="">Select</option>
    	<?php
    		if(count($countries_data['result'])){
    			foreach ($countries_data['result'] as $key => $value) {
    				echo '<option value="'.$key.'">'.$value.'</option>';
    			}
    		}
    	?>
    </select>

    <label for="email"><b>State</b></label>
    <select name="state" id="state">
    	<option value="">Select</option>
    </select>

    <label for="email"><b>City</b></label>
    <select name="city" id="city">
    	<option value="">Select</option>
    </select>
    <hr>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="button" class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="<?php echo site_url('user/login') ?>">Sign in</a>.</p>
  </div>
</form>

</body>
</html>
<script>
$(document).ready(function(){
  $(".registerbtn").click(function(){
  	var err = '';

  	if(err == ''){
  		var formdata = $("#regform").serialize();
  		$.ajax({
  			url:'<?php echo site_url('ajax_control/register') ?>',
  			data:formdata,
  			async:true,
  			type:'POST',
  			success:function(msg){
  				alert(msg);
  			}
  		});
  	}
    //alert('kk');
  });

  $("#country").change(function(){
  	
  	var cur_country = $(this).val();
  	alert('cur_country:'+cur_country);
  	if(cur_country != ''){
  		$.ajax({
  			url:'<?php echo site_url('ajax_control/getStates') ?>',
  			data:{'countryid':cur_country},
  			async:true,
  			type:'GET',
  			success:function(msg){
  				var jsondata = JSON.parse(msg);
  				console.log(jsondata.result);
  				var states = '<option value="">Select</option>';
  				$.each(jsondata.result, function(index, value){
  					console.log('index:'+index+" | text:"+value); 
  					states +='<option value="'+index+'">'+value+'</option>';
  				});
  				$("#state").html(states);
  			}
  		});
  	}
  });
});
</script>