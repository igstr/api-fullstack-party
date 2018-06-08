<?php

namespace App\Api\Controllers;

use App\Model\IssueMapper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Log;
use Validator;

class IssuesController extends Controller
{
    /** @var IssueMapper */
    protected $issueMapper;

    /**
     * Create a new controller instance.
     *
     * @param IssueMapper $issueMapper
     */
    public function __construct(IssueMapper $issueMapper)
    {
        $this->issueMapper = $issueMapper;
    }

    /**
     * List all issues
     *
     * @param  Request  $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'page'     => 'nullable|integer|min:0',
            'per_page' => 'nullable|integer|max:100',
        ]);

        try {
            $params = $validator->validate();
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $defaults = [ 'page' => 0, 'per_page' => 10 ];
        $params = array_merge($defaults, $params);

        try {
            $issues = $this->issueMapper->fetch($params);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'errors' => [ 'An error occured. Cannot get issues.' ],
            ], 500);
        }

        $data = [
            'success' => true,
            'data' => $issues,
        ];

        return response()->json($data);
    }

    /**
     * Get a single issue
     *
     * @param  Request  $request
     * @return Response
     */
    public function getAction(Request $request, $number)
    {
        $num = (int)$number;
        try {
            $issue = $this->issueMapper->getByNumber($num);
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'errors' => [ 'An error occured. Cannot get an issue.' ],
            ], 500);
        }

        if (!issue) {
             return response()->json([
                'success' => false,
                'errors' => [ 'Cannot find a match for such issue.' ],
            ], 400);
        }

        $data = [
            'success' => true,
            'data' => $issue,
        ];

        return response()->json($data);
    }
}