<?php

namespace JoshRalph\QueryToBuilder;

use Illuminate\Database\Query\Builder;

class SelectParser
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
        array_map(function ($token) {
            if ($token['alias'] !== false) {
                if ($token['alias']['as'] === true) {
                    $this->builder->addSelect($token['base_expr'] . ' as ' . $token['alias']['name']);
                    return;
                }
            }
            $this->builder->addSelect($token['base_expr']);
        }, $tokens);
    }
}
