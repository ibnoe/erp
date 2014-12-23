<?php

if ( !isset($_REQUEST['term']) )
    exit;

$dblink = mysql_connect('localhost', 'root', '') or die( mysql_error() );
mysql_select_db('journalstack');

$rs = mysql_query('select id, reg_number, name from  mytable where name like "'. mysql_real_escape_string($_REQUEST['term']) .'%" order by name asc limit 0,10', $dblink);

$data = array();
if ( $rs && mysql_num_rows($rs) )
{
    while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => $row['name'] .', '. $row['reg_number'] ,
            'value' => $row['id']
        );
    }
}

echo json_encode($data);
flush();

