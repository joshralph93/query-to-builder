<?php

namespace JoshRalph\QueryToBuilder;

use Illuminate\Database\Query\Builder;
use PHPSQLParser\PHPSQLParser;

class QueryParser
{
    /**
     * @var Builder
     */
    private $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function parse(string $query)
    {
        $parser = new PHPSQLParser($query);

        foreach ($parser->parsed as $key => $value) {
            $parser = $this->resolveParser($key);

            $parser->parse($value);
        }

        return $this->builder;
    }

    private function resolveParser($key)
    {
        switch ($key) {
            case 'SELECT':
                return new SelectParser($this->builder);
            case 'FROM':
                return new FromParser($this->builder);
        }

        throw new \InvalidArgumentException("Parser [{$key}] not found.");
    }
}
