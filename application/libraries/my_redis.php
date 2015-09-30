<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require 'Predis/Autoloader.php';
Predis\Autoloader::register();

class My_redis
{
	private $kv = null;

	function __construct()
	{
		if (!$this->kv) {
			$server = config_item('redis_server');
			try {
				$this->kv = new Predis\Client($server, array(
					'prefix' => $server['key_prefix']
				));
				$this->kv->connect();
			} catch (Exception $e) {
				my_error_log($e->getMessage());
			}
		}
	}

	function get($key)
	{
		try {
			return $this->kv->get($key);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function set($key, $value)
	{
		try {
			return $this->kv->set($key, $value);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function del($key)
	{
		try {
			return $this->kv->del($key);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function incr($key)
	{
		try {
			return $this->kv->incr($key);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function incrby($key, $increment)
	{
		try {
			return $this->kv->incrby($key, $increment);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function expire($key, $seconds)
	{
		try {
			return $this->kv->expire($key, $seconds);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function exists($key)
	{
		try {
			return $this->kv->exists($key);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function hget($key, $field)
	{
		try {
			return $this->kv->hget($key, $field);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function hset($key, $field, $value)
	{
		try {
			return $this->kv->hset($key, $field, $value);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function hdel($key, $field)
	{
		try {
			return $this->kv->hdel($key, $field);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function hgetall($key)
	{
		try {
			return $this->kv->hgetall($key);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function hkeys($key)
	{
		try {
			return $this->kv->hkeys($key);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function mget($keys)
	{
		try {
			return $this->kv->mget($keys);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function hexists($key, $field)
	{
		try {
			return $this->kv->hexists($key, $field);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function setex($key, $value, $expire)
	{
		try {
			return $this->kv->setex($key, $value, $expire);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function zrevrangebyscore($key, $max, $min, $offset, $count, $withscores = false)
	{
		$condition = [
			'limit' => [$offset, $count],
			'withscores' => $withscores
		];
		try {
			return $this->kv->zrevrangebyscore($key, $max, $min, $condition);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function zrevrange($key, $start, $stop, $withscores = false)
	{
		try {
			if ($withscores) {
				return $this->kv->zrevrange($key, $start, $stop, 'withscores');
			} else {
				return $this->kv->zrevrange($key, $start, $stop);
			}
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function zrangebyscore($key, $min, $max)
	{
		try {
			return $this->kv->zrangebyscore($key, $min, $max);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function zrange($key, $min, $max)
	{
		try {
			return $this->kv->zrange($key, $min, $max);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function zrem($key, $member)
	{
		try {
			return $this->kv->zrem($key, $member);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function zadd($key, $score, $member)
	{
		try {
			return $this->kv->zadd($key, $score, $member);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function zscore($key, $member)
	{
		try {
			return $this->kv->zscore($key, $member);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function zremrangebyscore($key, $min, $max)
	{
		try {
			return $this->kv->zremrangebyscore($key, $min, $max);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function zremrangebyrank($key, $start, $stop)
	{
		try {
			return $this->kv->zremrangebyrank($key, $start, $stop);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function hincrby($key, $field, $inc)
	{
		try {
			return $this->kv->hincrby($key, $field, $inc);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function zincrby($key, $increment, $member)
	{
		try {
			return $this->kv->zincrby($key, $increment, $member);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function hlen($key)
	{
		try {
			return $this->kv->hlen($key);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function hvals($key)
	{
		try {
			return $this->kv->hvals($key);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}

	function publish($chanel, $message)
	{
		try {
			return $this->kv->publish($chanel, $message);
		} catch (Exception $e) {
			my_error_log($e->getMessage());
			return false;
		}
	}
}