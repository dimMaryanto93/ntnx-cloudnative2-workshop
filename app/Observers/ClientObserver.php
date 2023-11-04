<?php

namespace App\Observers;

use App\Handlers\ProducerHandler;
use App\Client;
use Exception;
use Illuminate\Support\Facades\Log;

class ClientObserver
{
    /**
     * Topic name
     */
    const KAFKA_TOPIC = 'nama_client';

    /**
     * Publish error message
     */
    const PUBLISH_ERROR_MESSAGE = 'Publish message to kafka failed';

    /**
     * Kafka producer
     *
     * @var \App\Handlers\Kafka\ProducerHandler
     */
    protected $producerHandler;

    /**
     * InventoryObserver's constructor
     *
     * @param \App\Handlers\Kafka\ProducerHandler $producerHandler
     */
    public function __construct(ProducerHandler $producerHandler)
    {
        $this->producerHandler = $producerHandler;
    }

    /**
     * Handle the inventory "created" event.
     *
     * @param  \App\Client $data
     * @return void
    */
    public function Created(Client $client)
    {
        $this->pushToKafka($client);
        //dd($client);
    }


    /**
     * Handle the inventory "updated" event.
     *
     * @param  \App\Client $data
     * @return void
    */
    public function Saved(Client $client)
    {
        $this->pushToKafka($client);
    }


    /**
     * Handle the inventory "deleted" event.
     *
     * @param  \App\Client $client
     * @return void
    
     */
    public function deleted(Client $client)
    {
        $this->pushToKafka($client);
    }

    /**
     * Push inventory to kafka
     *
     * @param  \App\Client $client
     * @return void
     */
    protected function pushToKafka(Client $client)
    {
        try {
            $this->producerHandler->setTopic(self::KAFKA_TOPIC)
                ->send($client->toJson(), $client->name);
        } catch (Exception $e) {
            Log::critical(self::PUBLISH_ERROR_MESSAGE, [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }
}
