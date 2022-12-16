<?php declare(strict_types=1);
/**
 * FluentCache
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace modethirteen\FluentCache;

use Exception;
use Psr\EventDispatcher\StoppableEventInterface;
use Psr\SimpleCache\CacheException;
use Psr\SimpleCache\CacheInterface;

class Event extends \Symfony\Contracts\EventDispatcher\Event implements StoppableEventInterface {
    public const CACHE_GET_START = 'cache:get.start';
    public const CACHE_GET_ERROR = 'cache:get.error';
    public const CACHE_GET_HIT = 'cache:get.hit';
    public const CACHE_GET_MISS = 'cache:get.miss';
    public const BUILD_START = 'build:start';
    public const BUILD_ERROR = 'build:error';
    public const BUILD_SUCCESS = 'build:success';
    public const BUILD_FAIL = 'build:fail';
    public const CACHE_SET_START = 'cache:set.start';
    public const CACHE_SET_ERROR = 'cache:set.error';
    public const CACHE_SET_SUCCESS = 'cache:set.success';
    public const CACHE_SET_FAIL = 'cache:set.fail';

    /**
     * @var string|null
     */
    private ?string $cacheKey = null;

    /**
     * @var string|null
     */
    private ?string $cacheType = null;

    /**
     * @var Exception|null
     */
    private ?Exception $buildException = null;

    /**
     * @var CacheException|null
     */
    private ?CacheException $cacheException = null;

    public function __construct(private string $message, private string $sessionId)
    {
    }

    public function getBuildException() : ?Exception {
        return $this->buildException;
    }

    public function getCacheKey() : ?string {
        return $this->cacheKey;
    }

    public function getCacheType() : ?string {
        return $this->cacheType;
    }

    public function getCacheException() : ?CacheException {
        return $this->cacheException;
    }

    public function getMessage() : string {
        return $this->message;
    }

    public function getSessionId() : string {
        return $this->sessionId;
    }

    /**
     * @return static
     */
    public function withBuildException(Exception $e) : object {
        $event = clone $this;
        $event->buildException = $e;
        return $event;
    }

    /**
     * @return static
     */
    public function withCache(CacheInterface $cache, ?string $key = null) : object {
        $event = clone $this;
        $event->cacheType = $cache::class;
        $event->cacheKey = $key;
        return $event;
    }

    /**
     * @return static
     */
    public function withCacheException(CacheException $e) : object {
        $event = clone $this;
        $event->cacheException = $e;
        return $event;
    }
}
