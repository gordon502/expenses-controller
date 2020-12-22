<?php

class Recharge {

    private $id;
    private $user_id;
    private $amount;
    private $start_date;
    private $end_date;

    /**
     * Recharge constructor.
     * @param $id
     * @param $user_id
     * @param $amount
     * @param $start_date
     * @param $end_date
     */
    public function __construct($id, $user_id, $amount, $start_date, $end_date) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->amount = $amount;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */

    /**
     * @return mixed
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getStartDate() {
        return $this->start_date;
    }

    /**
     * @param mixed $start_date
     */
    public function setStartDate($start_date): void {
        $this->start_date = $start_date;
    }

    /**
     * @return mixed
     */
    public function getEndDate() {
        return $this->end_date;
    }

    /**
     * @param mixed $end_date
     */
    public function setEndDate($end_date): void {
        $this->end_date = $end_date;
    }

}