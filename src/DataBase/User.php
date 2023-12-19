<?php

namespace App\Database;

class User {
    public $id;
    public $name;
    public $email;
    public $message;
    public $city;
    public $age;

    public function __construct($id = null, $name = null, $email = null, $message = null, $city = null, $age = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->city = $city;
        $this->age = $age;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getCity() {
        return $this->city;
    }

    public function getAge() {
        return $this->age;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setAge($age) {
        $this->age = $age;
    }
}