<?php


$type = isset($_GET['type']) ? $_GET['type'] : null;
$code = isset($_GET['code']) ? $_GET['code'] : null;

if(!is_null($type))
{
    $data = getPurchaseCode($code,$type);
    echo $data;
    
}



function getPurchaseCode($code,$type) {
    
    if($code === 'test_code')
    {
        if($type == 'migrations')
        {
        $data = file_get_contents('migrations.zip');
        return $data;
        }
        if($type == 'init')
        {
        $data = file_get_contents('init.sql');
        return $data;
        }
        
    }
    
	$personalToken = "YOUR_PERSONAL_TOKEN_HERE";

	// Surrounding whitespace can cause a 404 error, so trim it first
	$code = trim($code);

	// Make sure the code looks valid before sending it to Envato
	// This step is important - requests with incorrect formats can be blocked!
	if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code)) {
		return json_encode( ["error"=>"Invalid purchase code","success"=>false]);
	}

	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => "https://api.envato.com/v3/market/author/sale?code={$code}",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 20,
		CURLOPT_HTTPHEADER => array(
			"Authorization: Bearer {$personalToken}",
			"User-Agent: Purchase code verification script"
		)
	));

	$response = @curl_exec($ch);
	$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if (curl_errno($ch) > 0) {
	    return json_encode(["error"=>"Failed to connect","success"=>false]);
	}

	switch ($responseCode) {
	    	case 404:  return json_encode(["error"=>"Invalid purchase code","success"=>false]);
	     case 403: return json_encode(["error"=>"The personal token is missing the required permission for this script","success"=>false]);
	   case 401 : return json_encode( ["error"=>"The personal token is invalid or has been deleted","success"=>false]);
	}

	if ($responseCode !== 200) {
	    return json_encode(["error"=>"Got status {$responseCode}","success"=>false]);
	}
	
	
	if ($responseCode == 200) {
	 if($type == 'migrations')
        {
        $data = file_get_contents('migrations.zip');
        return $data;
        }
        if($type == 'init')
        {
        $data = file_get_contents('init.sql');
        return $data;
    }
	}

/*	$body = @json_decode(wp_remote_retrieve_body($response));

	if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
		throw new Exception("Error parsing response, try again");
	}

	return $body;
	// evento key = mDTuk4L95UwulqshrXfsvigTUJBdFuz1
*/

}

?>