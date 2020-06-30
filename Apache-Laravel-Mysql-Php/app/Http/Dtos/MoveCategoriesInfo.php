<?php


namespace App\Http\Dtos;


use Gabia\LaravelDto\Dto\LaravelDto;
use Illuminate\Contracts\Support\Arrayable;

class MoveCategoriesInfo implements LaravelDto, Arrayable
{
    /**
     * @var int|null
     */
    public $no;
    /**
     * @var int[]|null
     */
    public $order;

    /**
     * @return int|null
     */
    public function getNo(): ?int
    {
        return $this->no;
    }

    /**
     * @param int|null $no
     */
    public function setNo(?int $no): void
    {
        $this->no = $no;
    }

    /**
     * @return int[]|null
     */
    public function getOrder(): ?array
    {
        return $this->order;
    }

    /**
     * @param int[]|null $order
     */
    public function setOrder(?array $order): void
    {
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function toArray() {
        $vars = get_object_vars ( $this );
        $array = [];
        foreach ( $vars as $key => $value ) {
            $array [ltrim ( $key, '_' )] = $value;
        }
        return $array;
    }

}
