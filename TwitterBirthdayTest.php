<?php
use PHPUnit_Framework_TestCase as TestCase;

class TwitterBirthdayTest extends TestCase
{
    const CANNOT_FIND_BIRTHDAY_MESSAGE = 'cannot find birthday';

    public function testPile()
    {
        $birthday = new TwitterBirthday('pile_eric');
        $this->assertEquals(5, $birthday['month']);
        $this->assertEquals(2, $birthday['day']);
    }

    public function testRippi()
    {
        $birthday = new TwitterBirthday('rippialoha');
        $this->assertEquals(10, $birthday['month']);
        $this->assertEquals(26, $birthday['day']);
    }

    public function testEmi()
    {
        $birthday = new TwitterBirthday('nittaemi85');
        $this->assertEquals(12, $birthday['month']);
        $this->assertEquals(10, $birthday['day']);
    }

    public function testShikaco()
    {
        try {
            $birthday = new TwitterBirthday('shikaco_staff');
        } catch (Exception $e) {
            $this->assertEquals(self::CANNOT_FIND_BIRTHDAY_MESSAGE, $e->getMessage());
        }
    }

    public function testUtchi()
    {
        $birthday = new TwitterBirthday('aya_uchida');
        $this->assertEquals(7, $birthday['month']);
        $this->assertEquals(23, $birthday['day']);
    }

    public function testSoraMaru()
    {
        try {
            $birthday = new TwitterBirthday('tokui_sorangley');
        } catch (Exception $e) {
            $this->assertEquals(self::CANNOT_FIND_BIRTHDAY_MESSAGE, $e->getMessage());
        }
    }

    public function testKssn()
    {
        $birthday = new TwitterBirthday('kusudaaina');
        $this->assertEquals(2, $birthday['month']);
        $this->assertEquals(1, $birthday['day']);
    }

    public function testNanjolno()
    {
        try {
            $birthday = new TwitterBirthday('nanjolno');
        } catch (Exception $e) {
            $this->assertEquals(self::CANNOT_FIND_BIRTHDAY_MESSAGE, $e->getMessage());
        }
    }

    public function testMimorin()
    {
        try {
            $birthday = new TwitterBirthday('mimori_suzuko');
        } catch (Exception $e) {
            $this->assertEquals(self::CANNOT_FIND_BIRTHDAY_MESSAGE, $e->getMessage());
        }
    }
}
