<?php

namespace PS\Http\Middleware;

use Closure;
use PS\Repositories\Contract\ProjectRepository;

class CheckProjectOwner
{
    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * CheckProjectOwner constructor.
     * @param ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projetct_id = $request->project;

        if($this->repository->isOwner($projetct_id,$userId) == false){
            return['error' => 'access forbidden'];
        }
        return $next($request);
    }
}
