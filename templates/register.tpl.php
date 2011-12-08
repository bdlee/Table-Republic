
All fields are required:<br />
<br />
<div class="entryForm">

  <? if (isset($errors)): ?>
    <ul class="alert">
        <? foreach($errors as $i => $e): ?>
        <li><?= $e; ?></li>    
        <? endforeach; ?>
    </ul>
  <? endif ?>

  <form action="<? echo $_SERVER["PHP_SELF"]; ?>" method="post" name="login">
    <table>
      <tr>
        <td class="label">First Name:</td>
        <td class="input"><input class="text" name="fname" size="24" type="text" value="<?= @$_POST["fname"]; ?>" />
      </tr>
      <tr>
        <td class="label">Last Name:</td>
        <td class="input"><input class="text" name="lname" size="24" type="text" value="<?= @$_POST["lname"]; ?>" /></td>
      </tr>
      <tr>
        <td class="label">Email Address:</td>
        <td class="input"><input class="text" name="email" size="24" type="text" value="<?= @$_POST["email"]; ?>" />
        </td>
      </tr>
      <tr>
        <td class="label">Password:</td>
        <td class="input"><input class="text" name="password" size="24" type="password" /> Must be 6-20 characters and have at least one letter and one number</td>
      </tr>
      <tr>
        <td class="label">Re-enter Password:</td>
        <td class="input"><input class="text" name="password2" size="24" type="password" /></td>
      </tr>
      <tr>
        <td class="label"></td>
        <td class="input"><br /><input name="action" type="submit" alt="Create Account" value="Create Account" class="button" /></td>
      </tr>
    </table>
  </form>
</div>
