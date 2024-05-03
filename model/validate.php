<?php
//Brenden Haskins       functions used to validate incoming data

function validName($inputString): bool{
    return !preg_match("/\d/",$inputString);
}

function validLink($inputString): bool{
    return (filter_var($inputString,FILTER_VALIDATE_URL)) || ($inputString == "");
}

function validExperience($inputExperience): bool{
    return preg_match("/\d-\d/",$inputExperience);
}

function validPhone($inputNumber): bool{
    return preg_match("/\d{10,11}/",$inputNumber);
}

function validEmail($inputAddress): bool{
    return preg_match("/([@.])/",$inputAddress);
}


