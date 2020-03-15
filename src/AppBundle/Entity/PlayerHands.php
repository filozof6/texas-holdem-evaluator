<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * PlayerHands
 *
 * @ORM\Table(name="player_hands")
 * @ORM\Table(indexes={@Index(name="player_idx", columns={"player_id"}),@Index(name="round_idx", columns={"round_id"})}))
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerHandsRepository")
 */
class PlayerHands
{
    /**
     * @var string
     *
     * @ORM\Column(name="hand", type="string", length=255, nullable=false)
     */
    private $hand;

    /**
     * @var integer
     *
     * @ORM\Column(name="player_id", type="bigint", nullable=false)
     */
    private $playerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="round_id", type="bigint", nullable=false)
     */
    private $roundId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHand()
    {
        return $this->hand;
    }

    /**
     * @return int
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * @return int
     */
    public function getRoundId()
    {
        return $this->roundId;
    }

    /**
     * @param string $hand
     * @return PlayerHands
     */
    public function setHand(string $hand)
    {
        $this->hand = $hand;

        return $this;
    }

    /**
     * @param int $playerId
     * @return PlayerHands
     */
    public function setPlayerId(int $playerId)
    {
        $this->playerId = $playerId;

        return $this;
    }

    /**
     * @param int $roundId
     * @return PlayerHands
     */
    public function setRoundId(int $roundId)
    {
        $this->roundId = $roundId;

        return $this;
    }
}

