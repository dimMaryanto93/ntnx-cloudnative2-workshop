<?php

namespace App\Console;

use App\Client;
use Exception;
use RdKafka\Conf;
use RdKafka\KafkaConsumer;
use RdKafka\Message;
use Illuminate\Console\Command;

class ConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kafka consumer';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $consumer = new KafkaConsumer($this->getConfig());

        // Subscribe to topic 'nama_client'
        // Microservice 1 will push to 'nama_client' topic
        $consumer->subscribe(['nama_client']);

        while (true) {
            $message = $consumer->consume(120*1000);
            switch ($message->err) {
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    $this->processMessage($message);
                    // Commit offsets asynchronously
                    $consumer->commitAsync($message);
                    break;
                case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                    echo "No more messages; will wait for more\n";
                    break;
                case RD_KAFKA_RESP_ERR__TIMED_OUT:
                    echo "Timed out\n";
                    break;
                default:
                    throw new Exception($message->errstr(), $message->err);
                    break;
            }
        }
    }

    /**
     * Process Kafka message
     *
     * @param \RdKafka\Message $kafkaMessage
     * @return void
     */
    protected function processMessage(Message $kafkaMessage)
    {
        $message = $this->decodeKafkaMessage($kafkaMessage);

        $this->info(json_encode($message));

        // Lets update the stats
        Client::updateOrCreate(
            ['name' => $message->body->name],
            ['title' => $message->body->title, 'last_name' => $message->body->last_name, 'address' => $message->body->address, 'zip_code' => $message->body->zip_code, 'city' => $message->body->city, 'state' => $message->body->state, 'email' => $message->body->email]
        );
    }

    /**
     * Decode kafka message
     *
     * @param \RdKafka\Message $kafkaMessage
     * @return object
     */
    protected function decodeKafkaMessage(Message $kafkaMessage)
    {
        $message = json_decode($kafkaMessage->payload);

        if (is_string($message->body)) {
            $message->body = json_decode($message->body);
        }

        return $message;
    }

    /**
     * Get kafka config
     *
     * @return \RdKafka\Conf
     */
    protected function getConfig()
    {
        $conf = new Conf();

        // Configure the group.id. All consumer with the same group.id will consume
        // different partitions.
        $conf->set('group.id', 'SubscriptionGroup');

        // Initial list of Kafka brokers
        $conf->set('metadata.broker.list', env('KAFKA_BROKERS'));

        // Set where to start consuming messages when there is no initial offset in
        // offset store or the desired offset is out of range.
        // 'smallest': start from the beginning
        $conf->set('auto.offset.reset', 'smallest');

        // Automatically and periodically commit offsets in the background
        $conf->set('enable.auto.commit', 'false');

        return $conf;
    }
}
