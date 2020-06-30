<?php


namespace App\Exceptions;



use App\Http\Domains\BookmarkCategory;
use Exception;

class NotOwnerException extends Exception
{
    /**
     * @var BookmarkCategory
     */
    private $request_bookmark_category;
    /**
     * @var int
     */
    private $office_no;
    /**
     * @var int|null
     */
    private $office_user_no;

    /**
     * NotOwnerException constructor.
     * @param BookmarkCategory $request_bookmark_category
     * @param int $office_no
     * @param int|null $office_user_no
     */
    public function __construct(BookmarkCategory $request_bookmark_category, int $office_no, ?int $office_user_no=null)
    {
        parent::__construct("User is not request BookmarkCategory's owner");
        $this->request_bookmark_category = $request_bookmark_category;
        $this->office_no = $office_no;
        $this->office_user_no = $office_user_no;
    }

    /**
     * @return BookmarkCategory
     */
    public function getRequestBookmarkCategory(): BookmarkCategory
    {
        return $this->request_bookmark_category;
    }

    /**
     * @return int
     */
    public function getOfficeNo(): int
    {
        return $this->office_no;
    }

    /**
     * @return int|null
     */
    public function getOfficeUserNo(): ?int
    {
        return $this->office_user_no;
    }
}
