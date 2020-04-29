<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$ruler = new hoa\ruler\ruler();

// 1. Write a rule.
$rule  = 'group in ["customer", "guest"] and points > 30';

// 2. Create a context.
$context           = new hoa\ruler\Context();
$context['group']  = 'customer';
$context['points'] = function () {
    return 42;
};

// 3. Assert!
var_dump(
    $ruler->assert($rule, $context)
);