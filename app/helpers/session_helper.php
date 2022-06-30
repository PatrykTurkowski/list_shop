<?php
session_start();

function isToken()
{
    if (isset($_SESSION['token'])) {
        return true;
    } else {
        return false;
    }
}
