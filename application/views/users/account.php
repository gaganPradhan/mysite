<?php

echo $this->session->flashdata('login');
?>
<h2><?= $users->username ;?></h2>
Username : <?= $users->id?><br>
Name : <?= $users->name;?><br>
Image:<img src='../../../assets/images/<?=$users->image;?>' width="50px" height="50px">
