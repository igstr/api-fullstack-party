<?php

namespace App\Api\Controllers;

use App\Model\IssueCommentMapper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Validator;

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
        $params = $request->all();
        $params['number'] = $number;

        // Validate user input
        $validator = Validator::make($params, [
            'number'   => 'integer',
            'page'     => 'nullable|integer|min:0',
            'per_page' => 'nullable|integer|max:100',
        ]);

        try {
            $params = $validator->validate();
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors(),
            ], 400);
        }

        $defaults = [ 'page' => 0, 'per_page' => 10 ];
        $params = array_merge($defaults, $params);
        unset($params['number']);

        try {
            $comments = $this->commentsMapper->fetch($number, $params);
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
