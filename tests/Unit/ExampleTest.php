<?php

namespace Tests\Unit;

use Modules\Books\Models\Book;
use Modules\Books\Models\Category;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    function setUp(): void
    {
        parent::setUp();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //$books = Book::factory()->hasAttached(Category::inRandomOrder()->limit(2)->get())->create();
        //$books = Book::factory()->count(10)->create();
        //var_dump($books);
    }
}
