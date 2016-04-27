<?php

// if(isset($_REQUEST['worker_login'])){

// 	$url = 'http://radatholdings.com/rents/mobile/projects/index';
// 	$data = array('project_id'=> 1);

// 	$data_string = json_encode($data);

// 	try{                                                                                                         

// 			$ch = curl_init($url);                                                                      
// 			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                 
// 			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
// 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
// 			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
// 				'Content-Type: application/json',                                                                                
// 				'Content-Length: ' . strlen($data_string))                                                                       
// 			);                                                                                
// 			$result = curl_exec($ch);
// 			curl_close($ch);
// 			// $decoded_json = json_decode($result);

// 			$json = json_decode($result, true);
					
// 			echo json_encode($response);
					 
// 	}
// 	catch(Exception $e)
// 	{
// 		$response['message'] = 'fail';
// 		$response['result'] = 'Something went wrong';
		
// 		echo json_encode($response.' '.$e);
// 	}
// }

// else if(isset($_REQUEST['regsiter']))
// {

	$fname = "Brian";
	$lname = "Adams";

	
	

	$url = 'http://radatholdings.com/rents/mobile/projects/submit_tenants/1';

	$symbol['fname'] = $fname;
	$symbol['lname'] =$lname;
	// $data = array('project_id'=> 1);

	$data_string = json_encode($symbol);

	try{                                                                                                         

			$ch = curl_init($url);                                                                      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json',                                                                                
				'Content-Length: ' . strlen($data_string))                                                                       
			);                                                                                
			$result = curl_exec($ch);
			curl_close($ch);
			// $decoded_json = json_decode($result);

			$json = json_decode($result, true);
					
			echo json_encode($response);
					 
	}
	catch(Exception $e)
	{
		$response['message'] = 'fail';
		$response['result'] = 'Something went wrong';
		
		echo json_encode($response.' '.$e);
	}
// }
?>
