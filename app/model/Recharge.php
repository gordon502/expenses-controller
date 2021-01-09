<?php

class Recharge {

    private int $id;
    private int $user_id;
    private int $amount;
    private string $start_date;
    private string|null $end_date;
    
    public function __construct(int $id, int $user_id, int $amount, string $start_date, string|null $end_date) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->amount = $amount;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    public function getId() : int {
        return $this->id;
    }

    public function getUserId() : int {
        return $this->user_id;
    }

    public function getAmount() : int {
        return $this->amount;
    }

    public function setAmount(int $amount): void {
        $this->amount = $amount;
    }

    public function getStartDate() : string {
        return $this->start_date;
    }


    public function setStartDate(string $start_date): void {
        $this->start_date = $start_date;
    }

    public function getEndDate() : string|null {
        return $this->end_date;
    }

    public function setEndDate(string $end_date): void {
        $this->end_date = $end_date;
    }

}