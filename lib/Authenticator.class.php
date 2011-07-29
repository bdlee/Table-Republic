<?

class Authenticator {
    /* Authentication functions */
    // lookup a user by email password. returns the user obj
    public static function authenticate($email, $password, $remember = false) {
        $user = User::getUser($email, $password);
        if(empty($user)) return false;
        // remember user
        $_SESSION["email"] = $email;
        if($remember) {
            // remember the user as long as they visit every 7 days
            setcookie("email", $user->email, time() + 60 * 60 * 24 * 7, "/");
            setcookie("password", $user->getPassword(), time() + 60 * 60 * 24 * 7, "/");
        }
        
        return true;
    }
    public function authenticated() {
        // if the session doesn't have a saved user, check the cookies and validate
        if(!isset($_SESSION["email"]) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
            return self::authenticate($_COOKIE['email'],$_COOKIE['password'], true);
        }
        return (isset($_SESSION["email"]));
    }
    public function getUser() {
        if(self::authenticated())
            return User::getUserByEmail($_SESSION['email']);
        return null;
    }
    public function logout()
    {
        // log user out
        setcookie("email", "", time() - 3600, "/");
        setcookie("password", "", time() - 3600, "/");
        foreach (array_keys($_SESSION) as $key)
            unset($_SESSION[$key]);
        setcookie(session_name(), "", time() - 3600);
        session_destroy();
    }

}