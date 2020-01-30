<?php
use PHPUnit\Framework\TestCase;
use WL\Controller\ItemController;

class ItemControllerTest extends TestCase
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

    public function testGetItems(): void
    {
        $mockedClass = $this->createMock(ItemController::class);
        $mockedClass->method('getItems')
            ->willReturn(json_encode($this->returnedItemsArray));
        $this->assertEquals(json_encode($this->returnedItemsArray), $mockedClass->getItems());
    }
}