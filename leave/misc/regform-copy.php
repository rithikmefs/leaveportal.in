<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    
    <style>
      /* Import Google font - Poppins */
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }
      body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: #e7f2fd;
      }

      .container {
        position: relative;
        max-width: 700px;
        width: 100%;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      }
      .container header {
        font-size: 1.5rem;
        color: #333;
        font-weight: 600;
        text-align: center;
      }
      .container .form {
        margin-top: 30px;
      }
      .form .input-box {
        width: 100%;
        margin-top: 10px;
      }
      .input-box label {
        color: #333;
		font-weight:450;
      }
      .form :where(.input-box input, .input-box select, .input-box textarea) {
        position: relative;
        height: 40px;
        width: 100%;
        font-size: 15px;
        color: #707070;
        margin-top: 8px;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 0 15px;
		outline-color:#ffc299;
      }
	  
      .input-box input:focus,
      .input-box select:focus {
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
      }
      .form .column {
        display: flex;
        column-gap: 15px;
      }
	.error-msg{
		font-size:12px;
		color:	#ff3333;
	}

      .button input {
        height: 50px;
        width: 100%;
        color: #fff;
        font-size: 1rem;
        font-weight: 400;
        margin-top: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #e65c00;
      }
      .button input:hover {
        background: #ff944d;
      }
      /* Responsive code */
      @media screen and (max-width: 500px) {
        .form .column {
          flex-wrap: wrap;
        }
      }
    </style>
  </head>
  <body>
    <section class="container">
      <header>Register Employee</header>
      <form id="registerForm" action="regformpost.php" method="POST" class="form" name="regform" onsubmit="return validateForm();"  >

        <div class="column">
          <div class="input-box">
            <label>First Name</label>
             <input type="text" id="f-name" name="fname" placeholder="Enter First Name" />
			  <span id="firstNameError" class="error-msg"></span>
          </div>
          <div class="input-box">
            <label>Middle Name</label>
            <input type="text" name="mname" placeholder="Enter Middle Name"  />
          </div>
          <div class="input-box">
            <label>Last Name</label>
            <input type="text"  id="l-name" name="lname" placeholder="Enter Last Name"  />
			<span id="lastNameError" class="error-msg"></span>
          </div>
        </div>
        
       		
				<div class="column">		
				  <div class="input-box">
				  <label class="gender">Gender</label>
				  <select id="gender" name="gender" >
					<option value="" disabled selected>Select gender</option>
					<option value="MALE">Male</option>
					<option value="FEMALE">Female</option>
				  </select>
				  <span id="genderError" class="error-msg"></span>
				  </div>
				  <div class="input-box">
					<label>DOB</label>
					<input type="date"  name="dob" placeholder="Enter DOB" />
					<span id="dobError" class="error-msg"></span>
				  </div>
				  <div class="input-box">
					<label>Date Of Joining</label>
					<input type="date" name="doj" placeholder="Enter DOJ"  />
					<span id="dojError" class="error-msg"></span>
				  </div>  
				</div>
				
				
				
				<div class="column">
				<div class="input-box">
				  <label class="emptype">Employee Type</label>
				  <select id="emptype" name="emptype" >
					<option value="" disabled selected>Select type</option>
					<option value="ADMIN">Admin</option>
					<option value="EMPLOYEE">Employee</option>
				  </select>
				  <span id="emptypeError" class="error-msg"></span>
				  </div>
				  
				  <div class="input-box">
				  <label class="desig">Designation</label>
				  <select id="desig" name="desig" >
					<option value="" disabled selected>Select type</option>
					<option value="TRAINEE">Software Trainee</option>
					<option value="JUNIOR DEVELOPER">Junior Developer</option>
					<option value="SENIOR DEVELOPER">Senior Developer</option>
				  </select>
				  <span id="desigError" class="error-msg"></span>
				  </div>
				</div>
				
				
		
		<div class="column">	
		
				  <div class="input-box">
					<label>Email</label>
					<input type="email" name="email" placeholder="Enter email ID"  />
					<span id="emailError" class="error-msg"></span>
				  </div>
				  
				  <div class="input-box">
					<label>Mobile</label>
					<input type="tel" id="mobile" name="mobile" placeholder="Enter mobile number" />
					<span id="mobileError" class="error-msg"></span>
				  </div>
					</div>
		
		<div class="input-box">
					<label>Address</label>
					<input type="text" id="address" name="address" rows="3" placeholder="Enter Address" maxlength="80" ></input>
				  </div>
				  
			
		
		<div class="column">
		<div class="input-box">
			<label>Username</label>
			<input type="text" id="username" name="username" placeholder="Enter username" />
			<span id="usernameError" class="error-msg"></span>
		  </div>
		<div class="input-box">
          <label>Password</label>
          <input type="password" id="password" name="password" placeholder="Enter Password"  />
		  <span id="PassError" class="error-msg"></span>
        </div>
		
		
		</div>
		
		
         <div class="button">
                    <input type="submit" value="Submit" name="create"/>
                </div>
      </form>
    </section>
	<script>
 
	  
	  function validateForm() {
        var form = document.regform;
        var fname = form.fname.value;
		var lname = form.lname.value;
		var gender = form.gender.value;
		var dob = form.dob.value;
		var doj = form.doj.value;
		var email = form.email.value;
		var mobile = form.mobile.value;
		var password = form.password.value;
		var username = form.username.value;
		var emptype = form.emptype.value; 
        var desig = form.desig.value;
		var isValid = true;
		 
		 if (fname.trim() === '') {
            displayError('firstNameError', 'Please enter First Name');
            isValid = false;
        } else if (!/^[A-Za-z\s]+$/.test(fname)) {
            displayError('firstNameError', 'First Name must contain only letters and spaces');
            isValid = false;
        }
		else {
            clearError('firstNameError');
        }
		
		 if (lname.trim() === '') {
            displayError('lastNameError', 'Please enter Last Name');
            isValid = false;
        } else if (!/^[A-Za-z\s]+$/.test(lname)) {
            displayError('lastNameError', 'Last Name must contain only letters and spaces');
            isValid = false;
        }
		else {
            clearError('lastNameError');
        }
		
		 if (gender === '') {
                displayError('genderError', 'Please select Gender');
                isValid = false;
            } else {
                clearError('genderError');
            }

          
            if (dob.trim() === '') {
                displayError('dobError', 'Please enter Date of Birth');
                isValid = false;
            } else {
                clearError('dobError');
            }

           
            if (doj.trim() === '') {
                displayError('dojError', 'Please enter Date of Joining');
                isValid = false;
            } else {
                clearError('dojError');
            }
			
			 if (emptype === '') {
				displayError('emptypeError', 'Please select Employee Type');
				isValid = false;
			} else {
				clearError('emptypeError');
			}

			if (desig === '') {
				displayError('desigError', 'Please select Designation');
				isValid = false;
			} else {
				clearError('desigError');
			}

            
            if (email.trim() === '') {
                displayError('emailError', 'Please enter Email');
                isValid = false;
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                displayError('emailError', 'Please enter a valid Email');
                isValid = false;
            } else {
                clearError('emailError');
            }
		

		
		 if (mobile.trim() === '') {
            displayError('mobileError', 'Please enter Mobile Number');
            isValid = false;
        } else if (!/^[0-9]{10}$/.test(mobile)) {
            displayError('mobileError', 'Please enter a valid 10-digit Mobile Number');
            isValid = false;
        } 
		else {
            clearError('mobileError');
        }
		
		if (username.trim() === '') {
			displayError('usernameError', 'Please enter Username');
			isValid = false;
		} else if (!/^[A-Za-z]+$/.test(username)) {
			displayError('usernameError', 'Username must contain only letters');
			isValid = false;
		} else {
			clearError('usernameError');
		}
		
		if (password.trim() === '') {
        displayError('PassError','Please enter Password');
        isValid = false;
		} else if (!/(?=.*[!@#$%^&*])(?=.*\d)[A-Za-z\d!@#$%^&*]{6,}$/.test(password)) {
			displayError('PassError', 'Password must include a digit and special character.');
			isValid = false;
		}
		else {
            clearError('PassError');
        }
		
		   return isValid;
    }
	
	 /*document.addEventListener('DOMContentLoaded', (event) => {
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 'true') {
            echo 'alert("Form submitted successfully!");';
            unset($_SESSION['form_submitted']);
        }
        ?>*/
	
	
	
        function displayError(id, errmsg) {
            var disp = document.getElementById(id);
            disp.innerHTML = errmsg;
        }
	
	
    
        function clearError(id) {
            var disp = document.getElementById(id);
            disp.innerHTML = "";
        }
		
    </script>
	
  </body>
</html>
