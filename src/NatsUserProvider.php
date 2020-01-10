<?php
namespace Paperstreetmedia\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class NatsUserProvider implements UserProvider 
{
	private $api_key = 'PyyOVuSfXFS3S7Z90gMSXO';

	public function retrieveById($identifier)
	{
		$user =  new NatsUser;


		try{
			$api = \ApiHelper::callAuthApi('GET', sprintf('http://auth-api.teamskeet.com/member.json?memberid=%s&api_key=%s', $identifier, $this->api_key));
	    	$data = json_decode($api);
		}

		catch(ClientException $ce)
		{
			throw new \Exception("error in logging you in");
		}

		foreach($data as $k=>$v)
			$user->{$k} = $v;

		return $user;

	}

    public function retrieveByCredentials(array $credentials)
    {
    	$user = new NatsUser;

    	try{
	    	$api = \ApiHelper::callAuthApi('GET', sprintf('http://auth-api.teamskeet.com/member/_byusername.json?username=%s&api_key=%s', $credentials['username'], $this->api_key));
	    	$members = json_decode($api);

	    	foreach($members as $key=>$member)
			{
				if(in_array($member->siteid, $credentials['siteid']))
				{
						foreach($member as $k=>$v)
							$user->{$k} = $v;					
				}	
			}

		}
		catch(\Exception $ce)
		{
			 throw new \Exception(100);
		}

		return $user;

    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
    	//var_dump($credentials);die();
    	if($user->password != $credentials['password'])
			throw new \Exception(101);
		if($user->status == 2)
			throw new \Exception(102);

		if($user->status == 0)
			throw new \Exception(103);

		if($user->status == 1 && in_array($user->siteid, $credentials['siteid']) && $user->password == $credentials['password'])
			return true;
		else
			return false;
    }

    public function retrieveByToken($identifier, $token)
    {
    	//not in use
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
    	//not in use
    }
}