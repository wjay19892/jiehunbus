<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
$(function(){
	signin(true);
});
</script>
<div title="<?php echo L("please_sign_in");?>" style="width:510px; height:485px;">
        	<h2 class="other_login_tit signin_h"><?php echo L("user_register_h2");?></h2>
            <div style="text-align:center;" class="other_login clearfix">
           	  <?php if(is_array($login_portdata)): $i = 0; $__LIST__ = $login_portdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a href="<?php echo U('Login_port/index/id/'.$vo['id']);?>" class="big"><img src="__ROOT__<?php echo ($vo["logo"]); ?>" alt="<?php echo ($vo["name"]); ?>" /></a><?php endforeach; endif; else: echo "" ;endif; ?>
              </div>
              <h3 class="signpainter signin_h jvf_allimg"><?php echo L("or_text");?></h3>
              <h2 class="signin_h"><?php echo L("user_signin_h2");?></h2>
              
              <form id="signinform" action="<?php echo U('User/login');?>" method="post">
                <div class="textinput jvf_allimg mail_pos" id="inputEmail">
                    <input type="text" name="email" tabindex="1" id="signin_email"  value="" placeholder="<?php echo L("mail_text");?>" />
                </div>
                <div class="textinput jvf_allimg pas_pos" id="inputPassword">
                    <input type="password" name="password" id="signin_password" tabindex="2" placeholder="<?php echo L("password_text");?>" />
                </div>
                <div class="forgotPassword"><a href="<?php echo U('User/ajaxforgot_password');?>" tabindex="5"><?php echo L("forgot_password");?></a></div>
                <div class="formactions clearfix">
                	 <span class="jvf_mgf"><input type="button" class="btn p2153 f20 jvf_bold" value="<?php echo L("login_text");?>" tabindex="4" id="submit" /></span>
                    <label class="checkbox remember_me" for="remember_me2">
                        <span><input type="checkbox" tabindex="3" value="true" id="remember_me2" name="remember_me" ></span>
                        <span><?php echo L("user_signin_remember_me");?></span>
                    </label>
                </div>
                </form>
</div>