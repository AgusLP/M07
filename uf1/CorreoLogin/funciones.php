<?php
function comp_campo($camp) {
    $camp = trim($camp);
    $camp = stripslashes($camp);
    $camp = htmlspecialchars($camp);
    return $camp;
}
function comprovar_email($email) {
    $email = comp_campo($email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = TRUE;
    } else {
        $emailError = FALSE;
    }
    return $emailError;
}
function compro_contra($contra) {
    $contra = comp_campo($contra);
    if (!preg_match("/[^a-zA-Z\d]/",$contra)) {
        $contraError = TRUE;
    } else {
        $contraError = FALSE;
    }
    return $contraError;
}