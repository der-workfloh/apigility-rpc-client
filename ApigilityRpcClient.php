<?php

class ApigilityRpcClient {
    
    /**
     * URI of RPC-Server
     * @var string
     */
    protected $uri;
    
    
    /**
     * Constructor
     * @param string $uri
     */
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
        // --- Encode data to json format
        $data_string = json_encode($arguments);

        // --- prepare cUrl to send a http post request
        $curl_handle=curl_init($this->uri);                                                                    
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array( 
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        );

        // --- send a http post request
        $query = curl_exec($curl_handle);
        $iHttpCode = curl_getinfo($curl_handle,CURLINFO_HTTP_CODE);
        curl_close($curl_handle);
        
        // --- decode http response content from json to stdClass
        $result = json_decode($query);
        
        // --- check http return code
        switch ($iHttpCode) {
            case 422:
                throw new InvalidArgumentException('[InvalidArgument] '.$result->detail);
            case 200:
                // everything's ok
                break;
            default:
                throw new RuntimeException('[Runtime] Abort with Http-Code '.$iHttpCode);
        }

        return $result;
    }
}

