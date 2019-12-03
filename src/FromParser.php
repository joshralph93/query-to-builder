<?php

namespace JoshRalph\QueryToBuilder;

use Illuminate\Database\Query\Builder;

class FromParser
{
    /**
     * @var Builder
     */
    private $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function parse(array $tokens)
    {
        $this->builder->from($tokens[0]['no_quotes']['parts'][0]);
    }
}
