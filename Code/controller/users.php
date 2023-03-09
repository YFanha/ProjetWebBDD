<?php
/**
 * Create session with the user'id, email, username, usertype, profile pic(path)
 * @param $email
 */
function createSession($email){
    $user = getUser($email);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $email;
    $_SESSION['username'] = $user['username'];
    $_SESSION['userType'] = $user['userTypes_id'];
    $_SESSION['profile_pic'] = $user['profile_pic'];
}

/**
 * Destroy the user's session
 */
function logout(){
    $_SESSION = array();
    session_destroy();
    require "view/login.php";
}

/**
 * Function to display the login form if no values are set, or to verify the values if values are set
 * @param $login
 */
function login($login){
    if (isset($login['inputUserEmailAddress']) &&
        isset($login['inputUserPsw'])){

        require "model/usersManager.php";

        //Extract values
        $loginEmail = $login['inputUserEmailAddress'];
        $loginPwd = $login['inputUserPsw'];

        if(isLoginCorrect($loginEmail, $loginPwd)){
            $_GET['loginErrorMessage'] = null;
            createSession($loginEmail);
            require "view/home.php";
        }else{
            $_GET['loginErrorMessage'] = "Echec de la connexion. Identifiants incorrectes"; //A CHANGER
            require "view/login.php";
        }

    }else{
        require "view/login.php";
    }

}

/**
 * function to register a new user, get the value from the form and send it to the user Manager
 * @param $newUser
 * @param $pic
 */
function register($newUser, $pic)
{
    require "model/usersManager.php";

    if (isset($newUser['inputUserEmailAddress']) &&
        isset($newUser['inputUsername']) &&
        isset($newUser['inputPassword']) &&
        isset($newUser['inputVerifyPassword']) &&
        isset($newUser['inputPhoneNumber']))
    {
        if($newUser['inputPassword'] === $newUser['inputVerifyPassword']){
            $email = $newUser['inputUserEmailAddress'];
            $username = $newUser['inputUsername'];
            $password = $newUser['inputPassword'];
            $phone = $newUser['inputPhoneNumber'];
            $profile_pic = $pic['inputProfilePic'];

            if(registerUser($email, $username, $password, $phone, $profile_pic)){
                $_GET['registerErrorMessage'] = null;
                createSession($email);
                require "view/home.php";
            }else{
                $_GET['registerErrorMessage'] = "Echec de l'enregistrement. Vérifiez les données renseignées";
                require "view/register.php";
            }

        }
    }else {
        require "view/register.php";
    }
}

/**
 * Function to verify if an user is the owner of an event (the event specified)
 * @param $event_id
 * @param $user_id
 * @param $ownerList : list of the event owner
 * @return bool
 */
function isEventOwner($event_id, $user_id, $ownerList){
    $isOwner = false;

    for($i = 0; $i < count($ownerList); $i++){
        if(in_array($user_id, $ownerList[$i])){
            $isOwner = true;
        }
    }

    return $isOwner;
}

/**
 * function to change user's password
 * @param $pwd
 */
function updatePassword($pwd){
    $password = $pwd['inputPassword'];
    $confirmPassword = $pwd['inputConfirmPassword'];

    if($password == $confirmPassword){
        changePassword($password, $_SESSION['user_id']);
    }
}

?>
