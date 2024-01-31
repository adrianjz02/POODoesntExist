<?php

namespace App\Database;

class User {
    /**
     * Classe représentant un utilisateur.
     *
     * @var int|null $id L'identifiant de l'utilisateur.
     * @var string|null $name Le nom de l'utilisateur.
     * @var string|null $email L'adresse email de l'utilisateur.
     * @var string|null $message Le message de l'utilisateur.
     * @var string|null $city La ville de l'utilisateur.
     * @var int|null $age L'âge de l'utilisateur.
     */
    public $id;
    public $name;
    public $email;
    public $message;
    public $city;
    public $age;

    /**
     * Constructeur de la classe User.
     *
     * @param int|null $id L'identifiant de l'utilisateur.
     * @param string|null $name Le nom de l'utilisateur.
     * @param string|null $email L'adresse email de l'utilisateur.
     * @param string|null $message Le message de l'utilisateur.
     * @param string|null $city La ville de l'utilisateur.
     * @param int|null $age L'âge de l'utilisateur.
     */
    public function __construct($id = null, $name = null, $email = null, $message = null, $city = null, $age = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->city = $city;
        $this->age = $age;
    }

    // Getters

    /**
     * Obtient l'identifiant de l'utilisateur.
     *
     * @return int|null L'identifiant de l'utilisateur.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Obtient le nom de l'utilisateur.
     *
     * @return string|null Le nom de l'utilisateur.
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Obtient l'adresse email de l'utilisateur.
     *
     * @return string|null L'adresse email de l'utilisateur.
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Obtient le message de l'utilisateur.
     *
     * @return string|null Le message de l'utilisateur.
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * Obtient la ville de l'utilisateur.
     *
     * @return string|null La ville de l'utilisateur.
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Obtient l'âge de l'utilisateur.
     *
     * @return int|null L'âge de l'utilisateur.
     */
    public function getAge() {
        return $this->age;
    }

    // Setters

    /**
     * Définit l'identifiant de l'utilisateur.
     *
     * @param int|null $id L'identifiant de l'utilisateur.
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Définit le nom de l'utilisateur.
     *
     * @param string|null $name Le nom de l'utilisateur.
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Définit l'adresse email de l'utilisateur.
     *
     * @param string|null $email L'adresse email de l'utilisateur.
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Définit le message de l'utilisateur.
     *
     * @param string|null $message Le message de l'utilisateur.
     */
    public function setMessage($message) {
        $this->message = $message;
    }

    /**
     * Définit la ville de l'utilisateur.
     *
     * @param string|null $city La ville de l'utilisateur.
     */
    public function setCity($city) {
        $this->city = $city;
    }

    /**
     * Définit l'âge de l'utilisateur.
     *
     * @param int|null $age L'âge de l'utilisateur.
     */
    public function setAge($age) {
        $this->age = $age;
    }
}