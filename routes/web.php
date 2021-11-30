<?php

# Get route group based on env 
require base_path('routes/route_group/' .env("APP_ID") . '/index.php');

