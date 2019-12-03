<?php

namespace JoshRalph\QueryToBuilder\Tests;

use Closure;
use Illuminate\Database\Connection;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Grammar;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Processors\Processor;
use JoshRalph\QueryToBuilder\QueryParser;
use JoshRalph\QueryToBuilder\Tokenizer;
use PHPSQLParser\PHPSQLParser;
use PHPUnit\Framework\TestCase;

class FirstTest extends TestCase
{
    protected $parser;

    protected function setUp(): void
    {
        /** @var Builder $builder */
        $builder = \Mockery::mock(Builder::class)->makePartial();
        $this->parser = new QueryParser($builder);
    }
    /** @test */
    public function basicSelect()
    {


        $builder = $this->parser->parse('SELECT * FROM `users`');

        $this->assertSame(['*'], $builder->columns);
        $this->assertSame('users', $builder->from);
    }

    /** @test */
    public function basicSelectWithColumns()
    {
        $builder = $this->parser->parse('SELECT id, name FROM `users`');

        $this->assertSame(['id', 'name'], $builder->columns);
        $this->assertSame('users', $builder->from);
    }

    /** @test */
    public function basicSelectWithAlias()
    {
        $builder = $this->parser->parse('SELECT id, name as aliased_name FROM `users`');

        $this->assertSame(['id', 'name as aliased_name'], $builder->columns);
        $this->assertSame('users', $builder->from);
    }
}


