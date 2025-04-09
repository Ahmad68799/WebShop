<body>
    <!-- Sign UP -->
    <div class="sign-up">
        <form action="PHP/register.php"method="post">
            <h1>Sign Up</h1>

            <div class="form-row">
                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text" required>
    
                    <label>Prefix</label>
                    <input name="prefix" type="text">
    
                    <label>Last Name</label>
                    <input name="lastname" type="text" required>
    
                    <label>Place</label>
                    <input name="place" type="text" required>
    
                    <label>Street</label>
                    <input name="street" type="text" required>
                </div>
                <div class="form-group">
                    <label>House Number</label>
                    <input name="housenumber" type="text" required>
    
                    <label>Zip Code</label>
                    <input name="zipcode" type="text" required>
    
                    <label>Email</label>
                    <input name="email" type="email" required>
    
                    <label>Password</label>
                    <input name="password" type="password" required>
    
                    <label>Confirm Password</label>
                    <input name="confirm_password" type="text" required>
    
                    <label>Date of Birth</label>
                    <input name="birth" type="date" required>
                    <button type="submit" class="submit-btn1">Submit</button>
                        <p>Already have an account? <a href="index.php?page=login">Login here</a></p>
                </div>
        </form>
    </div>
</body>