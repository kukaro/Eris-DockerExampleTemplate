<?php


namespace App\Exceptions;

use Exception;

class PermissionException extends Exception
{
    /**
     * @var int
     */
    private $office_no;
    /**
     * @var int|null
     */
    private $office_user_no;

    /**
     * PermissionException constructor.
     * @param int $office_no
     * @param int|null $office_user_no
     */
    public function __construct(int $office_no, ?int $office_user_no)
    {
        parent::__construct("Permission denined path");
        $this->office_no = $office_no;
        $this->office_user_no = $office_user_no;
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
