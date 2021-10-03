<?php

class User
{
  public $id;
  public $firstname;
  public $lastname;
  public $email;
  public $username;
  public $password;
  public $birthday;
  public $createdAt;
  public $updatedAt;
}


$TOKEN_PASSWORD = "mlbb-finder";
$TOKEN_ALGORITHM = "aes128";
$TOKEN_IV = "MLBBFINDER_TOKEN"; //must be 16 bits
