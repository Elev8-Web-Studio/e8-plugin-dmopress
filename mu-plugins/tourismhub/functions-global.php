<?php 

// 
function isValidGoogleAnalyticsID($trackingIdString){
    return preg_match('/^ua-\d{4,9}-\d{1,4}$/i', strval($trackingIdString)) ? true : false;
}