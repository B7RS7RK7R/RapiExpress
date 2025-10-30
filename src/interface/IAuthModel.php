<?php
namespace RapiExpress\Interface; 

interface IAuthModel {
    public function autenticar($username, $password);
    public function recuperarPassword($username, $newPassword);
}