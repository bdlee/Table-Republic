<?
    $this->display('header');
?>

<div class="entryForm">

<div>Looks like you need to log in:</div>
  <? if (isset($_POST["action"])): ?>
    <div class="alert">
      Invalid email address and/or password.
    </div>
  <? endif ?>

  <form action="/login.php" method="post" name="login">
    <input name="ra" type="hidden" value="<? echo @htmlentities($_REQUEST["ra"]); ?>" />
    <table>
      <tr>
        <td>Email Address:</td>
        <td><input class="text" name="login_id" size="24" type="text" value="<? @print(($_POST["login_id"]) ? $_POST["login_id"] : $_COOKIE["login_id"]); ?>" />
        </td>
      </tr>
      <tr>
        <td>Password:</td>
        <td><input class="text" name="password" size="24" type="password" /></td>
      </tr>
      <tr>
        <td></td>
        <td><input class="text" name="remember" type="checkbox" /> Remember Me</td>
      </tr>
      <tr>
        <td></td>
        <td><br /><input name="action" type="submit" alt="Login" value="Log In" class="button" /></td>
      </tr>
    </table>
  </form>
  <br />
  <div>
    New User? Register <a href="/register.php">here</a>
  </div>
</div>


<script type="text/javascript">
// <![CDATA[
        
    // put cursor in login_id field if empty
    if (document.forms.login.login_id.value == "")
    {   
        document.forms.login.login_id.focus();
        document.forms.login.login_id.value = document.forms.login.login_id.value;
    }
    
    // else put cursor in password field
    else
    {
        document.forms.login.password.focus();
        document.forms.login.password.value = document.forms.login.password.value;
    }

// ]]>
</script>


<?
    $this->display('footer');
?>