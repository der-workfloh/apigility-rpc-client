<?php

class ApigilityRpcFault extends Exception {}

class ApigilityRpcClient {
    protected $uri;

    public function __construct($uri) 
    {
        $this->uri = $uri;
    }

    
    /**
     * Call the rpc class method
     * @param array $arguments
     * @return stdClass
     */
    public function post(array $arguments) 
    {                                                                  
        $data_string = json_encode($arguments);

        $curl_handle=curl_init($this->uri);                                                                    
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array( 
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        );

        $query = curl_exec($curl_handle);
        $iHttpCode = curl_getinfo($curl_handle,CURLINFO_HTTP_CODE);
        curl_close($curl_handle);
        
        $result = json_decode($query);
        
        switch ($iHttpCode) {
            case 422:
                throw new InvalidArgumentException('An error occurred: '.$result->detail);
        }

        return $result;
    }
}
