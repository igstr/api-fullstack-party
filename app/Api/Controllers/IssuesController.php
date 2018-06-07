<?php

namespace App\Api\Controllers;

use App\Model\IssueMapper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;

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
        try {
            $issues = $this->issueMapper->fetch();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An error occured. Cannot get issues.'
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
                'error' => 'An error occured. Cannot get an issue.'
            ], 500);
        }

        if (!issue) {
             return response()->json([
                'success' => false,
                'error' => 'Cannot find a match for such issue.',
            ], 400);
        }

        $data = [
            'success' => true,
            'data' => $issue,
        ];

        return response()->json($data);
    }
}