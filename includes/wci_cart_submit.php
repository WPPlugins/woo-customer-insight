<?php

$cart_action = sanitize_text_field( $_REQUEST['action_name'] );
print_r( $cart_action );
die;
