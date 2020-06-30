<?php


namespace App\Http\Dtos;


use Gabia\LaravelDto\Dto\LaravelDto;
use Illuminate\Contracts\Support\Arrayable;

class MoveCategoriesRequest implements LaravelDto, Arrayable
{
    /**
     * @var MoveCategoriesInfo
     */
    public $from;
    /**
     * @var MoveCategoriesInfo
     */
    public $to;

    /**
     * @return MoveCategoriesInfo
     */
    public function getFrom(): MoveCategoriesInfo
    {
        return $this->from;
    }

    /**
     * @param MoveCategoriesInfo $from
     */
    public function setFrom(MoveCategoriesInfo $from): void
    {
        $this->from = $from;
    }

    /**
     * @return MoveCategoriesInfo
     */
    public function getTo(): MoveCategoriesInfo
    {
        return $this->to;
    }

    /**
     * @param MoveCategoriesInfo $to
     */
    public function setTo(MoveCategoriesInfo $to): void
    {
        $this->to = $to;
    }

    /**
     * @return bool
     */
    public function isFromUpdateTarget()
    {
        if(is_null($this->getFrom()->getOrder()))
        {
            return false;
        }
        if($this->from->getNo() == $this->to->getNo())
        {
            return false;
        }
        return true;
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
