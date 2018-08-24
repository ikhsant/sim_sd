<?php
function sisa_pembayaran($postdata, $primary, $xcrud){
    $postdata->set('sisa_pembayaran', $postdata->get('pembayaran') - 3000000 );
}