<?php

class Category {
    private int $id;
    private string $name;
    private int $user_id;
    
    public function __construct(int $id, string $name, int $user_id) {
        $this->id = $id;
        $this->name = $name;
        $this->user_id = $user_id;
    }
    
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }
    
    public function setName(int $name): void {
        $this->name = $name;
    }
    
    public function getUserId(): int {
        return $this->user_id;
    }

}