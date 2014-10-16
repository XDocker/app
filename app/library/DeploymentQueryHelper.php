<?php

/**
 * Class and Function List:
 * Function list:
 * - getIndexQuery()
 * Classes list:
 * - DeploymentQueryHelper
 */
class DeploymentQueryHelper
{
	public static function getQuery($deployments, $paginate)
	{
		return $deployments
            ->select('deployments.id', 'cloud_accounts.name as accountName', 
            		 'cloud_accounts.cloudProvider', 'deployments.name', 
            		 'deployments.docker_name', 'deployments.parameters',
            		 'deployments.cloudAccountId', 'deployments.status', 
            		 'deployments.wsResults',
            		 'deployments.created_at')
            ->leftJoin('cloudAccounts', 'deployments.cloudAccountId', '=', 'cloudAccounts.id')
            ->where('deployments.user_id', Auth::id())
            ->orderBy('deployments.created_at', 'DESC')
            ->paginate($paginate);
	}
}
	