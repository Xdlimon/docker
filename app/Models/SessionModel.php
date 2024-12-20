<?php
namespace App\Models;

use Redis;

class SessionModel
{
    private $redis;

    public function __construct($config)
    {
        $this->redis = new Redis();
        $this->redis->connect($config['host'], $config['port'], $config['timeout']);
    }

    public function set($key, $value)
    {
        ini_set('session.cookie_lifetime', 120);
        $this->redis->set($key, json_encode($value));
    }

    public function get($key)
    {
        $value = $this->redis->get($key);
        return $value ? json_decode($value, true) : null;
    }
}
