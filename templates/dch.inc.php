<?php

$conn = mysqli_connect('localhost', 'root', '', 'cobracomments');

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
