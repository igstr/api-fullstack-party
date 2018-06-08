<?php

namespace App\Api\Controllers;

use App\Model\RepoMapper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;

class RepoController extends Controller
{
    /** @var RepoMapper */
    protected $repoMapper;

    /**
     * Create a new controller instance.
     *
     * @param RepoMapper $repoMapper
     */
    public function __construct(RepoMapper $repoMapper)
    {
        $this->repoMapper = $repoMapper;
    }

    /**
     * Get repository data
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function getAction(Request $request)
    {
        try {
            $repo = $this->repoMapper->fetch();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'errors' => [ 'An error occured. Cannot get repository data.' ],
            ], 500);
        }

        $data = [
            'success' => true,
            'data' => $repo,
        ];

        return response()->json($data);
    }
}
