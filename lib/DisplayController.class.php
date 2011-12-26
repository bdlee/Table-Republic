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
        
        self::_initSearch($page);
        $page->display('home');
        return;
    }
    
    public static function listings() {
        $page = new Page();
        // $page->set('userId',false);
        
        $searchCriteria = $_GET;
        $page->set('searchCriteria', $searchCriteria);
        $restaurants = Restaurant::getActiveRestaurants($searchCriteria);
        
        $page->set('restaurants', $restaurants);

        self::_initSearch($page);
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

        $searchCriteria = $_GET;
        $page->set('searchCriteria', $searchCriteria);
        
        $page->set('restaurant', $restaurant);

        self::_initSearch($page);
        $page->display('restaurant');
        return;
    }
    
    private static function _initSearch(&$page) {
        $defaultDate = Helpers::defaultDate();
        $defaultDate->add(new DateInterval('P7D'));
        
        $param_display_date   = isset($_GET['display_date']) ? $_GET['display_date'] : $defaultDate->format('F j, Y');
        $param_date           = isset($_GET['date']) ? $_GET['date'] : $defaultDate->format('m/d/Y');
        $param_time           = isset($_GET['time']) ? $_GET['time'] : '18:00';
        $param_num            = isset($_GET['num']) ? $_GET['num'] : null;
        
        $searchfields = array(
            'display_date' => $param_display_date,
            'date' => $param_date,
            'time' => $param_time,
            'num' => $param_num
        );
        $page->set('searchfields', $searchfields);
        $page->set('includeSearch', true);
    }
}