<?php

namespace common\components\queue;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class BasicRabbitMQProducer {
    public $host = 'localhost';
    public $port = 5672;
    public $user = 'justice';
    public $password = 'justice';
    public $queueName = 'justice';
    public $exchangeName = 'justice';
    public $exchangeType = 'topic';


    /**
     * @var AMQPStreamConnection
     */
    protected $connection;


    /**
     * @var AMQPChannel
     */
    protected $channel;


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   array $payload
     * @desc
     */
    public function send(array $payload) {
        $this->open();
        $this->channel->basic_publish(new AMQPMessage(json_encode($payload), [
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
            'content_encoding' => 'UTF-8',
            'content_type' => 'application/json',
        ]), $this->exchangeName);
    }

    private function open() {
        if ($this->channel) return;
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password);
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($this->queueName, false, true, false, false);
        $this->channel->exchange_declare($this->exchangeName, $this->exchangeType, false, true, false);
        $this->channel->queue_bind($this->queueName, $this->exchangeName);
    }
}