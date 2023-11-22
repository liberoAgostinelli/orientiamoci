<?php
    /*
        @author: Mirko Guida
        @date: 19/11/2023
        @description: Questa pagina viene utilizzata gestire le rotte dell'app
    */
    $USER_GUEST = [
        'login' => '',
        'insertTestUser' => '',
    ];

    $USER_STUDENT = [
        'login' => '',
        'getTecnologie' => ''
    ];
    
    $USER_STUDENT_PLUS = [
        'login' => '',
        'getTecnologie' => ''
    ];

    $USER_ADMIN = [
        'login' => '',
        'getTecnologie' => ''
    ];

    $ROUTE_APP =[
        'guest' => $USER_GUEST,
        'student' => $USER_STUDENT,
        'student_plus' => $USER_STUDENT_PLUS,
        'admin' => $USER_ADMIN,
    ];