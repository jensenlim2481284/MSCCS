<?php

# Simple encryption
function simpleEncryption($key)
{
    $cipher = "AES-128-ECB";    
    return base64_encode(openssl_encrypt($key,$cipher,env('PASS_KEY')));    
}

# Simple descryption
function simpleDecryption($key)
{
    $key = str_replace(' ','',$key);
    $cipher = "AES-128-ECB";        
    return openssl_decrypt(base64_decode($key),$cipher,env('PASS_KEY'));    
}


# Function to get system config
function getConfig($config)
{   
    return config("system.$config");
}


# Function to generate reference key
function generateReferenceKey($key='')
{
    return $key . \Ramsey\Uuid\Uuid::uuid4()->toString();
}


# Function to get $_GET value - for search & filter
function requestInput($key)
{
    return request()->input($key);
}


# Function to get random color code
function randColorCode() {
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}


# Function to check nav active 
function isNavActive($routeArray)
{

    # 0 : Get current route name
    $requestRoute = Request::route()->getName();

    # 1 : Loop route and check if got wildcard
    foreach ($routeArray as $route) {
        if (strpos($route, "*") !== false) {
            $checkRoute = explode('.*', $route);
            if (strpos($requestRoute, $checkRoute[0]) !== false)
                return true;
        }
    }

    # 2 : Check if in array 
    return in_array($requestRoute, $routeArray);
}



# Function to get company 
function getCompany()
{
    if(Auth::check()) return Auth::user()->company;
    abort(404);
}