<?

$page = new Page();

if(isset($_POST['action'])) {
    $errors = array();

    // validate the inputs
    if(empty($_POST['fname'])) {
        $errors['fname'] = 'Please input a valid first name';
    }
    if(empty($_POST['lname'])) {
        $errors['lname'] = 'Please input a valid last name';
    }
    if(!preg_match("/@\w+\.\w+$/", $_POST['email'])) {
        $errors['email'] = 'Please input a valid email address';
    }
    // password must contain at least one
    if(!(preg_match("/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/", $_POST['password']) && preg_match("/^.{6,20}$/", $_POST['password']))) {
        $errors['password'] = 'Please input a valid password 6-20 characters long with at least one letter and one number';
    } else if($_POST['password'] != $_POST['password2']) {
        $errors['password'] = 'You password must match';
    }

    if(empty($errors)) {
        // create the new user and redirect to success page
        $newUser = new User();
        
        $newUser->email = $_POST['email'];
        $newUser->fname = $_POST['fname'];
        $newUser->lname = $_POST['lname'];
        $newUser->setPassword($_POST['password']);
        
        $insertId = $newUser->save();
        
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');
        exit;
    }
    $page->set('errors', $errors);
}

$page->display('register');

?>