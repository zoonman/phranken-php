<?php
namespace MarketMeSuite\Phranken\Database\Object;

use MarketMeSuite\Phranken\Database\Exception\DbObjectException;

class TestDbObject extends DbObject
{

    protected $id = null;
    protected $network = null;
    protected $firstName = null;
    protected $lastName = null;

    public function getMap()
    {
        return array(
            '_id' => 'id',
            'network' => 'network',
            'first_name' => 'firstName',
            'last_name' => 'lastName'
        );
    }
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-08-19 at 16:28:23.
 */
class DbObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DbObject
     */
    protected $object;

    protected $validDbArray = array(
        '_id'        => 'foobarid',
        'network'    => 'twitter',
        'first_name' => 'bill',
        'last_name'  => 'nunney'
    );

    protected $validDbArrayMissingKeys = array(
        '_id'     => 'foobarid',
        'network' => 'twitter'
    );

    protected $validDbArrayNullValues = array(
        '_id'        => 'foobarid',
        'network'    => 'twitter',
        'first_name' => null,
        'last_name'  => null
    );

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TestDbObject;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::fromArray
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::getProp
     */
    public function testFromArray()
    {
        $this->object->fromArray($this->validDbArray);

        $this->assertSame(
            'foobarid',
            $this->object->getProp('id')
        );
    }

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::toArray
     */
    public function testToArray()
    {
        $this->object->fromArray($this->validDbArray);
        $expected = $this->object->toArray($this->validDbArray);
        $actual = $this->validDbArray;

        $this->assertSame(
            $expected,
            $actual,
            'The object should be able to convert from and array to and object and back again with no issues'
        );
    }

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::toArray
     */
    public function testToArray2()
    {
        $this->object->setToArrayAllowNull(true);
        $this->object->fromArray($this->validDbArrayNullValues);
        $expected = $this->object->toArray($this->validDbArrayNullValues);
        $actual = $this->validDbArrayNullValues;

        $this->assertSame(
            $expected,
            $actual,
            'The object should be able to convert from and array to and object and back again with no issues'
        );
    }

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::setProp
     * @todo   Implement testSetProp().
     */
    public function testSetProp()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::getProp
     * @todo   Implement testGetProp().
     */
    public function testGetProp()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::MultiFromArray
     * @todo   Implement testMultiFromArray().
     */
    public function testMultiFromArray()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::getMap
     * @todo   Implement testGetMap().
     */
    public function testGetMap()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::assertArrayHasAllMapKeys
     *
     * @expectedException \MarketMeSuite\Phranken\Database\Exception\DbObjectException
     */
    public function testAssertArrayHasAllMapKeys()
    {
        $this->object->setStrictMap(true);
        $this->object->assertArrayHasAllMapKeys($this->validDbArrayMissingKeys);
    }

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::assertArrayHasAllMapKeys
     */
    public function testAssertArrayHasAllMapKeys2()
    {
        $this->object->setStrictMap(true);
        $this->object->assertArrayHasAllMapKeys($this->validDbArrayNullValues);
    }

    //--------------------------------------
    // TOQUERY
    //--------------------------------------

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::toQuery
     */
    public function testToQuery()
    {
        $actual = $this->object->toQuery('insert');
        $this->assertArrayHasKey('_id', $actual);

        $this->assertNotNull($this->object->getProp(DbObject::$ID_PROP));

        $actual = $this->object->toQuery('set');
        $this->assertArrayNotHasKey('_id', $actual);
    }

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::toQuery
     *
     * @expectedException \MarketMeSuite\Phranken\Database\Exception\DbObjectException
     */
    public function testToQueryInvalidAction()
    {
        $this->object->toQuery('invalid');
    }

    //--------------------------------------
    // MULTI TO ARRAY
    //--------------------------------------

    /**
     * @covers MarketMeSuite\Phranken\Database\Object\DbObject::multiToArray
     */
    public function testMultiToArray()
    {
        // mock objects

        $mockMap = array(
            '_id' => 'id',
            'key1' => 'key1',
            'key2' => 'key2',
        );

        /** @var DbObject $obj1 */
        $obj1 = $this->getMockForAbstractClass('MarketMeSuite\\Phranken\\Database\\Object\\DbObject');
        $obj1->map = $mockMap;

        /** @var DbObject $obj2 */
        $obj2 = $this->getMockForAbstractClass('MarketMeSuite\\Phranken\\Database\\Object\\DbObject');
        $obj2->map = $mockMap;

        $obj1->id = $obj2->id = 'test_id';
        $obj1->key1 = $obj2->key1 = 'val1';
        $obj1->key2 = $obj2->key2 = 'val2';

        $actual = DbObject::multiToArray(array($obj1, $obj2));
        $this->assertEquals(
            array(
                array(
                    '_id' => 'test_id',
                    'key1' => 'val1',
                    'key2' => 'val2',
                ),
                array(
                    '_id' => 'test_id',
                    'key1' => 'val1',
                    'key2' => 'val2',
                )
            ),
            $actual
        );

        $actual = DbObject::multiToArray(array($obj1, $obj2), array('_id', 'key1'));
        $this->assertEquals(
            array(
                array(
                    '_id' => 'test_id',
                    'key1' => 'val1',
                ),
                array(
                    '_id' => 'test_id',
                    'key1' => 'val1',
                )
            ),
            $actual,
            'only allowed fields should be returned'
        );
    }
}
