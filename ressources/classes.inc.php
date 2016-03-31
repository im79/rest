<?php

class MyAPI extends API{
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);

        // Abstracted out for example
        $APIKey = "o48r98zf9e7f9w8ezf9w7ezf97wze9fd7we7";//new Models\APIKey();
        $User = "Georg Hamsner";//new Models\User(); 
		
		print_r($this);

        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } else if (array_key_exists('token', $this->request) &&
             !$User->get('token', $this->request['token'])) {

            throw new Exception('Invalid User Token');
        }

        $this->User = $User;
    }

    /**
     * Example of an Endpoint
     */
     protected function example() {
        if ($this->method == 'GET') {
            return "Your name is " . $this->User->name;
        } else {
            return "Only accepts GET requests";
        }
     }
 }