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



# Function to filter start date
function getFilterStartDate($date)
{
    $startDate = date($date);
    if (!$startDate)
        $startDate = date("1000-01-01 00:00:00");
    return $startDate;
}


# Function to filter end date
function getFilterEndDate($date)
{
    $endDate =  date('Y-m-d', strtotime('+1 day', strtotime($date)));
    if (!$date)
        $endDate = date("9999-12-31 23:59:59");
    return $endDate;
}



#  Function to format date
function formatDate($date, $format ='Y-m-d')
{
    return \Carbon\Carbon::parse($date)->format($format);
}


# Function to calculate compound 
function calculateCompound($positive, $neutral, $negative, $returnString = false)
{
    $norm =  ($positive - $negative) / 2;
    $result = ($neutral)?$neutral+$norm:0.5+$norm;
    if($result<0)$result = 0;
    if($result>1)$result = 1;

    # Return emoji string for statistic display
    if($returnString){
        $sentiment = 'ok';
        if($result <= 0.2) $sentiment = 'angry';
        if($result > 0.4) $sentiment = 'sad';
        if($result > 0.6) $sentiment = 'ok';
        if($result > 0.8) $sentiment = 'good';
        if($result >= 1) $sentiment = 'happy';
        return $sentiment;
    }

    return $result;
}