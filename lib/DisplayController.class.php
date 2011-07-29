<? 

class DisplayController {

    public static function login() {
        $page = new Page();

        if (isset($_POST["login_id"]) && isset($_POST["password"]))
        {
            // clean login_id 
            $login_id = trim(strtolower($_POST["login_id"]));
            $password = trim($_POST["password"]);
            
            $remember = isset($_POST['remember']);

            // authenticate user
            if (Authenticator::authenticate($login_id, $password, $remember)) {
                header('Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');
                exit;
            } else {
                $page->set('error', 'Invalid username/password');
            }
        }

        $page->set('userId', false);

        $page->display('login');
        return;
    }
    
    public static function listings() {
        $page = new Page();
        $page->set('userId',false);
        
        $restaurants = Restaurant::getActiveRestaurants();
        
        
        
        $page->set('restaurants', $restaurants);

        $page->display('listings');
        return;
    }

}