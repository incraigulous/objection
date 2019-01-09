<?php

namespace Incraigulous\Objection\Tests;

use Incraigulous\Objection\Collection;
use Incraigulous\Objection\DataTransferObject;

class ObjectionTest extends TestCase
{
    public $collection = [
        [
            'test' => 'asdf',
            'test2' => 'teasdfasdfst',
        ],
        [
            'test' => 'asdasdffasdf',
            'test2' => 'teasdasdffasdfst',
        ]
    ];

    public $mixed = [
        [
            'test' => 'asdf',
            'test2' => [
                'test' => 'asdasdffasdf',
                'test2' => 'teasdasdffasdfst',
            ],
        ],
        [
            'test' => 'asdasdffasdf',
            'test2' => 'teasdasdffasdfst',
        ],
        [
            'data' => [],
            'pagination' => [
                'count' => 1
            ]
        ],
        []
    ];


    public function getKeyedCollection() {
        return [
            'data' => $this->collection
        ];
    }

    public function getNested() {
        return [
            [
                'test' => 'asdf',
                'test2' => $this->collection
            ],
            [
                'test' => 'asdf',
                'test2' =>  $this->collection
            ]
        ];
    }

    public function getKeyedNested() {
        return [
            'data' => [
                [
                    'test' => 'asdf',
                    'test2' => [
                        'data' => $this->collection
                    ]
                ],
                [
                    'test' => 'asdf',
                    'test2' =>  [
                        'data' => $this->collection
                    ]
                ]
            ],
        ];
    }

    /**
     * @test
     * @group collections
     */
    public function test_it_collects_collections()
    {
        $collection = objection($this->collection);
        $this->assertEquals($this->collection, $collection->toArray());
    }

    /**
     * @test
     * @group collections
     */
    public function test_it_collects_mixed()
    {
        $collection = objection($this->mixed);
        $this->assertEquals($this->mixed, $collection->toArray());
    }

    /**
     * @test
     * @group collections
     */
    public function test_it_collects_nested()
    {
        $collection = objection($this->getNested());
        $this->assertEquals($this->getNested(), $collection->toArray());
    }

    /**
     * @test
     * @group collections
     */
    public function it_json_encodes()
    {
        $collection = objection($this->getNested());
        $this->assertEquals(json_encode($this->getNested()), $collection->toJson());
    }

    /**
     * @test
     * @group collections
     */
    public function it_handles_data_keys()
    {
        $collection = objection($this->getKeyedCollection(), 'data');
        $this->assertEquals($this->collection, $collection->toArray());
    }

    /**
     * @test
     * @group collections
     */
    public function it_handles_nested_data_keys()
    {
        $collection = objection($this->getKeyedNested(), 'data');
        $this->assertEquals($this->getNested(), $collection->toArray());
    }

    /**
     * @test
     */
    public function it_resolves_to_collections_and_objects()
    {
        $collection = objection($this->mixed, 'data');
        $this->assertInstanceOf(DataTransferObject::class, $collection[0]);
        $this->assertInstanceOf(DataTransferObject::class, $collection[0]['test2']);
        $this->assertInstanceOf(DataTransferObject::class, $collection[1]);
        $this->assertInstanceOf(Collection::class, $collection[2]);
    }

    /**
     * @test
     */
    public function it_can_get_original()
    {
        $collection = objection($this->mixed, 'data');
        $this->assertEquals($this->mixed[2], $collection[2]->getOriginal());
    }
}
