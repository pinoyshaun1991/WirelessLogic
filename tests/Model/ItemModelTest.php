<?php

use PHPUnit\Framework\TestCase;
use WL\Model\ItemModel;

class ItemModelTest extends TestCase
{

    private $returnedItemsArray = array(
        array(
            'optionTitle' => 'Option 3600 Mins',
            'description' => 'Up to 3600 minutes talk time per year including 480 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '174',
            'discount'    => 'Save £18 on the monthly price'
        ),
        array
        (
            'optionTitle' => 'Option 2000 Mins',
            'description' => 'Up to 2000 minutes talk time per year including 420 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '108',
            'discount'    => 'Save £12 on the monthly price'
        ),
        array
        (
            'optionTitle' => 'Option 480 Mins',
            'description' => 'Up to 480 minutes talk time per yearincluding 240 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '66',
            'discount'    => 'Save £5 on the monthly price'
        ),
        array
        (
            'optionTitle' => 'Option 300 Mins',
            'description' => '300 minutes talk time per monthincluding 40 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '16',
            'discount'    => ''
        ),
        array
        (
            'optionTitle' => 'Option 160 Mins',
            'description' => 'Up to 160 minutes talk time per monthincluding 35 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '10',
            'discount'    => ''
        ),
        array
        (
            'optionTitle' => 'Option 40 Mins',
            'description' => 'Up to 40 minutes talk time per monthincluding 20 SMS(5p / minute and 4p / SMS thereafter)',
            'price'       => '6',
            'discount'    => ''
        )
    );

    /**
     * @dataProvider optionTitleProvider
     *
     * @param $parameter
     * @param $expectedMessage
     * @throws ReflectionException
     */
    public function testSetOptionTitle($parameter, $expectedMessage): void
    {
        $reflector = new \ReflectionClass(ItemModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setOptionTitle');
        $method->setAccessible(true);
        $this->expectExceptionMessage($expectedMessage);
        $method->invoke($instance, $parameter);
    }

    public function optionTitleProvider()
    {
        return [
            [null, 'Option title is required']
        ];
    }

    /**
     * @dataProvider optionTitleWithoutExceptionProvider
     *
     * @param $parameter
     * @param $expected
     * @throws Exception
     */
    public function testSetOptionTitleWithoutException($parameter, $expected): void
    {
        $reflector = new \ReflectionClass(ItemModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setOptionTitle');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invoke($instance, $parameter));
    }

    public function optionTitleWithoutExceptionProvider()
    {
        return [
            ['test', 'test'],
            ['Title', 'Title'],
            [10, 10],
            [100, 100]
        ];
    }

    public function testGetOptionTitle(): void
    {
        $mockedClass = $this->createMock(ItemModel::class);
        $mockedClass->method('getOptionTitle')
            ->willReturn('Test');
        $this->assertEquals('Test', $mockedClass->getOptionTitle());
    }

    /**
     * @dataProvider descriptionProvider
     *
     * @param $parameter
     * @param $expectedMessage
     * @throws ReflectionException
     */
    public function testSetDescription($parameter, $expectedMessage): void
    {
        $reflector = new \ReflectionClass(ItemModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setDescription');
        $method->setAccessible(true);
        $this->expectExceptionMessage($expectedMessage);
        $method->invoke($instance, $parameter);
    }

    public function descriptionProvider()
    {
        return [
            [null, 'Description is required']
        ];
    }

    /**
     * @dataProvider descriptionWithoutExceptionProvider
     *
     * @param $parameter
     * @param $expected
     * @throws Exception
     */
    public function testSetDescriptionWithoutException($parameter, $expected): void
    {
        $reflector = new \ReflectionClass(ItemModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setDescription');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invoke($instance, $parameter));
    }

    public function descriptionWithoutExceptionProvider()
    {
        return [
            ['test', 'test'],
            ['Title', 'Title'],
            [10, 10],
            [100, 100]
        ];
    }

    public function testGetDescription(): void
    {
        $mockedClass = $this->createMock(ItemModel::class);
        $mockedClass->method('getDescription')
            ->willReturn('Test');
        $this->assertEquals('Test', $mockedClass->getDescription());
    }

    /**
     * @dataProvider priceProvider
     *
     * @param $parameter
     * @param $expectedMessage
     * @throws ReflectionException
     */
    public function testSetPrice($parameter, $expectedMessage): void
    {
        $reflector = new \ReflectionClass(ItemModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setPrice');
        $method->setAccessible(true);
        $this->expectExceptionMessage($expectedMessage);
        $method->invoke($instance, $parameter);
    }

    public function priceProvider()
    {
        return [
            [null, 'Price is required and needs to be a positive number'],
            ['abcdefg', 'Price is required and needs to be a positive number'],
            [-7, 'Price is required and needs to be a positive number'],
            ['-12', 'Price is required and needs to be a positive number']
        ];
    }

    public function testGetPrice(): void
    {
        $mockedClass = $this->createMock(ItemModel::class);
        $mockedClass->method('getPrice')
            ->willReturn(1000);
        $this->assertEquals(1000, $mockedClass->getPrice());
    }

    /**
     * @dataProvider discountProvider
     *
     * @param $parameter
     * @param $expectedMessage
     * @throws ReflectionException
     */
    public function testSetDiscount($parameter, $expectedMessage): void
    {
        $reflector = new \ReflectionClass(ItemModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setDiscount');
        $method->setAccessible(true);
        $this->expectExceptionMessage($expectedMessage);
        $method->invoke($instance, $parameter);
    }

    public function discountProvider()
    {
        return [
            [null, 'Discount is required']
        ];
    }

    /**
     * @dataProvider discountWithoutExceptionProvider
     *
     * @param $parameter
     * @param $expected
     * @throws Exception
     */
    public function testSetDiscountWithoutException($parameter, $expected): void
    {
        $reflector = new \ReflectionClass(ItemModel::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('setDiscount');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invoke($instance, $parameter));
    }

    public function discountWithoutExceptionProvider()
    {
        return [
            ['test', 'test'],
            ['Title', 'Title'],
            [10, 10],
            [100, 100]
        ];
    }

    public function testGetDiscount(): void
    {
        $mockedClass = $this->createMock(ItemModel::class);
        $mockedClass->method('getDiscount')
            ->willReturn('Test');
        $this->assertEquals('Test', $mockedClass->getDiscount());
    }

    public function testFetchItems(): void
    {
        $mockedClass = $this->createMock(ItemModel::class);
        $mockedClass->method('fetchItems')
            ->willReturn(json_encode($this->returnedItemsArray));
        $this->assertEquals(json_encode($this->returnedItemsArray), $mockedClass->fetchItems('https://videx.comesconnected.com/'));
    }
}