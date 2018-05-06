<?php
/**
 * Created by PhpStorm.
 * User: kab
 * Date: 06.05.18
 * Time: 10:56
 */

namespace App\Service;


use Kafka\ConsumerInterface;

class UserCreatedListenerService implements ConsumerInterface
{
    /**
     * @param string $topic     Topic name
     * @param int    $partition Partition
     * @param int    $offset    Message offset
     * @param string $key       Optional message key
     * @param string $payload   Message payload
     *
     * @return mixed
     */
    public function consume($topic, $partition, $offset, $key, $payload)
    {
        echo "Received message with payload " . $payload;
    }
}