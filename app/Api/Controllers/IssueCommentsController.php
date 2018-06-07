<?php

namespace App\Api\Controllers;

use App\Model\IssueCommentMapper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IssueCommentsController extends Controller
{
    /** @var IssueCommentMapper */
    protected $commentsMapper;

    /**
     * Create a new controller instance.
     *
     * @param IssueCommentMapper $commentsMapper
     */
    public function __construct(IssueCommentMapper $commentsMapper)
    {
        $this->commentsMapper = $commentsMapper;
    }

    /**
     * Get issue comments list
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function getAction(Request $request, $number)
    {
        $num = (int) $number;
        try {
            $comments = $this->commentsMapper->fetch($num);
        } catch(\Exception $e) {
             return response()->json([
                'success' => false,
                'error' => 'Cannot get commments of the issue.',
            ], 500);
        }

        $data = [
            'success' => true,
            'data' => $comments,
        ];

        return response()->json($data);
    }
}
