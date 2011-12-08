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
    
    public static function home() {
        if(@$_GET['action'] == 'Search') {
            self::listings();
            return;
        }
        $page = new Page();
        
        $page->set('includeSearch', true);
        $page->display('home');
        return;
    }
    
    public static function listings() {
        $page = new Page();
        $page->set('userId',false);
        
        $restaurants = Restaurant::getActiveRestaurants($_GET);
        
        $page->set('restaurants', $restaurants);

        $page->set('includeSearch', true);
        $page->display('listings');
        return;
    }

    public static function restaurant() {
        $id = @$_GET['id'];
        $restaurant = Restaurant::getRestaurant($id);
        if(empty($restaurant)) {
            header('Location: http://' . $_SERVER['SERVER_NAME'] . '/index.php');
            exit;
        }

        $page = new Page();

        $page->set('restaurant', $restaurant);

        $page->set('js',array('/includes/js/jquery.lightbox-0.5.pack.js'));
        $page->display('restaurant');
        return;
    }
}