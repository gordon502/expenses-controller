<?php

class Bill {
    private int $id;
    private int $user_id;
    private string $description;
    private string $date;
    private int $amount;
    private int $category_id;


    public function __construct(int $id, int $user_id, string $description, string $date, int $amount, int $category_id) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->description = $description;
        $this->date = $date;
        $this->amount = $amount;
        $this->category_id = $category_id;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getUserId() : int {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }

    public function getDescription() : string{
        return $this->description;
    }

    public function setDescription(string $description) : void {
        $this->description = $description;
    }

    public function getDate() : string {
        return $this->date;
    }

    public function setDate($date) : void {
        $this->date = $date;
    }


    public function getAmount() : int{
        return $this->amount;
    }

    public function setAmount($amount) : void {
        $this->amount = $amount;
    }

    public function getCategoryId() : int{
        return $this->category_id;
    }

    public function setCategoryId($category_id): void {
        $this->category_id = $category_id;
    }

}