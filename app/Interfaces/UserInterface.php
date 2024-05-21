<?php
namespace App\Interfaces;

interface UserInterface {
    public function getAllUser();
    public function getUserRoleName();
    public function getAllRoles();
    public function storeUser($request);
    public function getUserById($id);
}