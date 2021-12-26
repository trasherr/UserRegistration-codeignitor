<div class="box">
    <h1>Login</h1>
        
    <div class="left-position">
        <img src="/login/assets/student.png" alt="Student Image"/>
    </div>
    <br>
    <div class="right-position">
        <?php if (!empty(session()->getFlashData('fail'))) 
                echo "<div class='coverInput' style='padding:5px;' >". session()->getFlashData('fail') . " </div>" ;?>
        <form action="/cod/public/Signin/student" method="post">
            
            <div class="coverInput" ><?=  isset($validation) ?  display_error($validation,'username') : "" ;?>
                <input type="text" name="username" value="<?= set_value('username'); ?>" placeholder="Enter Username" required />
            </div>

            <div class="coverInput"><?=  isset($validation) ?  display_error($validation,'password') : "" ;?>
                <input type="password" name="password" placeholder="Enter password" required />
            </div>

            <input type="submit" value="Login" />
            
            <p>No account yet?<a href="/cod/public/Signin/st_register">Register Here</a></p>
            <a href="forget_password">Forgot password?</a>
            
        </form>
    </div>
    
</div>



