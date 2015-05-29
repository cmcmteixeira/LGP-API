<?php

namespace AppBundle\Repository;

use AppBundle\Document\Channel;
use AppBundle\Document\Trackable;
use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * TrackableRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TrackableRepository extends DocumentRepository
{
    /**
     * @param $trackId
     * @param Channel $channel
     * @return Trackable
     */
    public function getTrackableByIdInChannel($trackId, $channel){
        return $this->findOneBy([
            'id' => $trackId ?: '',
            'channel.id' => $channel ? $channel->id : ''
        ]);
    }
}