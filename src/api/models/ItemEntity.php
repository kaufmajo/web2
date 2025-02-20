<?php

class ItemEntity
{
    public string $id;
    public ?string $name;
    public ?string $url;
    public ?string $description;
    public ?string $technology;
    public ?bool $docker;
    public ?string $port;

    public function extract(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->url,
            'description' => $this->description,
            'technology' => $this->technology,
            'docker' => $this->docker,
            'port' => $this->port,
        ];
    }

    public function hydrate(array $data): static
    {
        $this->id = $data['id'];
        $this->name = $data['name'] ?? "";
        $this->url = $data['url'] ?? "";
        $this->description = $data['description'] ?? "";
        $this->technology = $data['technology'] ?? "";
        $this->docker = $data['docker'] ?? false;
        $this->port = $data['port'] ?? "";

        return $this;
    }
}
