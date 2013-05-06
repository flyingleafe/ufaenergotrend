<?php
function validatePhone($phone) {
    $re = "/^(\+7[-. ]?|8[ .-]?)?(\()?([0-9]{3})(?(2)\))[-. ]?(([0-9]{2})|([0-9]{3}))[-. ]?([0-9]{2})[-. ]?(?(6)([0-9]{2})|([0-9]{3}))$/";
    return preg_match($re, $phone);
}

function attempt($login, $pw, $hashed = false) {
    if(!$hashed) {
        $pw = hash('gost', $pw);
    }
    $user = new DB\SQL\Mapper(F3::get('DB'), DB_USERS_TABLE);
    $user->load(array('login=?', $login));

    if($user->pw === $pw) {
         F3::set('USER', $user);
         return true;
    }
    return false;
}

function dateParse($timestamp) {
    $period = time() - $timestamp;
    $days_passed = ($period - $period % 86400) / 86400;
    if($days_passed == 0) {
        return "сегодня в ".date('H:i', $timestamp);
    } else if($days_passed == 1) {
        return "вчера в ".date('H:i', $timestamp);
    } else {
        return date('j.m.Y в H:i', $timestamp);
    }
}