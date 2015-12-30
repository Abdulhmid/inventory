<?php 

class AclHelp {

	public static function takeFunction($module_id = "", $origin = ""){
		$module = App\Models\Modules::where('module_id',$module_id)->first();
		$listfunction = ($origin <> "" ? explode(',', $module->function) : explode(',', $module->function_alias) ) ;
		
		return $listfunction;
	}

	public static function takeNumberFunction($module_id= "", $keyOut=""){
		$takeList = self::takeFunction($module_id, "origin");
		foreach ($takeList as $key => $value) {
			if($key == $keyOut)
				$valueFunction = $value;
		}
		return $valueFunction;
	}

	public static function takePermissionFunction($groupPartnerId, $module_id, $valuefunction, $acl = ""){
		$data = App\Models\Group_module::where('module_id',$module_id)
					 ->where('group_partner_id',$groupPartnerId)
					 ->get();
		
		$listaccess = ($data->count() > 0 ? json_decode($data->first()->access_data, true) : 0) ;

		if ($listaccess > 0) :
			$valueacces = isset($listaccess[''.$valuefunction.'']) ? $listaccess[''.$valuefunction.''] : "0" ;
			if ($valueacces == "1") :
				return "checked";
			else :
				return "";
			endif;
		else :
			return "";
		endif;			

	}

}