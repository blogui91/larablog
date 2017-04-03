<?php
class Social
{
	public static function getConnections()
	{
		$connections = collect(config('services'))->filter(function($social , $key){
			if(in_array($key, ['github','facebook','twitter','google'])){
				if($social['client_id']) {
					return true;
	    		}
	    	}
		}); 
		return $connections;
	}

	public static function hasConnections()
	{
		return Social::getConnections()->count() > 0;
	}
}
	