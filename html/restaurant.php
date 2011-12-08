<?

// check authenticated
if(!Authenticator::authenticated()) {
    DisplayController::login();
}

DisplayController::restaurant();

?>