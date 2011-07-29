<?


if(!Authenticator::authenticated()) {
    DisplayController::login();
} else {
    DisplayController::listings();
}

?>
