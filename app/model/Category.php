<?php

class Category {
    private int $id;
    private int $name;
    private int $user_id;

    public function __construct(int $id, int $name, int $user_id) {
        $this->id = $id;
        $this->name = $name;
        $this->user_id = $user_id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): int {
        return $this->name;
    }

    public function setName(int $name): void {
        $this->name = $name;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }
    
}