<?php


namespace App\Http\Dtos;


use Gabia\LaravelDto\Dto\LaravelDto;
use Illuminate\Contracts\Support\Arrayable;

class DeleteBookmarkCategoryRequest implements Arrayable, LaravelDto
{
    /**
     * @var int
     */
    public  $no;
    /**
     * @var string|null
     */
    public $is_delete_child;

    /**
     * @return int
     */
    public function getNo(): int
    {
        return $this->no;
    }

    /**
     * @param int $no
     */
    public function setNo(int $no): void
    {
        $this->no = $no;
    }

    /**
     * @return string|null
     */
    public function getIsDeleteChild(): ?string
    {
        return strtoupper($this->is_delete_child)=="Y" ? true : false;
    }

    /**
     * @param string|null $is_delete_child
     */
    public function setIsDeleteChild(?string $is_delete_child): void
    {
        $this->is_delete_child = $is_delete_child;
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
