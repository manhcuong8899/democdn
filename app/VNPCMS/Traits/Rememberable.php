<?php

namespace VNPCMS\Traits;

use VNPCMS\Classes\RememberableQueryBuilder as Builder;

trait Rememberable
{

    /**
     * Get a new query builder instance for the connection.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function newBaseQueryBuilder()
    {
        $conn = $this->getConnection();

        $grammar = $conn->getQueryGrammar();

        $builder = new Builder($conn, $grammar, $conn->getPostProcessor());

        if (isset($this->rememberFor)) {
            $builder->remember($this->rememberFor);
        }

        return $builder;
    }
}
