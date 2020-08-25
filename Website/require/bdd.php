<?php
try
{
    $bdd = new PDO('mysql:host=db5000643778.hosting-data.io;dbname=dbs600296;charset=utf8', 'dbu596465', 'GBaf1994!', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
