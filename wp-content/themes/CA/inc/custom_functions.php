<?php 
session_start();
//global $wp_session;
//$_SESSION['messages'][$type] = $message;
//$wp_session['messages'] = 'Client deleted successfully.';

// Store success messages
function save_message( $type, $message = '' ) {
    session_start();
    $_SESSION['messages'][$type] = $message;
}

function get_messages() {
    session_start();
    $return = '';

    if ( isset( $_SESSION['messages'] ) && is_array( $_SESSION['messages'] ) ) {
        foreach( $_SESSION['messages'] as $type => $message ) {
            $return .= sprintf( '<p class="%1$s">%2$s</p>', $type, $message );
        }
    }

    if ( strlen( $return ) > 0 )
        return $return;

    return false;
}

function clean_messages( $type = false ) {
    session_start();
    if ( ! $type )
        $_SESSION['messages'] = array();
    else
        unset( $_SESSION['messages'][$type]);
}