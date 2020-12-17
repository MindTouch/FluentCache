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
namespace modethirteen\FluentCache\Tests;

use modethirteen\FluentCache\Event;
use PHPUnit\Framework\TestCase;

class Event_Test extends TestCase {

    /**
     * @test
     */
    public function Can_construct_an_event() : void {

        // act
        $event = new Event('foo', ['bar' => 'baz']);

        // assert
        static::assertEquals('foo', $event->getState());
        static::assertEquals(['bar' => 'baz'], $event->getData());
    }
}
