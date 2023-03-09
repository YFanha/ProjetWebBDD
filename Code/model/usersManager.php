<?php
/**
 * @file      usersManager.php
 * @brief     This model is designed to implements users business logic
 * @author
 * @author
 * @author
 * @version
 */

/**
 * @brief This function is designed to verify user's login
 * @param $userEmailAddress : must be meet RFC 5321/5322
 * @param $userPsw : users's password
 * @return bool : "true" only if the user and psw match the database. In all other cases will be "false".
 * @throws ModelDataBaseException : will be throw if something goes wrong with the database opening process
 */
function isLoginCorrect($userEmailAddress, $userPsw)
{
    require "model/dbconnector.php";
    $query = "SELECT * FROM users WHERE email LIKE '$userEmailAddress'";

    $queryResult = executeQuerySelect($query);

    if(count($queryResult) == 1){
        $HashedPwd = $queryResult[0]['password'];

        $result = password_verify($userPsw, $HashedPwd);
    }
    return $result;
}

/**
 * Register User in database
 * @param $email
 * @param $username
 * @param $password
 * @param $phone
 * @param $profile_pic
 * @return bool|null
 */
function registerUser($email, $username, $password, $phone, $profile_pic){
    require "model/dbconnector.php";

    //Hash password
    $hash_pwd = password_hash($password, PASSWORD_DEFAULT);

    $userTypes_id = USER_TYPE_CLIENT;

    //Delete Space in phone number
    $phone_number = str_replace(" ", "", $phone);

    //Set profile pic with default
    $pic = DEFAULT_PROFILE_PIC;

    //Prepare query for execution
    $query = "INSERT INTO users (username, email, password, phone_number, profile_pic, userTypes_id) ";
    $query .= "VALUES ('$username', '$email', '$hash_pwd', '$phone_number', '$pic', '$userTypes_id');";

    //Execute SQL query
    $result = executeQueryIUD($query);

    //Get img if the recording went well
    if ($result){
        //Get the new user's id
        $user = getUser($email);
        $user_id = $user['id'];

        //Check if an image was uploaded, error level 4 = no file | if it's true, it modify the user's profile pic
        if($profile_pic['error'] != 4){

            //Get extension of the file
            $fileExtension = "." . pathinfo($profile_pic['name'], PATHINFO_EXTENSION);

            // get new filename for no duplicate (using time and user's Id)
            $NewRandomFileName = strval(time()) . "_" . $user_id . $fileExtension;

            $fullPath = PROFILE_PIC_PATH . $NewRandomFileName;

            //If the img moved, modify the user's pic
            if(move_uploaded_file($profile_pic['tmp_name'], $fullPath)){

                $queryUpdate = "UPDATE users
                SET profile_pic = '$fullPath'
                WHERE email LIKE '$email';";

                executeQueryIUD($queryUpdate);
            }
        }
    }

    return $result;

}

/**
 * Get user datas by his email
 * @param $user_email
 * @return mixed
 */
function getUser($user_email){
    //Prepare SQL query
    $query = "SELECT * FROM users WHERE email LIKE '$user_email'";
    //Execute Query
    $queryResult = executeQuerySelect($query);

    return $queryResult[0];
}

/**
 * Change user password in database
 * @param $password
 * @param $user_email
 * @return bool|null
 */
function changePassword($password, $user_email)
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE users
            SET password = '$hashedPassword'
            WHERE email like '$user_email';";

    $result = executeQueryIUD($query);
    return $result;
}