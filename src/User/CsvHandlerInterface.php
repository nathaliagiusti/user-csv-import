<?php

namespace Api\User;

interface CsvHandlerInterface
{
    /**
     * @param array $row
     */
    public function handleRow(array $row);

    public function onFinish();
}