<?php

namespace Tests\Unit;

use App\Inspections\Span;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SpanTest extends TestCase
{
    use DatabaseTransactions;
    /** @test */
    public function it_validates_span()
    {
        $span = new Span();
        $this->assertFalse($span->detect('nnn'));
    }
    /** @test */
    public function it_validates_duplication_keywords()
    {
        $span = new Span();
        // $span->detect('aaa');
        $this->assertFalse($span->detect('aaaaaaa'));
    }
}
