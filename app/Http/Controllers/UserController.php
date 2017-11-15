<?php

namespace App\Http\Controllers;

use Api\User\CsvParser;
use Api\Validator\PostCodeValidator;
use App\Exceptions\ValidationException;
use App\Repositories\Users;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UserController extends Controller
{
    const FIELD_CSV_FILE = 'csv';
    const FIELD_POSTCODE = 'postcode';
    const FIELD_LIMIT    = 'limit';
    const FIELD_OFFSET   = 'offset';
    const LIMIT          = 100;
    const MAX_FILE_SIZE  = 10240;
    const OFFSET         = 0;

    /** @var CsvParser */
    private $csvParser;

    /**
     * @param CsvParser $csvParser
     */
    public function __construct(CsvParser $csvParser)
    {
        $this->csvParser = $csvParser;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function index(Request $request)
    {
        $postCode = $request->input(self::FIELD_POSTCODE, '');
        $offset   = (int)$request->input(self::FIELD_OFFSET, self::OFFSET);
        $limit    = (int)$request->input(self::FIELD_LIMIT,self::LIMIT);
        $limit    = min($limit,self::LIMIT);

        throw_if(
            !PostCodeValidator::isValid($postCode),
            new ValidationException('Invalid postcode')
        );

        $users = Users::getByPostCode($postCode, $limit, $offset);

        return response()->json($users);
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function create(Request $request)
    {
        $csvFile = $this->getFileFromRequest($request);

        throw_if(!$csvFile, new ValidationException('Invalid CSV file'));

        $this->csvParser->parse($csvFile->path());

        $response = [
            'success' => true,
        ];

        return response()->json($response);
    }

    /**
     * @param Request $request
     *
     * @return UploadedFile|null
     */
    private function getFileFromRequest(Request $request)
    {
        $this->validate($request, [
            self::FIELD_CSV_FILE => 'max:' . self::MAX_FILE_SIZE . '|required|mimes:csv,txt',
        ]);

        $csvFile = $request->file(self::FIELD_CSV_FILE);

        if ($csvFile->isValid()) {
            return $csvFile;
        }

        return null;
    }
}
