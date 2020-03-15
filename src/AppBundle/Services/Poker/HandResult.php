<?php

namespace AppBundle\Services\Poker;

class HandResult
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $value;

    /**
     * @var int
     */
    private $subValue = 0;

    /**
     * @var int
     */
    private $kickersValue = 0;

    /**
     * Hand constructor.
     * @param string|null $type
     * @param string|null $value
     */
    public function __construct($type = null, $value = null)
    {
        if ($type) {
            $this->type = $type;
        }
        if ($value) {
            $this->value = $value;
        }
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return HandResult
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return HandResult
     */
    public function setValue(int $value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int
     */
    public function getSubValue(): int
    {
        return $this->subValue;
    }

    /**
     * @param int $subValue
     * @return HandResult
     */
    public function setSubValue(int $subValue)
    {
        $this->subValue = $subValue;

        return $this;
    }

    /**
     * @return int
     */
    public function getKickersValue(): int
    {
        return $this->kickersValue;
    }

    /**
     * @param int $kickersValue
     * @return HandResult
     */
    public function setKickersValue(int $kickersValue)
    {
        $this->kickersValue = $kickersValue;

        return $this;
    }
}
