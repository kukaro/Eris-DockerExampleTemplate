<?php


namespace App\Http\Domains;


use Gabia\LaravelDto\Dto\LaravelDto;
use Illuminate\Contracts\Support\Arrayable;

class BookmarkCategory implements Arrayable, LaravelDto
{
    /**
     * @var int
     */
    public $no;
    /**
     * @var int|null
     */
    public $parent_category_no;
    /**
     * @var BookmarkCategory[]|null
     */
    public $bookmark_categories;
    /**
     * @var Bookmark|null
     */
    public $bookmark;
    /**
     * @var int|null
     */
    public $order_no;
    /**
     * @var string|null
     */
    public $name;
    /**
     * @var \DateTime|null
     */
    public $use_start_date;
    /**
     * @var \DateTime|null
     */
    public $use_end_date;
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
     * @return int|null
     */
    public function getParentCategoryNo(): ?int
    {
        return $this->parent_category_no;
    }

    /**
     * @param int|null $parent_category_no
     */
    public function setParentCategoryNo(?int $parent_category_no): void
    {
        $this->parent_category_no = $parent_category_no;
    }

    /**
     * @return BookmarkCategory[]|null
     */
    public function getBookmarkCategories(): ?array
    {
        return $this->bookmark_categories;
    }

    /**
     * @param BookmarkCategory[]|null $bookmark_categories
     */
    public function setBookmarkCategories(?array $bookmark_categories): void
    {
        $this->bookmark_categories = $bookmark_categories;
    }

    /**
     * @return Bookmark|null
     */
    public function getBookmark(): ?Bookmark
    {
        return $this->bookmark;
    }

    /**
     * @param Bookmark|null $bookmark
     */
    public function setBookmark(?Bookmark $bookmark): void
    {
        $this->bookmark = $bookmark;
    }

    /**
     * @return int|null
     */
    public function getOrderNo(): ?int
    {
        return $this->order_no;
    }

    /**
     * @param int|null $order_no
     */
    public function setOrderNo(?int $order_no): void
    {
        $this->order_no = $order_no;
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
     * @return \DateTime|null
     */
    public function getUseStartDate(): ?\DateTime
    {
        return $this->use_start_date;
    }

    /**
     * @param \DateTime|null $use_start_date
     */
    public function setUseStartDate(?\DateTime $use_start_date): void
    {
        $this->use_start_date = $use_start_date;
    }

    /**
     * @return \DateTime|null
     */
    public function getUseEndDate(): ?\DateTime
    {
        return $this->use_end_date;
    }

    /**
     * @param \DateTime|null $use_end_date
     */
    public function setUseEndDate(?\DateTime $use_end_date): void
    {
        $this->use_end_date = $use_end_date;
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
