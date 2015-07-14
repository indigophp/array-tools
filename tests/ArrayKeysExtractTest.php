<?php

class ArrayKeysExtractTest extends \PHPUnit_Framework_TestCase
{
    protected function getExampleArray()
    {
        return array(
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
            'key4' => 'value4',
        );
    }

    public function testItAcceptsASingleKey()
    {
        $array = $this->getExampleArray();

        $expected = array('key1' => 'value1');

        $return = array_keys_extract('key1', $array);

        $this->assertInternalType('array', $return);
        $this->assertEquals($expected, $return);
    }

    public function testItAcceptsMultipleKeys()
    {
        $array = $this->getExampleArray();

        $expected = array(
            'key1' => 'value1',
            'key2' => 'value2',
        );

        $keys = array('key1', 'key2');

        $return = array_keys_extract($keys, $array);

        $this->assertInternalType('array', $return);
        $this->assertEquals($expected, $return);
    }

    public function testItReturnsNullIfKeyNotFound()
    {
        $array = $this->getExampleArray();

        $expected = array(
            'key1' => 'value1',
            'key2' => 'value2',
            'keyX' => null,
        );

        $keys = array('key1', 'key2', 'keyX');

        $return = array_keys_extract($keys, $array, ARRAY_KEYS_EXTRACT_NULL);

        $this->assertInternalType('array', $return);
        $this->assertEquals($expected, $return);
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage Key "keyX" is not found in the array
     */
    public function testItThrowsAnExceptionIfKeyNotFound()
    {
        $array = $this->getExampleArray();

        $keys = array('key1', 'key2', 'keyX');

        array_keys_extract($keys, $array, ARRAY_KEYS_EXTRACT_EXCEPTION);
    }
}
