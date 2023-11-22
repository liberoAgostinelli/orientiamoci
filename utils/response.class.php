<?php
    /*
        @author: Mirko Guida
        @date: 19/11/2023
        
        @description: Classe per gestire le risposte API
    */
    class Response {
        public $result;//1 = ok, 0 = error
        public $error;
        public $errorMessage;
        public $data;
        public $token;
        public $info;

        function __construct(){
        }
    }