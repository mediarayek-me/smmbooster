<?php 


return [ 
    'client_id' => '',
    'secret' => '',
    'settings' => array(
        'mode' => '',
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];