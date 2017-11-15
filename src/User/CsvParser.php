<?php

namespace Api\User;

class CsvParser
{
    /** @var UserCsvHandler */
    private $csvHandler;

    /**
     * @todo : depend on CsvHandlerInterface instead of UserCsvHandler.
     *
     * @param UserCsvHandler $csvHandler
     */
    public function __construct(UserCsvHandler $csvHandler)
    {
        $this->csvHandler = $csvHandler;
    }

    /**
     * @param string $filename
     */
    public function parse(string $filename)
    {
        $isTitleRow = true;

        if (($handle = fopen($filename, "r")) !== false) {

            while (($row = fgetcsv($handle, 1000, ";")) !== false) {

                if ($isTitleRow)
                {
                    $isTitleRow = false;
                    continue;
                }

                $this->csvHandler->handleRow($row);
            }

            $this->csvHandler->onFinish();

            fclose($handle);
        }
    }
}