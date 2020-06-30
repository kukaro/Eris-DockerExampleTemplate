<?php


namespace App\Exceptions;



use Exception;

class NotOwnerListException extends Exception
{
    /**
     * @var int[]
     */
    private $request_bookmark_category_no_list;
    /**
     * @var int
     */
    private $office_no;
    /**
     * @var int|null
     */
    private $office_user_no;

    /**
     * NotOwnerListException constructor.
     * @param int[] $request_bookmark_category_no_list
     * @param int $office_no
     * @param int|null $office_user_no
     */
    public function __construct(array $request_bookmark_category_no_list, int $office_no, int $office_user_no=null)
    {
        parent::__construct("User is not request BookmarkCategory's owner");
        $this->request_bookmark_category_no_list = $request_bookmark_category_no_list;
        $this->office_no = $office_no;
        $this->office_user_no = $office_user_no;
    }

    /**
     * @return int[]
     */
    public function getRequestBookmarkCategoryNoList(): array
    {
        return $this->request_bookmark_category_no_list;
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
