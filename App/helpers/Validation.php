<?php


namespace Helpers;

class Validation
{
    private static $err_data = [];

    private static function checkEmail(string $email){
        if(empty($email)) {
            self::$err_data['email_err'] = 'Field is empty. Please fill it.';
        }
        else{
            if (!preg_match('/^[a-zA-Z]+\d*[a-zA-Z]+\d*@[a-z]+\.[a-z]{2,3}$/', $email)) {
                self::$err_data['email_err'] = 'Invalid email. Email can\'t contain symbols (except "@") or spaces';
            }
        }
    }

    private static function checkPhone(string $phone){
        if(empty($phone)) {
            self::$err_data['phone_err'] = 'Field is empty. Please fill it.';
        }
        else{
            if (!preg_match('/^(\s*)?(\+)?([- ()+]?\d[- ()+]?){10,14}(\s*)?$/', $phone)) {
                self::$err_data['phone_err'] = 'Invalid phone. Phone can\'t contain symbols (except "+" , "-" and "()")';
            }
        }
    }

    private static function checkUsername(string $username){
        if(empty($username)) {
            self::$err_data['username_err'] = 'Field is empty. Please fill it.';
        }
        else{
            if(strlen($username) < 3){
                self::$err_data['username_err'] = 'Too short username. Username should have at least three characters.';
            }
            else if(strlen($username) > 30){
                self::$err_data['username_err'] = 'Too long username. Username shouln\'d have more than fifteen characters.';
            }
            else if (!preg_match('/^(\w{3,15})$/', $username)) {
                self::$err_data['username_err'] = 'Invalid username. Username can\'t contain symbols (except "_"), numbers or spaces';
            }
        }
    }

    private static function checkMessage(string $message) {
        if(empty($message)) {
            self::$err_data['message_field_err'] = 'Field is empty. Please fill it.';
        }
        else{
            if(strlen($message) > 1000) {
                self::$err_data['message_field_err'] = 'Too long post text.';
            }
        }
    }

    public static function validate(array $message) {
        self::checkEmail($message['email']);
        self::checkMessage($message['message']);
        self::checkUsername($message['username']);
        self::checkPhone($message['phone']);
        return self::$err_data;
    }
}
