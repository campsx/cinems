<?php

class Response
{

    public function __construct()
    {

    }

    public function status($httpCode = 200)
    {
        header('Status: '.$httpCode.' '.$this->httpCode($httpCode), false, $httpCode);
    }

    public function location ($url){
        header('Location: '.$url);
    }

    public function redirectionFrontend($uri, $httpCode = 200)
    {
        $this->redirection(URL_WEBSITE.$uri, $httpCode);
    }

    public function redirectionBackoffice($uri, $httpCode = 200)
    {
        $this->redirection(URL_WEBSITE_ADMIN.$uri, $httpCode);
    }

    private function redirection($url, $httpCode = 200)
    {
        $this->status($httpCode);
        $this->location($url);
        exit();
    }


    public function httpCode($code){
        switch ($code){
            case 100:
                return 'Continue';
            case 101:
                return 'Switching Protocols';
            case 102:
                return 'Processing';
            case 200:
                return 'Ok';
            case 201:
                return 'Created';
            case 202:
                return 'Accepted';
            case 203:
                return 'Non-Authoritative Information';
            case 204:
                return 'No Content';
            case 205:
                return 'Reset Content';
            case 206:
                return 'Partial Content';
            case 207:
                return 'Multi-Status';
            case 210:
                return 'Content Different';
            case 226:
                return 'IM Used';
            case 300:
                return 'Multiple Choices';
            case 301:
                return 'Moved Permanently';
            case 302:
                return 'Moved Temporarily';
            case 401:
                return 'Unauthorized';
            case 404:
                return 'Not Found';

        }
        return '';
    }

}
