 <div class="box">
        <h1>Teacher</h1>
        <div class="left-position">
            <img src="/login/assets/character13.svg" alt="signup form SVG"/>
        </div>
        
        <div class="right-position">
            <form action="<?= base_url('signin/t_register');?>" method="POST">
                <?= csrf_field(); ?>

                <div class="coverInput" ><?=  isset($validation) ?  display_error($validation,'username') : "" ;?>
                    <input type="text" name="username" value="<?= set_value('username'); ?>" placeholder="Enter Username" required />
                </div>
            
                <div class="coverInput"><?=  isset($validation) ?  display_error($validation,'email') : "" ;?>
                    <input type="email" name="email" value="<?= set_value('email'); ?>" placeholder="Enter Email" required />
                </div>

                <div class="coverInput"><?=  isset($validation) ?  display_error($validation,'name') : "" ;?>
                    <input type="text" name="name" value="<?= set_value('name'); ?>" placeholder="Enter Full Name" required />
                </div>


                <div class="coverInput"><?=  isset($validation) ?  display_error($validation,'phone') : "" ;?>
                    <input type="tel" name="phone" value="<?= set_value('phone'); ?>" placeholder="Enter Phone Number" required />
                </div>
                
                <div class="coverInput"><?=  isset($validation) ?  display_error($validation,'password') : "" ;?>
                    <input type="password" name="password" placeholder="Enter password" required />
                </div>
                <div class="coverInput"><?=  isset($validation) ?  display_error($validation,'cpassword') : "" ;?>
                    <input type="password" name="cpassword" placeholder="Confirm Password" required />
                </div>
                <input type="submit" value="SignUp"/>
            
            </form>
        </div>
    </div>