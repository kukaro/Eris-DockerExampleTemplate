<?php


namespace App\Http\Domains;


use Gabia\LaravelDto\Dto\LaravelDto;
use Illuminate\Contracts\Support\Arrayable;

class Bookmark implements Arrayable,LaravelDto
{
    /**
     * @var int
     */
    public $no;
    /**
     * @var string|null
     */
    public $url;
    /**
     * @var int
     */
    public $bookmark_categories_no;
    /**
     * @var string|null
     */
    public $name;
    /**
     * @var string
     */
    public $is_visuable;
    /**
     * @var string|null
     */
    public $description;
    /**
     * @var \DateTime
     */
    public $created_at;
    /**
     * @var \DateTime
     */
    public $updated_at;

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
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getBookmarkCategoriesNo(): int
    {
        return $this->bookmark_categories_no;
    }

    /**
     * @param int $bookmark_categories_no
     */
    public function setBookmarkCategoriesNo(int $bookmark_categories_no): void
    {
        $this->bookmark_categories_no = $bookmark_categories_no;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getIsVisuable(): string
    {
        return $this->is_visuable;
    }

    /**
     * @param string $is_visuable
     */
    public function setIsVisuable(string $is_visuable): void
    {
        $this->is_visuable = $is_visuable;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     */
    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     */
    public function setUpdatedAt(\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return bool
     */
    public function isUpdateCondition()
    {
        return !is_null($this->name) || !is_null($this->url);
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
